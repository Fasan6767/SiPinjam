<aside class="sidebar">
 <nav class="nav flex-column">
 <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{
url('/dashboard') }}">
 <i class="bi bi-speedometer2"></i> Dashboard
 </a>
 <a class="nav-link" href="#">
 <i class="bi bi-tags"></i> Kategori
 </a>
 <a class="nav-link {{ request()->is('alat') ? 'active' : '' }}" href="{{
url('/alat') }}">
 <i class="bi bi-tools"></i> Alat
 </a>
 <a class="nav-link" href="#">
 <i class="bi bi-journal-text"></i> Peminjaman
 </a>
 </nav>
</aside>