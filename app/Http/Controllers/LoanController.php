<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'items'])->latest();
        // Mahasiswa hanya boleh melihat peminjamannya sendiri

        if (! $request->user()->isAdmin()) {
            $query->where('user_id', $request->user()->id);
        }

        $semuaPeminjaman = $query->paginate(10);
        return view('peminjaman.index', compact('semuaPeminjaman'));
    }

    public function create()
    {
        $alatTersedia = Item::available()->orderBy('name')->get(); // hanya alat dengan stok > 0
        return view('peminjaman.create', compact('alatTersedia'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'qty' => 'required|integer|min:1',
            'due_date' => 'required|date|after_or_equal:today|before_or_equal:' .
                now()->addDays(7)->toDateString(),
            'notes' => 'nullable|max:255',
        ], [
            'item_id.required' => 'Pilih alat yang akan dipinjam.',
            'qty.min' => 'Jumlah minimal 1.',
            'due_date.required' => 'Tanggal kembali wajib diisi.',
            'due_date.after_or_equal' => 'Tanggal kembali tidak boleh sebelum hari ini.',
            'due_date.before_or_equal' => 'Lama peminjaman maksimal 7 hari.',
        ]);

        $alat = Item::findOrFail($validated['item_id']);
        // Cek stok cukup
        if ($validated['qty'] > $alat->stock) {
            return back()->withInput()->withErrors([
                'qty' => "Stok {$alat->name} hanya tersisa {$alat->stock}.",
            ]);
        }
        // Tiga perubahan ini berhasil bersama atau batal bersama
        DB::transaction(function () use ($request, $validated, $alat) {
            // 1. Catat peminjaman (user_id terisi otomatis lewat relasi)
            $peminjaman = $request->user()->loans()->create([
                'loan_date' => today(),
                'due_date' => $validated['due_date'],
                'status' => 'dipinjam',
                'notes' => $validated['notes'] ?? null,
            ]);
            // 2. Catat alat yang dipinjam di tabel pivot loan_item
            $peminjaman->items()->attach($alat->id, ['qty' => $validated['qty']]);
            
            // 3. Kurangi stok
            $alat->decrement('stock', $validated['qty']);
        });
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat.');
    }
    public function kembalikan(Loan $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }
        DB::transaction(function () use ($peminjaman) {
            // Kembalikan stok setiap alat sesuai jumlah yang dipinjam
            foreach ($peminjaman->items as $alat) {
                $alat->increment('stock', $alat->pivot->qty);
            }
            $peminjaman->update([
                'status' => 'dikembalikan',
                'returned_at' => today(),
            ]);
        });
        return back()->with('success', 'Alat sudah dikembalikan dan stok diperbarui.');
    }
}




