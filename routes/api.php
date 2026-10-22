<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\LoanController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {

    // ---------- Publik: boleh diakses tanpa token ----------
    Route::get('/halo', function () {
        return ['pesan' => 'Halo dari API SiPinjam', 'waktu' => now()->toDateTimeString()];
    })->name('halo');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
    Route::get('/alat', [ItemController::class, 'index'])->name('alat.index');
    Route::get('/alat/{alat}', [ItemController::class, 'show'])->name('alat.show');

    // ---------- Wajib membawa token ----------
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('me');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/peminjaman', [LoanController::class, 'index'])->name('peminjaman.index');
        Route::post('/peminjaman', [LoanController::class, 'store'])->name('peminjaman.store');

        // ---------- Khusus admin ----------
        Route::middleware('admin')->group(function () {
            Route::apiResource('alat', ItemController::class)->except([
                'index',
                'show'
            ]);
        });
    });
});
