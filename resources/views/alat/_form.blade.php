@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
            <option value="">-- Pilih kategori --</option>
            @foreach ($semuaKategori as $kategori)
            <option value="{{ $kategori->id }}" @selected(old('category_id',
                $alat->category_id ?? '') == $kategori->id)>
                {{ $kategori->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="code" class="form-label">Kode Alat</label>
        <input type="text" id="code" name="code" placeholder="ALT-0001"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $alat->code ?? '') }}">
        @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Nama Alat</label>
        <input type="text" id="name" name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $alat->name ?? '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="stock" class="form-label">Stok</label>
        <input type="number" id="stock" name="stock" min="0"
            class="form-control @error('stock') is-invalid @enderror"
            value="{{ old('stock', $alat->stock ?? 0) }}">
        @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" id="location" name="location" placeholder="Rak A1"
            class="form-control @error('location') is-invalid @enderror"
            value="{{ old('location', $alat->location ?? '') }}">
        @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $alat->description ?? '') }}</textarea>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>