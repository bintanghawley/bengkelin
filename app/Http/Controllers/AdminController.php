<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        $users = User::orderBy('id', 'desc')->get();
        $countMekanik = User::where('role', 'mekanik')->count();
        $countPengguna = User::where('role', 'pengguna')->count();

        return view('admin.dashboard', compact('users', 'countMekanik', 'countPengguna'));
    }
}