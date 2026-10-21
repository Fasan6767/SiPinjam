@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
 <h3 class="mb-4">Dashboard SiPinjam</h3>
 <div class="row g-3">
 <div class="col-md-3">
 <div class="card border-primary shadow-sm">
 <div class="card-body">
 <div class="text-muted">Jenis Alat</div>
<div class="fs-2 fw-bold text-primary">{{ $jumlahAlat }}</div>
 </div>
 </div>
 </div>
 <div class="col-md-3">
 <div class="card border-success shadow-sm">
 <div class="card-body">
 <div class="text-muted">Kategori</div>
<div class="fs-2 fw-bold text-success">{{ $jumlahKategori }}</div>
 </div>
 </div>
 </div>
 <div class="col-md-3">
 <div class="card border-warning shadow-sm">
 <div class="card-body">
 <div class="text-muted">Sedang Dipinjam</div>
<div class="fs-2 fw-bold text-warning">{{ $sedangDipinjam }}</div>
 </div>
 </div>
 </div>
 <div class="col-md-3">
 <div class="card border-danger shadow-sm">
 <div class="card-body">
 <div class="text-muted">Stok Menipis</div>
<div class="fs-2 fw-bold text-danger">{{ $stokMenipis }}</div>
 </div>
 </div>
 </div>
 </div>
@endsection