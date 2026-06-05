<?php

namespace App\Http\Controllers\Mekanik;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = ServiceBooking::with(['user', 'service'])
            ->where('mechanic_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mekanik.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = ServiceBooking::with(['user', 'service'])
            ->where('mechanic_id', Auth::id())
            ->findOrFail($id);

        return view('mekanik.bookings.show', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = ServiceBooking::where('mechanic_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'action'          => 'required|in:start,complete',
            'catatan_mekanik' => 'required_if:action,complete|nullable|string',
        ]);

        DB::transaction(function () use ($validated, $booking) {
            if ($validated['action'] === 'start') {
                $booking->update([
                    'status' => 'diproses',
                ]);
            } elseif ($validated['action'] === 'complete') {
                $booking->update([
                    'status'          => 'selesai',
                    'catatan_mekanik' => $validated['catatan_mekanik'],
                ]);
            }
        });

        return redirect()->route('mekanik.bookings.show', $booking->id)
            ->with('success', 'Status pekerjaan berhasil diperbarui.');
    }
}
