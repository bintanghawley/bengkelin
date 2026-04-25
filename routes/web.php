<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::view('/', 'home')->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
route::get('/admin/dashboard', function () {
    if (session('user_role') !== 'admin') {
        return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
    }

    $allUsers = User::whereIn('role', ['mekanik', 'pengguna'])->get();
    $countMekanik = User::where('role', 'mekanik')->count();
    $countPengguna = User::where('role', 'pengguna')->count();
    
    return view('admin.dashboard', compact('allUsers', 'countMekanik', 'countPengguna'));
})->name('admin.dashboard');

// Route hapus user
Route::delete('/admin/user/{id}', function ($id) {
    User::destroy($id);
    return back()->with('success', 'User berhasil dihapus!');
})->name('admin.user.delete');

Route::resource('users', UserController::class)->except(['show']);

Route::get('/dashboard', function () {
    if (!session('user_id')) {
        return redirect()->route('login')->with('error', 'Login dulu cok!');
    }
   $user = User::find(session('user_id'));

    return view('dashboard', compact('user'));
})->name('dashboard');
