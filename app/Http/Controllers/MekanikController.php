<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MekanikController extends Controller
{
    private function checkMekanik()
    {
        if (Auth::user()->role !== 'mekanik') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        return null;
    }

    public function dashboard()
    {
        $check = $this->checkMekanik();
        if ($check) {
            return $check;
        }

        $bookings = \App\Models\ServiceBooking::with(['user', 'service'])
            ->where('mechanic_id', \Illuminate\Support\Facades\Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('mekanik.dashboard', compact('bookings'));
    }
}

