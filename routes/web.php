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
Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
Route::get('/toko/show/{id}', [TokoController::class, 'show'])->name('toko.show');
Route::get('/toko/hasil/{purchase}', [TokoController::class, 'result'])->name('toko.result')->middleware('auth');
Route::post('/toko/buy/{id}', [TokoController::class, 'buy'])->name('toko.buy')->middleware('auth');
Route::view('/toko/ban-motor', 'toko.ban-motor')->name('toko.banmotor');
Route::view('/toko/oli-motor', 'toko.oli-motor')->name('toko.oli');
Route::view('/toko/sparepart', 'toko.sparepart')->name('toko.sparepart');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/booking/{slug}', [App\Http\Controllers\Pengguna\BookingController::class, 'create'])->name('booking.create')->middleware('auth');
Route::post('/booking/{slug}', [App\Http\Controllers\Pengguna\BookingController::class, 'store'])->name('booking.store')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('services', AdminServiceController::class);
        Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class)->only(['index', 'show', 'update']);
    });

    Route::get('/mekanik/dashboard', [MekanikController::class, 'dashboard'])->name('mekanik.dashboard');
    Route::post('/mekanik/booking/{booking}/status', [MekanikController::class, 'updateStatus'])->name('mekanik.booking.update');
    Route::get('/mekanik/bookings', [App\Http\Controllers\Mekanik\BookingController::class, 'index'])->name('mekanik.bookings.index');
    Route::get('/mekanik/bookings/{booking}', [App\Http\Controllers\Mekanik\BookingController::class, 'show'])->name('mekanik.bookings.show');
    Route::put('/mekanik/bookings/{booking}', [App\Http\Controllers\Mekanik\BookingController::class, 'update'])->name('mekanik.bookings.update');

    Route::get('/pengguna/dashboard', [PenggunaController::class, 'dashboard'])->name('pengguna.dashboard');
    Route::get('/pengguna/booking', [PenggunaController::class, 'bookingForm'])->name('pengguna.booking.create');
    Route::post('/pengguna/booking', [PenggunaController::class, 'bookingStore'])->name('pengguna.booking.store');

    Route::get('/pengguna/bookings', [App\Http\Controllers\Pengguna\BookingController::class, 'index'])->name('pengguna.bookings.index');
    Route::get('/pengguna/bookings/{booking}', [App\Http\Controllers\Pengguna\BookingController::class, 'show'])->name('pengguna.bookings.show');


    Route::resource('products', ProductController::class);
});
