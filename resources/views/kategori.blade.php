@extends('layouts.app')
@section('title', 'Daftar Kategori')

@section('content')
 <h3 class="mb-3">Daftar Kategori Alat</h3>
 <div class="card shadow-sm">
 <div class="card-body">
 <table class="table table-striped table-hover align-middle mb-0">
<thead class="table-dark">
 <tr>
 <th style="width: 50px;">No</th>
 <th>Nama Kategori</th>
 <th>Deskripsi</th>
 <th class="text-center" style="width: 150px;">Jumlah Alat</th>
 </tr>
</thead>
 <tbody>
 @forelse ($categories as $category)
 <tr>
 <td>{{ $loop->iteration }}</td>
 <td>{{ $category->name }}</td>
 <td>{{ $category->description ?? '-' }}</td>
 <td class="text-center">
 <span class="badge bg-primary">{{ $category->items_count }}</span>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="text-center text-muted">Belum ada data kategori.</td>
 </tr>
 @endforelse
</tbody>
 </table>
 </div>
 </div>
@endsection

