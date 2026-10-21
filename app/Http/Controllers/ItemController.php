<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category')->orderBy('name');
        // Jika kolom pencarian diisi, saring berdasarkan nama alat
        if ($request->filled('cari')) {
            $query->where('name', 'like', '%' . $request->cari . '%');
        }

        // Jika kategori dipilih, saring berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('category_id', $request->kategori);
        }

        $alat = $query->paginate(10)->withQueryString();
        $semuaKategori = Category::orderBy('name')->get();
        return view('alat.index', compact('alat', 'semuaKategori'));
    }

    public function create()
    {
        $semuaKategori = Category::orderBy('name')->get(); // untuk dropdown
        return view('alat.create', compact('semuaKategori'));
    }

    public function store(ItemRequest $request)
    {
        Item::create($request->validated());
        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan.');
    }

    public function edit(Item $alat)
    {
        $semuaKategori = Category::orderBy('name')->get();
        return view('alat.edit', compact('alat', 'semuaKategori'));
    }

    public function update(ItemRequest $request, Item $alat)
    {
        $alat->update($request->validated());
        return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui.');
    }

    public function destroy(Item $alat)
    {
        if ($alat->loans()->exists()) {
            return back()->with('error', 'Alat tidak bisa dihapus karena punya riwayat peminjaman.');
        }
        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus.');
    }
}


