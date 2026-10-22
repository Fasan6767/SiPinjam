<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category')->orderBy('name');
        if ($request->filled('cari')) {
            $query->where('name', 'like', '%' . $request->cari . '%');
        }
        if ($request->filled('kategori')) {
            $query->where('category_id', $request->kategori);
        }
        return ItemResource::collection($query->paginate(10)->withQueryString());
    }
    public function show(Item $alat)
    {
        return new ItemResource($alat->load('category'));
    }

    public function store(ItemRequest $request)
    {
        $alat = Item::create($request->validated());
        return (new ItemResource($alat->load('category')))
            ->response()
            ->setStatusCode(201);
    }

    public function update(ItemRequest $request, Item $alat)
    {
        $alat->update($request->validated());
        return new ItemResource($alat->load('category'));
    }

    public function destroy(Item $alat)
    {
        if ($alat->loans()->exists()) {
            return response()->json([
                'message' => 'Alat tidak bisa dihapus karena punya riwayat peminjaman.',
            ], 409);
        }
        $alat->delete();
        return response()->json(['message' => 'Alat berhasil dihapus.']);
    }
}
