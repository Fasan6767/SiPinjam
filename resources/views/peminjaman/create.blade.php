@extends('layouts.app')
@section('title', 'Pinjam Alat')
@section('content')
<h3 class="mb-3">Pinjam Alat</h3>

@if ($errors->has('items'))
<div class="alert alert-danger">
    {{ $errors->first('items') }}
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="form-label fw-bold">Pilih Alat dan Jumlah</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 15%;">Kode</th>
                                <th style="width: 45%;">Nama Alat</th>
                                <th style="width: 20%;">Stok Available</th>
                                <th style="width: 20%;">Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alatTersedia as $alat)
                            <tr>
                                <td class="text-center fw-semibold">{{ $alat->code }}</td>
                                <td class="text-center">{{ $alat->name }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $alat->stock }}</span>
                                </td>
                                <td>
                                    <input type="number" 
                                           name="items[{{ $alat->id }}]" 
                                           min="0" 
                                           max="{{ $alat->stock }}" 
                                           value="{{ old('items.' . $alat->id, 0) }}" 
                                           class="form-control form-control-sm text-center mx-auto @error('items.' . $alat->id) is-invalid @enderror"
                                           style="max-width: 100px;">
                                    @error('items.' . $alat->id)
                                    <div class="invalid-feedback text-center">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada alat yang tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="due_date" class="form-label fw-bold">Tanggal Kembali</label>
                    <input type="date" id="due_date" name="due_date"
                        value="{{ old('due_date', now()->addDays(3)->toDateString()) }}"
                        class="form-control @error('due_date') is-invalid @enderror">
                    @error('due_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="notes" class="form-label fw-bold">Keperluan</label>
                    <input type="text" id="notes" name="notes" value="{{ old('notes') }}" class="form-control"
                        placeholder="Contoh: Praktikum Elektronika Dasar">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection