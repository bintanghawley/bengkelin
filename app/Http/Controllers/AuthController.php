<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nomor_telepon' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withInput($request->only('nomor_telepon'))->with('error', 'Nomor telepon atau password salah');
        }

        $request->session()->regenerate();

        return $this->redirectByRole(Auth::user()->role)->with('success', 'Login berhasil');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nomor_telepon' => ['required', 'regex:/^08[0-9]{8,11}$/', 'unique:users,nomor_telepon'],
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'password' => Hash::make($validated['password']),
            'role' => 'pengguna',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Registrasi berhasil');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout berhasil');
    }

    private function redirectByRole(string $role)
    {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($role === 'mekanik') {
            return redirect()->route('mekanik.dashboard');
        }
        return redirect()->route('pengguna.dashboard');
    }
}