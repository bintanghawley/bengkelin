@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider">Riwayat Booking</h1>
            <div class="flex gap-2">
                <a href="{{ route('pengguna.booking.create') }}" class="px-4 py-2 bg-red-600 rounded-md text-sm">Buat Booking</a>
                <a href="{{ route('pengguna.dashboard') }}" class="px-4 py-2 bg-zinc-800 rounded-md text-sm">Kembali</a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-900/30 border border-emerald-700 text-emerald-300 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-800 text-zinc-300">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Jenis Motor</th>
                            <th class="px-4 py-3">Layanan</th>
                            <th class="px-4 py-3">Metode</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse ($bookings as $booking)
                            <tr>
                                <td class="px-4 py-3">{{ $booking->id }}</td>
                                <td class="px-4 py-3">{{ $booking->jenis_motor }}</td>
                                <td class="px-4 py-3">{{ $booking->layanan }}</td>
                                <td class="px-4 py-3">{{ $booking->metode }}</td>
                                <td class="px-4 py-3">{{ $booking->alamat }}</td>
                                <td class="px-4 py-3">{{ $booking->tanggal }}</td>
                                <td class="px-4 py-3">{{ $booking->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-zinc-400">Belum ada booking</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
