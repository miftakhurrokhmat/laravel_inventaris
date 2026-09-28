<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// ----- Rute Publik (guest) -----
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ----- Rute Terautentikasi -----
Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD Master Data
    Route::resource('kategori', KategoriController::class);
    Route::resource('kondisi', KondisiController::class);

    // CRUD Transaksi
    // Route::resource('inventaris', InventarisController::class);
    Route::resource('inventaris', InventarisController::class)
        ->parameters(['inventaris' => 'inventaris']);

    // Peminjaman (kustom route)
    Route::resource('peminjaman', PeminjamanController::class)->except(['edit', 'update']);
    Route::patch('peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjaman.kembalikan');

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/per-kategori', [LaporanController::class, 'perKategori'])->name('per-kategori');
        Route::get('/per-kondisi', [LaporanController::class, 'perKondisi'])->name('per-kondisi');
        Route::get('/nilai-aset', [LaporanController::class, 'nilaiAset'])->name('nilai-aset');
        Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])->name('peminjaman');
    });
});