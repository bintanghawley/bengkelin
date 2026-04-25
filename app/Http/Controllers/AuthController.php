<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Kalo udah login, cek role-nya biar arah baliknya bener
        if (session('user_id')) {
            if (session('user_role') === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withInput($request->only('email'))->with('error', 'Email atau password salah');
        }

        // Set Session
        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_name', $user->name);
        $request->session()->put('user_role', $user->role);

        // --- LOGIC PEMISAHAN ADMIN & USER ---
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Komandan Admin!');
        }

        // Kalo bukan admin (pengguna/mekanik), ke dashboard biasa
        return redirect()->route('dashboard')->with('success', 'Login berhasil');
    }

    public function showRegister()
    {
        // Sama kayak login, proteksi kalo udah ada session
        if (session('user_id')) {
            if (session('user_role') === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard'); // Gw ubah dari 'home' biar konsisten larinya ke dashboard
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'role' => 'pengguna',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        // Gw saranin baliknya ke 'login' aja, biar user tau dia beneran udah keluar
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}