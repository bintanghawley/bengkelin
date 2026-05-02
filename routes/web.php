<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class)->except(['show']);
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
});
