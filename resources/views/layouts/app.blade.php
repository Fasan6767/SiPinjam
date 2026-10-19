<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>@yield('title', 'Dashboard') | SiPinjam</title>
 <link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrapicons.min.css" rel="stylesheet">
 <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
 @include('layouts.partials.header')
 <div class="wrapper">
 @include('layouts.partials.sidebar')
 <main class="content">
 @yield('content')
 </main>
 </div>
 @include('layouts.partials.footer')
 <script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></
script>
</body>
</html>