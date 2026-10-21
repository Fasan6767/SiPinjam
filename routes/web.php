<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Item;
use App\Models\Loan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;

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

Route::resource('alat', ItemController::class)->except('show');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/kategori', function () {
//     $categories = Category::withCount('items')->get();
//     return view('kategori', compact('categories'));
// })->name('kategori');

Route::resource('kategori', CategoryController::class)->except('show');

// // Route Login
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::post('/login', function () {
//     // Sementara diarahakn ke dashboard saat submit form
//     return redirect()->route('dashboard');
// });

// // Route Register
// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

// Route::post('/register', function () {
//     // Sementara diarahkan ke login setelah registrasi
//     return redirect()->route('login');
// })->name('register.store');

// Di dalam grup middleware('admin'):
Route::patch('/peminjaman/{peminjaman}/kembali', [LoanController::class,
'kembalikan'])->name('peminjaman.kembali');

// Di dalam grup middleware('auth'), di luar grup admin:
Route::resource('peminjaman', LoanController::class)->only(['index', 'create', 'store']);

// Hanya untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('daftar');
    Route::post('/daftar', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Khusus admin
    Route::middleware('admin')->group(function () {
        Route::resource('kategori', CategoryController::class)->except('show');
        Route::resource('alat', ItemController::class)->except(['index', 'show']);
    });
    // Semua yang sudah login: melihat daftar alat
    Route::get('/alat', [ItemController::class, 'index'])->name('alat.index');
});

// YANG LAMA LOGIN & REGISTER
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');