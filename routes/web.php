<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Akses Umum / Tanpa Login)
|--------------------------------------------------------------------------
*/

// Halaman utama langsung mengambil data produk lewat ProductController@index
Route::get('/', [ProductController::class, 'index'])->name('home');

// Jalur cepat kalau sewaktu-waktu butuh URL khusus /products untuk guest
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Autentikasi (Login & Register)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

/*
|--------------------------------------------------------------------------
| Protected Routes (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Utama User
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Grouping Route khusus Hak Akses Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class)->except(['show']);
    });

    // Grouping Route khusus Hak Akses Mekanik
    Route::get('/mekanik/dashboard', [MekanikController::class, 'dashboard'])->name('mekanik.dashboard');
    Route::post('/mekanik/booking/{booking}/status', [MekanikController::class, 'updateStatus'])->name('mekanik.booking.update');

    // Grouping Route khusus Hak Akses Pengguna/Pelanggan
    Route::get('/pengguna/dashboard', [PenggunaController::class, 'dashboard'])->name('pengguna.dashboard');
    Route::get('/pengguna/booking', [PenggunaController::class, 'bookingForm'])->name('pengguna.booking.create');
    Route::post('/pengguna/booking', [PenggunaController::class, 'bookingStore'])->name('pengguna.booking.store');
    Route::get('/pengguna/riwayat', [PenggunaController::class, 'riwayat'])->name('pengguna.riwayat');

    // E-Commerce / Fitur Toko Sparepart (Sisi User setelah Login)
    Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
    Route::get('/toko/pembelian/{purchase}', [TokoController::class, 'result'])->name('toko.result');
    Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show');
    Route::post('/toko/{id}/beli', [TokoController::class, 'buy'])->name('toko.buy');

    // Fitur CRUD Product milik Admin (Tambah, Edit, Hapus wajib login)
    // Ditambahkan 'except' karena method 'index'-nya sudah kita lepas ke publik di bagian atas
    Route::resource('products', ProductController::class)->except(['index']);
});