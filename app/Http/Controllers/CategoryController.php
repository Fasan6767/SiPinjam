<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // withCount('items') menghitung jumlah alat di setiap kategori
        $semuaKategori = Category::withCount('items')->orderBy('name')->paginate(10);
        return view('kategori.index', compact('semuaKategori'));
    }
    public function create()
    {
        return view('kategori.create');
    }
    public function store(Request $request)
    {
        // 1. Periksa isian form. Jika ada yang salah, otomatis kembali ke form
        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories,name',
            'description' => 'nullable|max:500',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max' => 'Nama kategori maksimal 100 karakter.',
            'name.unique' => 'Nama kategori sudah dipakai.',
        ]);
        // 2. Simpan ke database
        Category::create($validated);
        // 3. Kembali ke daftar sambil membawa pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Category $kategori)
    {

        $validated = $request->validate([
            // tambahan ",' . $kategori->id" = abaikan nama milik kategori ini sendiri
            'name' => 'required|max:100|unique:categories,name,' . $kategori->id,
            'description' => 'nullable|max:500',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max' => 'Nama kategori maksimal 100 karakter.',
            'name.unique' => 'Nama kategori sudah dipakai.',
        ]);
        $kategori->update($validated);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $kategori)
    {
        if ($kategori->items()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki alat.');
        }
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}


