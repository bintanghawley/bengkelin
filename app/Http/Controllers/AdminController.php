<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\Tire;
use App\Models\Oil;
use App\Models\Sparepart;
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

        // 2. AMBIL DATA PRODUCT
        $products = Product::orderBy('created_at', 'desc')->get();

        // AMBIL DATA BOOKING
        $allBookings = \App\Models\ServiceBooking::with(['user', 'service', 'mechanic'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        $services = Service::withCount('items')->orderBy('created_at', 'desc')->get();

        // AMBIL DATA BAN MOTOR
        $tires = Tire::orderBy('created_at', 'desc')->get();

        // AMBIL DATA OLI MOTOR
        $oils = Oil::orderBy('created_at', 'desc')->get();

        // AMBIL DATA SPAREPART MOTOR
        $spareparts = Sparepart::orderBy('created_at', 'desc')->get();

        // 3. TAMBAHKAN 'products', 'tires', 'oils', dan 'spareparts' ke dalam compact
        return view('admin.dashboard', compact(
            'users', 
            'countMekanik', 
            'countPengguna', 
            'allBookings',
            'products',
            'services',
            'tires',
            'oils',
            'spareparts'
        ));
    }
}