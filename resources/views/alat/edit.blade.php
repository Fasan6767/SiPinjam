@extends('layouts.app')
@section('title', 'Ubah Alat')
@section('content')
<h3 class="mb-3">Ubah Alat: {{ $alat->name }}</h3>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('alat.update', $alat) }}" method="POST">
            @method('PUT')
            @include('alat._form')
        </form>
    </div>
</div>
@endsection