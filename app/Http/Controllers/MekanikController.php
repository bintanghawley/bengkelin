<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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

        $bookings = Booking::with('user')->orderBy('id', 'desc')->get();

        return view('mekanik.dashboard', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $check = $this->checkMekanik();
        if ($check) {
            return $check;
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,diterima,diproses,selesai',
        ]);

        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('mekanik.dashboard')->with('success', 'Status booking diperbarui');
    }
}
