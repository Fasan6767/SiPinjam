@extends('layouts.app')
@section('title', 'Tambah Alat')
@section('content')
<h3 class="mb-3">Tambah Alat</h3>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('alat.store') }}" method="POST">
            @include('alat._form')
        </form>
    </div>
</div>
@endsection