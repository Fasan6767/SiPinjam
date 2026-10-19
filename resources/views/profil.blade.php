<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <title>Profil Mahasiswa</title>
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
 <img src="{{ asset('images/logo.png') }}" alt="Logo Kampus" class="logo">
 <h1>Profil Mahasiswa</h1>
 <table>
 <tr>
 <th>Nama</th>
 <th>NIM</th>
 <th>Kelas</th>
 <th>Program Studi</th>
 <th>Kampus</th>
 <th>Hobi</th>
 <th>Alamat</th>
 </tr>
 <tr>
 <td>{{ $nama }}</td>
 <td>{{ $nim }}</td>
 <td>{{ $kelas }}</td>
 <td>{{ $prodi }}</td>
 <td>{{ $kampus }}</td>
 <td>{{ $hobi }}</td>
 <td>{{ $alamat }}</td>
 </tr>
 </table>
</body>
</html>
