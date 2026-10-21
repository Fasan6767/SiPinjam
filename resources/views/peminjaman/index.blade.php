@extends('layouts.app')
@section('title', 'Peminjaman')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Peminjaman Alat</h3>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Pinjam Alat
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    @if (auth()->user()->isAdmin())
                    <th class="text-end">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaPeminjaman as $peminjaman)
                <tr>
                    <td>{{ $semuaPeminjaman->firstItem() + $loop->index }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>
                        @foreach ($peminjaman->items as $alat)
                        {{ $alat->name }} ({{ $alat->pivot->qty }})<br>
                        @endforeach
                    </td>
                    <td>{{ $peminjaman->loan_date->format('d/m/Y') }}</td>
                    <td>{{ $peminjaman->due_date->format('d/m/Y') }}</td>
                    <td>
                        @if ($peminjaman->status === 'dipinjam')
                        <span class="badge bg-warning textdark">Dipinjam</span>
                        @else
                        <span class="badge bgsuccess">Dikembalikan</span>
                        @endif
                    </td>
                    @if (auth()->user()->isAdmin())
                    <td class="text-end">
                        @if ($peminjaman->status === 'dipinjam')
                        <form action="{{ route('peminjaman.kembali', $peminjaman) }}" method="POST"
                            onsubmit="return confirm('Tandai alat sudah dikembalikan?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="bi bi-arrow-returnleft"></i> Kembalikan
                            </button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada
                        peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $semuaPeminjaman->links() }}
</div>
@endsection

