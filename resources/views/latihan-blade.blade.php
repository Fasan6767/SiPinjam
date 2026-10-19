<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <title>Latihan Blade</title>
</head>
<body>
 {{-- Komentar ini tidak akan terlihat di browser --}}
 <h2>1. Menampilkan data</h2>
 <p>Nilai saya: {{ $nilai }}</p>
 <h2>2. Percabangan (if)</h2>
 @if ($nilai >= 80)
 <p>Grade A, pertahankan!</p>
 @elseif ($nilai >= 70)
 <p>Grade B</p>
 @else
 <p>Perlu belajar lagi</p>
 @endif
 <h2>3. Perulangan (foreach)</h2>
 <ul>
 @foreach ($hobi as $h)
 <li>{{ $loop->iteration }}. {{ $h }}</li>
 @endforeach
 </ul>
 <h2>4. Data kosong (forelse)</h2>
 @forelse ($kosong as $item)
 <p>{{ $item }}</p>
 @empty
 <p>Tidak ada data.</p>
 @endforelse
 <h2>5. Kurung kurawal ganda vs tanda seru</h2>
 <p>Pakai kurung kurawal ganda: {{ $catatan }}</p>
 <p>Pakai tanda seru: {!! $catatan !!}</p>
</body>
</html>
