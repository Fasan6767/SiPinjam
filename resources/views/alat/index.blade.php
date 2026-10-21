@extends('layouts.app')
@section('title', 'Daftar Alat')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Alat Laboratorium</h3>
    {{-- Tombol Tambah hanya untuk Admin --}}
    @if (auth()->user()->isAdmin())
    <a href="{{ route('alat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Alat
    </a>
    @endif
</div>

{{-- Form pencarian: method GET agar kata kunci tampil di alamat --}}
<form method="GET" action="{{ route('alat.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="cari" value="{{ request('cari') }}"
            class="form-control" placeholder="Cari nama alat...">
    </div>
    <div class="col-md-4">
        <select name="kategori" class="form-select">
            <option value="">Semua kategori</option>
            @foreach ($semuaKategori as $kategori)
            <option value="{{ $kategori->id }}" @selected(request('kategori')==$kategori->id)>
                {{ $kategori->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-outline-primary">
            <i class="bi bi-search"></i> Cari
        </button>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th class="text-center">Stok</th>
                    {{-- Header Aksi hanya untuk Admin --}}
                    @if (auth()->user()->isAdmin())
                    <th class="text-end">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($alat as $item)
                <tr>
                    <td>{{ $alat->firstItem() + $loop->index }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->location ?? '-' }}</td>
                    <td class="text-center">
                        @if ($item->stock > 0)
                        <span class="badge bg-success">{{ $item->stock }}</span>
                        @else
                        <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    {{-- Kolom Aksi (Ubah & Hapus) hanya untuk Admin --}}
                    @if (auth()->user()->isAdmin())
                    <td class="text-end">
                        <a href="{{ route('alat.edit', $item) }}"
                            class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('alat.destroy', $item) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus alat ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    {{-- Colspan menyesuaikan status role --}}
                    <td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" class="text-center text-muted">
                        Alat tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $alat->links() }}
</div>
@endsection