<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('/servis', [ServisController::class, 'index'])->name('servis');
Route::get('/servis/{slug}', [ServisController::class, 'show'])->name('servis.detail');
Route::view('/toko/ban-motor', 'toko.ban-motor')->name('toko.banmotor');
Route::view('/toko/oli-motor', 'toko.oli-motor')->name('toko.oli');
Route::view('/toko/sparepart', 'toko.sparepart')->name('toko.sparepart');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('services', AdminServiceController::class);
    });

    Route::get('/mekanik/dashboard', [MekanikController::class, 'dashboard'])->name('mekanik.dashboard');
    Route::post('/mekanik/booking/{booking}/status', [MekanikController::class, 'updateStatus'])->name('mekanik.booking.update');

    Route::get('/pengguna/dashboard', [PenggunaController::class, 'dashboard'])->name('pengguna.dashboard');
    Route::get('/pengguna/booking', [PenggunaController::class, 'bookingForm'])->name('pengguna.booking.create');
    Route::post('/pengguna/booking', [PenggunaController::class, 'bookingStore'])->name('pengguna.booking.store');
    Route::get('/pengguna/riwayat', [PenggunaController::class, 'riwayat'])->name('pengguna.riwayat');

    Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
    Route::get('/toko/pembelian/{purchase}', [TokoController::class, 'result'])->name('toko.result');
    Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show');
    Route::post('/toko/{id}/beli', [TokoController::class, 'buy'])->name('toko.buy');
    Route::resource('products', ProductController::class);
});
