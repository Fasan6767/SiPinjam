<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Item;
use App\Models\Loan;

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
 $alat = Item::with('category')->orderBy('name')->get();
 return view('alat', ['alat' => $alat]);
});

Route::get('/dashboard', function () {
 return view('dashboard', [
 'jumlahAlat' => Item::count(),
 'jumlahKategori' => Category::count(),
 'sedangDipinjam' => Loan::where('status', 'dipinjam')->count(),
 ]);
});