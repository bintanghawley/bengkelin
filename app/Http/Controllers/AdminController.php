<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking; // WAJIB IMPORT MODEL BOOKING
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Safety check role admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        // Ambil data User untuk statistik
        $users = User::orderBy('id', 'desc')->get();
        $countMekanik = User::where('role', 'mekanik')->count();
        $countPengguna = User::where('role', 'pengguna')->count();

        // AMBIL DATA BOOKING (Gunakan Eager Loading 'user' agar tidak berat)
        $allBookings = Booking::with('user')
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Tambahkan 'allBookings' ke dalam compact
        return view('admin.dashboard', compact(
            'users', 
            'countMekanik', 
            'countPengguna', 
            'allBookings'
        ));
    }
}