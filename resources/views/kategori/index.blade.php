@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Kategori Alat</h3>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Jumlah Alat</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaKategori as $kategori)
                <tr>
                    <td>{{ $semuaKategori->firstItem() + $loop->index }}</td>
                    <td>{{ $kategori->name }}</td>
                    <td class="text-muted">{{ $kategori->description ?? '-'
}}</td>
                    <td class="text-center">{{ $kategori->items_count }}</td>
                    <td class="text-end">
                        <a href="{{ route('kategori.edit', $kategori) }}"
                            class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Ubah
                        </a>
                        <form action="{{ route('kategori.destroy', $kategori) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada
                        kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $semuaKategori->links() }}
</div>
@endsection

