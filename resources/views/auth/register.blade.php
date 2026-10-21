<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun | SiPinjam</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <style>
    body {
      background-color: #f8f9fa;
    }
    .auth-card {
      width: 100%;
      max-width: 420px;
      border-radius: 10px;
    }
    .input-group-text {
      background-color: #ffffff;
      border-right: none;
      color: #6c757d;
    }
    .form-control {
      border-left: none;
    }
    .form-control:focus {
      box-shadow: none;
    }
    .input-group:focus-within {
      border-radius: 0.375rem;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
      border-color: #86b7fe;
    }
  </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 py-4">

  <div class="card auth-card shadow-sm p-4 border bg-white">
    <!-- Header -->
    <div class="text-center mb-4">
      <h4 class="fw-bold mb-1">Daftar Akun Mahasiswa</h4>
      <p class="text-muted small">Buat akun baru untuk mulai menggunakan aplikasi</p>
    </div>

    <!-- Form -->
    <form action="{{ route('daftar') }}" method="POST">
      @csrf

      <!-- Input Nama Lengkap -->
      <div class="mb-3">
        <label for="name" class="form-label small text-secondary">Nama Lengkap</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap">
        </div>
        @error('name')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <!-- Input NIM -->
      <div class="mb-3">
        <label for="nim" class="form-label small text-secondary">NIM</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
          <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" placeholder="Nomor Induk Mahasiswa">
        </div>
        @error('nim')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <!-- Input Email -->
      <div class="mb-3">
        <label for="email" class="form-label small text-secondary">Email</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope"></i></span>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com">
        </div>
        @error('email')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <!-- Input Password -->
      <div class="mb-3">
        <label for="password" class="form-label small text-secondary">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter">
        </div>
        @error('password')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <!-- Input Konfirmasi Password -->
      <div class="mb-4">
        <label for="password_confirmation" class="form-label small text-secondary">Ulangi Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password">
        </div>
      </div>

      <!-- Tombol Daftar -->
      <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Daftar</button>
    </form>

    <!-- Navigasi ke Halaman Masuk -->
    <div class="text-center mt-4">
      <p class="small text-muted mb-0">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk di sini</a>
      </p>
    </div>
  </div>

</body>
</html>