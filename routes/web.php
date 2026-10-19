<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 return view('homepage');
})->name('home');

Route::get('/halamandepan', function () {
 return view('halamandepan');
});

Route::get('/halamanbaru', function () {
    return view('halamanbaru');
})->name('halamanbaru');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/profil', function () {
 return view('profil', [
 'nama' => 'Fatih Ahsan',
 'nim' => '225443033',
 'kelas' => '2AEC2',
 'prodi' => 'TRIN',
 'kampus' => 'Politeknik Manufaktur Bandung',
 'hobi' => 'Main UNO',
 'alamat' => 'Jl. Keramat No.67 RT6 RW7'
 ]);
})->name('profil');

Route::get('/latihan-blade', function () {
 return view('latihan-blade', [
 'nilai' => 60,
 'hobi' => ['Membaca', 'Bermain futsal', 'Ngoding'],
 'kosong' => [],
 'catatan' => '<b>Teks ini tebal</b>',
 ]);
})->name('latihan-blade');

Route::get('/alat', function () {
 $alat = [
 ['kode' => 'ALT-0001', 'nama' => 'Multimeter Digital', 'kategori' => 'Alat
Ukur', 'stok' => 5],
 ['kode' => 'ALT-0002', 'nama' => 'Osiloskop', 'kategori' => 'Alat
Ukur', 'stok' => 0],
 ['kode' => 'ALT-0003', 'nama' => 'Solder 40 Watt', 'kategori' => 'Alat
Solder', 'stok' => 8],
 ['kode' => 'ALT-0004', 'nama' => 'Arduino Uno', 'kategori' =>
'Mikrokontroler', 'stok' => 12],
 ['kode' => 'ALT-0005', 'nama' => 'Tang Potong', 'kategori' =>
'Perkakas', 'stok' => 3],
['kode' => 'ALT-0006', 'nama' => 'Pinset', 'kategori' =>
'Perkakas', 'stok' => 0],
['kode' => 'ALT-0007', 'nama' => 'Gegep', 'kategori' =>
'Perkakas', 'stok' => 67]
 ];
 return view('alat', ['alat' => $alat]);
})->name('alat');

Route::get('/dashboard', function () {
 return view('dashboard');
})->name('dashboard');

