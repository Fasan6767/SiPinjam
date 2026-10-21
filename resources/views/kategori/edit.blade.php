@extends('layouts.app')
@section('title', 'Ubah Kategori')
@section('content')
<h3 class="mb-3">Ubah Kategori</h3>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            @method('PUT')
            @include('kategori._form')
        </form>
    </div>
</div>
@endsection

