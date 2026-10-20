@extends('layouts.app')
@section('title', 'Daftar Alat')
@section('content')
 <h3 class="mb-3">Daftar Alat Laboratorium</h3>
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
 </tr>
</thead>
 <tbody>
 @forelse ($alat as $item)
 <tr>
 <td>{{ $loop->iteration }}</td>
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
 </tr>
 @empty
 <tr>
 <td colspan="6" class="text-center text-muted">Belum ada data alat.</td>
 </tr>
 @endforelse
</tbody>
 </table>
 </div>
 </div>
@endsection