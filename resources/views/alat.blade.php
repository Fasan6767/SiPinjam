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
<th class="text-center">Stok</th>
 </tr>
 </thead>
 <tbody>
 @foreach ($alat as $item)
 <tr>
 <td>{{ $loop->iteration }}</td>
<td>{{ $item['kode'] }}</td>
<td>{{ $item['nama'] }}</td>
<td>{{ $item['kategori'] }}</td>
<td class="text-center">
 @if ($item['stok'] > 0)
 <span class="badge bg-success">{{ $item['stok']
}}</span>
 @else
 <span class="badge bg-danger">Habis</span>
 @endif
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 </div>
@endsection