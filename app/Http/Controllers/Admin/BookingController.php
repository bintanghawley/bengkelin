<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = ServiceBooking::with(['user', 'service', 'mechanic'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = ServiceBooking::with(['user', 'service', 'mechanic'])->findOrFail($id);
        $mechanics = User::where('role', 'mekanik')->orderBy('name', 'asc')->get();

        return view('admin.bookings.show', compact('booking', 'mechanics'));
    }

    public function update(Request $request, $id)
    {
        $booking = ServiceBooking::findOrFail($id);

        $validated = $request->validate([
            'action'        => 'required|in:assign,cancel,update_notes',
            'mechanic_id'   => 'required_if:action,assign|nullable|exists:users,id',
            'catatan_admin' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $booking) {
            if ($validated['action'] === 'assign') {
                $booking->update([
                    'status'        => 'ditugaskan',
                    'mechanic_id'   => $validated['mechanic_id'],
                    'catatan_admin' => $validated['catatan_admin'] ?? $booking->catatan_admin,
                ]);
            } elseif ($validated['action'] === 'cancel') {
                $booking->update([
                    'status'        => 'dibatalkan',
                    'catatan_admin' => $validated['catatan_admin'] ?? $booking->catatan_admin,
                ]);
            } else {
                $booking->update([
                    'catatan_admin' => $validated['catatan_admin'],
                ]);
            }
        });

        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', 'Data booking berhasil diperbarui.');
    }
}
