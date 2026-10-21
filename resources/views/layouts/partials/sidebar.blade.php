<aside class="sidebar">
    <nav class="nav flex-column">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
            @if (auth()->user()->isAdmin())
            <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                <i class="bi bi-tags"></i> Kategori
            </a>
            @endif
            <a class="nav-link {{ request()->is('alat*') ? 'active' : '' }}" href="{{ route('alat.index') }}">
                <i class="bi bi-tools"></i> Alat
            </a>
            <a class="nav-link {{ request()->is('peminjaman*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
                <i class="bi bi-journal-text"></i> Peminjaman
            </a>
    </nav>
</aside>