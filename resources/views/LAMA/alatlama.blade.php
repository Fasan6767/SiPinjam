<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <title>Daftar Alat</title>
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
 <h1>Daftar Alat Laboratorium — (Fatih Ahsan)</h1>
 <p style="text-align: center">Jumlah jenis alat: {{ count($alat) }}</p>
 <table>
 <tr>
 <th>No</th>
 <th>Kode</th>
 <th>Nama Alat</th>
 <th>Kategori</th>
 <th>Stok</th>
 <th>Status</th>
 </tr>
 @foreach ($alat as $item)
 <tr>
 <td>{{ $loop->iteration }}</td>
 <td>{{ $item['kode'] }}</td>
 <td>{{ $item['nama'] }}</td>
 <td>{{ $item['kategori'] }}</td>
 @if ($item['stok'] > 0)
 <td>{{ $item['stok'] }}</td>
 @else
 <td class="stok-habis">Habis</td>
 @endif
  @if ($item['stok'] == 0)
 <td>Habis</td>
 @else
 <td>Tersedia</td>
 @endif
 </tr>
 @endforeach
 </table>
</body>
</html>
