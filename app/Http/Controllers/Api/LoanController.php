<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoanResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $peminjaman = $request->user()->loans()->with('items')->latest()->get();
        return LoanResource::collection($peminjaman);
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
            'due_date.before_or_equal' => 'Lama peminjaman maksimal 7 hari.',
        ]);
        $alat = Item::findOrFail($validated['item_id']);
        if ($validated['qty'] > $alat->stock) {
            return response()->json([
                'message' => "Stok {$alat->name} hanya tersisa {$alat->stock}.",
                'errors' => ['qty' => ["Stok {$alat->name} hanya tersisa {$alat->stock}."]],
            ], 422);
        }
        $peminjaman = DB::transaction(function () use ($request, $validated, $alat) {
            $peminjaman = $request->user()->loans()->create([
                'loan_date' => today(),
                'due_date' => $validated['due_date'],
                'status' => 'dipinjam',
                'notes' => $validated['notes'] ?? null,
            ]);
            $peminjaman->items()->attach($alat->id, ['qty' => $validated['qty']]);
            $alat->decrement('stock', $validated['qty']);
            return $peminjaman;
        });
        return (new LoanResource($peminjaman->load('items')))
            ->response()
            ->setStatusCode(201);
    }
}
