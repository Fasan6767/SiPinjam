<nav class="navbar navbar-dark bg-primary px-3">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
        <i class="bi bi-box-seam"></i> SiPinjam
    </a>
    <div class="d-flex align-items-center gap-3">
        <span class="text-white">
            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
            <span class="badge bg-light text-primary">{{ auth()->user()->role }} </span>
        </span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-light">Keluar</button>
        </form>
    </div>
</nav>

