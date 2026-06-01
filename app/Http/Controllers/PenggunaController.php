<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    private function checkPengguna()
    {
        if (Auth::user()->role !== 'pengguna') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        return null;
    }

   public function dashboard()
{
    $check = $this->checkPengguna();
    if ($check) {
        return $check;
    }

    $user = Auth::user();
    $bookings = \App\Models\Booking::where('user_id', $user->id)->orderBy('id', 'desc')->get();
    $products = Product::all();
    return view('pengguna.dashboard', compact('user', 'products','bookings'));
}

    public function bookingForm()
    {
        $check = $this->checkPengguna();
        if ($check) {
            return $check;
        }

        return view('pengguna.booking.create');
    }

    public function bookingStore(Request $request)
    {
        $check = $this->checkPengguna();
        if ($check) {
            return $check;
        }

        $validated = $request->validate([
            'jenis_motor' => 'required',
            'layanan' => 'required',
            'metode' => 'required',
            'alamat' => 'required',
            'tanggal' => 'required|date',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'jenis_motor' => $validated['jenis_motor'],
            'plat_nomor' => $request->input('plat_nomor', ''),
            'layanan' => $validated['layanan'],
            'metode' => $validated['metode'],
            'alamat' => $validated['alamat'],
            'tanggal' => $validated['tanggal'],
            'status' => 'pending',
        ]);

        return redirect()->route('pengguna.riwayat')->with('success', 'Booking berhasil dibuat');
    }

    public function riwayat()
    {
        $check = $this->checkPengguna();
        if ($check) {
            return $check;
        }

        $bookings = Booking::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('pengguna.riwayat.index', compact('bookings'));
    }
}
