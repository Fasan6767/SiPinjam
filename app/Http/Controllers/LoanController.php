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

        // Filter berdasarkan status jika opsi dipilih di form
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Gunakan withQueryString() agar parameter ?status=... tetap terbawa saat klik tombol halaman
        $semuaPeminjaman = $query->paginate(10)->withQueryString();

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
            'items' => 'required|array',
            'items.*' => 'nullable|integer|min:0',
            'due_date' => 'required|date|after_or_equal:today|before_or_equal:' .
                now()->addDays(7)->toDateString(),
            'notes' => 'nullable|max:255',
        ], [
            'due_date.required' => 'Tanggal kembali wajib diisi.',
            'due_date.after_or_equal' => 'Tanggal kembali tidak boleh sebelum hari ini.',
            'due_date.before_or_equal' => 'Lama peminjaman maksimal 7 hari.',
        ]);

        // Filter hanya alat yang jumlah pinjamnya lebih dari 0
        $selectedItems = array_filter($request->input('items', []), function ($qty) {
            return is_numeric($qty) && $qty > 0;
        });

        // Pastikan minimal ada 1 alat yang dipinjam
        if (empty($selectedItems)) {
            return back()->withInput()->withErrors([
                'items' => 'Pilih minimal satu alat dengan jumlah lebih dari 0.',
            ]);
        }

        // Validasi ketersediaan stok tiap alat terpilih
        $itemsToProcess = [];
        foreach ($selectedItems as $itemId => $qty) {
            $alat = Item::find($itemId);
            if (! $alat) {
                continue;
            }

            if ($qty > $alat->stock) {
                return back()->withInput()->withErrors([
                    "items.{$itemId}" => "Stok {$alat->name} hanya tersisa {$alat->stock}.",
                ]);
            }

            $itemsToProcess[] = [
                'model' => $alat,
                'qty' => $qty,
            ];
        }

        // Proses penyimpanan transaksi multi-alat
        DB::transaction(function () use ($request, $validated, $itemsToProcess) {
            // 1. Catat peminjaman induk
            $peminjaman = $request->user()->loans()->create([
                'loan_date' => today(),
                'due_date'  => $validated['due_date'],
                'status'    => 'dipinjam',
                'notes'     => $validated['notes'] ?? null,
            ]);

            // 2. Loop attach ke tabel pivot & decrement stok tiap alat
            foreach ($itemsToProcess as $itemData) {
                $alat = $itemData['model'];
                $qty  = $itemData['qty'];

                $peminjaman->items()->attach($alat->id, ['qty' => $qty]);
                $alat->decrement('stock', $qty);
            }
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