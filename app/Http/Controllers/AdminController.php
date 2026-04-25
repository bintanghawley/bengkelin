<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Security Check: Kalo bukan admin, balikin ke dashboard user
        if (session('user_role') !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Lu bukan admin, jangan aneh-aneh!');
        }

        // Ambil data buat dashboard admin
        $allUsers = User::whereIn('role', ['mekanik', 'pengguna'])->get();
        $countMekanik = User::where('role', 'mekanik')->count();
        $countPengguna = User::where('role', 'pengguna')->count();

        return view('admin.dashboard', compact('allUsers', 'countMekanik', 'countPengguna'));
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return back()->with('success', 'User berhasil ditendang dari sistem!');
        }
        return back()->with('error', 'User gagal dihapus.');
    }
}