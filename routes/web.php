<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PenggunaController;
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

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.delete');

    Route::get('/mekanik/dashboard', [MekanikController::class, 'dashboard'])->name('mekanik.dashboard');
    Route::post('/mekanik/booking/{booking}/status', [MekanikController::class, 'updateStatus'])->name('mekanik.booking.update');

    Route::get('/pengguna/dashboard', [PenggunaController::class, 'dashboard'])->name('pengguna.dashboard');
    Route::get('/pengguna/booking', [PenggunaController::class, 'bookingForm'])->name('pengguna.booking.create');
    Route::post('/pengguna/booking', [PenggunaController::class, 'bookingStore'])->name('pengguna.booking.store');
    Route::get('/pengguna/riwayat', [PenggunaController::class, 'riwayat'])->name('pengguna.riwayat');

    Route::resource('users', UserController::class)->except(['show']);
});
