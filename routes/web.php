<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\TireController;
use App\Http\Controllers\OilController;
use App\Http\Controllers\SparepartController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('/servis', [ServisController::class, 'index'])->name('servis');
Route::get('/servis/{slug}', [ServisController::class, 'show'])->name('servis.detail');
Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
Route::get('/toko/show/{id}', [TokoController::class, 'show'])->name('toko.show');
Route::get('/toko/checkout/{id}', [TokoController::class, 'checkout'])->name('toko.checkout')->middleware('auth');
Route::get('/toko/hasil/{purchase}', [TokoController::class, 'result'])->name('toko.result')->middleware('auth');
Route::post('/toko/buy/{id}', [TokoController::class, 'buy'])->name('toko.buy')->middleware('auth');
Route::get('/toko/ban-motor', [TireController::class, 'index'])->name('toko.banmotor');
Route::get('/toko/ban-motor/{id}', [TireController::class, 'show'])->name('toko.banmotor.show');
Route::get('/toko/ban-motor/checkout/{id}', [TireController::class, 'checkout'])->name('toko.banmotor.checkout')->middleware('auth');
Route::post('/toko/ban-motor/buy/{id}', [TireController::class, 'buy'])->name('toko.banmotor.buy')->middleware('auth');
Route::get('/toko/oli-motor', [OilController::class, 'index'])->name('toko.oli');
Route::get('/toko/oli-motor/{id}', [OilController::class, 'show'])->name('toko.oli.show');
Route::get('/toko/oli-motor/checkout/{id}', [OilController::class, 'checkout'])->name('toko.oli.checkout')->middleware('auth');
Route::post('/toko/oli-motor/buy/{id}', [OilController::class, 'buy'])->name('toko.oli.buy')->middleware('auth');
Route::get('/toko/sparepart', [SparepartController::class, 'index'])->name('toko.sparepart');
Route::get('/toko/sparepart/{id}', [SparepartController::class, 'show'])->name('toko.sparepart.show');
Route::get('/toko/sparepart/checkout/{id}', [SparepartController::class, 'checkout'])->name('toko.sparepart.checkout')->middleware('auth');
Route::post('/toko/sparepart/buy/{id}', [SparepartController::class, 'buy'])->name('toko.sparepart.buy')->middleware('auth');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/booking/{slug}', [App\Http\Controllers\Pengguna\BookingController::class, 'create'])->name('booking.create')->middleware('auth');
Route::post('/booking/{slug}', [App\Http\Controllers\Pengguna\BookingController::class, 'store'])->name('booking.store')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Cart Checkout
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/buy', [CartController::class, 'buy'])->name('cart.buy');
    Route::get('/cart/result', [CartController::class, 'result'])->name('cart.result');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('services', AdminServiceController::class);
        Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class)->only(['index', 'show', 'update']);
        Route::resource('tires', App\Http\Controllers\Admin\TireController::class)->except(['index', 'show', 'create', 'edit']);
        Route::resource('oils', App\Http\Controllers\Admin\OilController::class)->except(['index', 'show', 'create', 'edit']);
        Route::resource('spareparts', App\Http\Controllers\Admin\SparepartController::class)->except(['index', 'show', 'create', 'edit']);

        // Admin Payments
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('index');
            Route::get('/{payment}', [\App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('show');
            Route::post('/{payment}/simulate', [\App\Http\Controllers\Admin\PaymentController::class, 'simulate'])->name('simulate');
        });
    });

    Route::get('/mekanik/dashboard', [MekanikController::class, 'dashboard'])->name('mekanik.dashboard');
    Route::get('/mekanik/bookings', [App\Http\Controllers\Mekanik\BookingController::class, 'index'])->name('mekanik.bookings.index');
    Route::get('/mekanik/bookings/{booking}', [App\Http\Controllers\Mekanik\BookingController::class, 'show'])->name('mekanik.bookings.show');
    Route::put('/mekanik/bookings/{booking}', [App\Http\Controllers\Mekanik\BookingController::class, 'update'])->name('mekanik.bookings.update');

    Route::get('/pengguna/dashboard', [PenggunaController::class, 'dashboard'])->name('pengguna.dashboard');
    Route::get('/pengguna/booking', [PenggunaController::class, 'bookingForm'])->name('pengguna.booking.create');
    Route::post('/pengguna/booking', [PenggunaController::class, 'bookingStore'])->name('pengguna.booking.store');

    Route::get('/pengguna/bookings', [App\Http\Controllers\Pengguna\BookingController::class, 'index'])->name('pengguna.bookings.index');
    Route::get('/pengguna/bookings/{booking}', [App\Http\Controllers\Pengguna\BookingController::class, 'show'])->name('pengguna.bookings.show');

    // Pengguna Payments
    Route::prefix('pengguna/payments')->name('pengguna.payments.')->group(function () {
        Route::get('/{payment}', [\App\Http\Controllers\Pengguna\PaymentController::class, 'show'])->name('show');
        Route::post('/{payment}/select-method', [\App\Http\Controllers\Pengguna\PaymentController::class, 'selectMethod'])->name('select-method');
        Route::post('/{payment}/pay', [\App\Http\Controllers\Pengguna\PaymentController::class, 'pay'])->name('pay');
        Route::get('/{payment}/success', [\App\Http\Controllers\Pengguna\PaymentController::class, 'success'])->name('success');
        Route::get('/{payment}/expired', [\App\Http\Controllers\Pengguna\PaymentController::class, 'expired'])->name('expired');
    });

    Route::resource('products', ProductController::class);
});
