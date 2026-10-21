@extends('layouts.app')
@section('title', 'Pinjam Alat')
@section('content')
<h3 class="mb-3">Pinjam Alat</h3>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="item_id" class="form-label">Alat</label>
                <select id="item_id" name="item_id" class="form-select @error('item_id') is-invalid @enderror">
                    <option value="">-- Pilih alat --</option>
                    @foreach ($alatTersedia as $alat)
                    <option value="{{ $alat->id }}" @selected(old('item_id')==$alat->id)>
                        {{ $alat->code }} - {{ $alat->name }} (stok: {{ $alat->stock }})
                    </option>
                    @endforeach
                </select>
                @error('item_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="qty" class="form-label">Jumlah</label>
                    <input type="number" id="qty" name="qty" min="1" value="{{ old('qty', 1) }}"
                        class="form-control @error('qty') is-invalid @enderror">
                    @error('qty')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-8 mb-3">
                    <label for="due_date" class="form-label">Tanggal
                        Kembali</label>
                    <input type="date" id="due_date" name="due_date"
                        value="{{ old('due_date', now()->addDays(3)->toDateString()) }}"
                        class="form-control @error('due_date') is-invalid @enderror">
                    @error('due_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Keperluan</label>
                <input type="text" id="notes" name="notes" value="{{ old('notes') }}" class="form-control"
                    placeholder="Contoh: Praktikum Elektronika Dasar">
            </div>
            <button type="submit" class="btn btn-primary">Ajukan
                Peminjaman</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btnsecondary">Batal</a>
        </form>
    </div>
</div>
@endsection



