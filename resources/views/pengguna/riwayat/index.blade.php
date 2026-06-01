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
        <tr class="hover:bg-zinc-900/30 transition-colors">
            <td class="px-4 py-3 text-zinc-300 font-mono">#{{ $booking->id }}</td>
            <td class="px-4 py-3 text-zinc-200 font-semibold">{{ $booking->jenis_motor }}</td>
            <td class="px-4 py-3 text-zinc-400">{{ $booking->layanan }}</td>
            <td class="px-4 py-3 text-zinc-400">{{ $booking->metode }}</td>
            <td class="px-4 py-3 text-zinc-400 max-w-xs truncate">{{ $booking->alamat }}</td>
            <td class="px-4 py-3 text-zinc-400">{{ $booking->tanggal }}</td>
            
            <td class="px-4 py-3">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold tracking-wide uppercase border
                    {{ $booking->status == 'pending' ? 'bg-orange-950/40 border-orange-500/50 text-orange-400' : '' }}
                    {{ $booking->status == 'diterima' ? 'bg-green-950/40 border-green-500/50 text-green-400' : '' }}
                    {{ $booking->status == 'diproses' ? 'bg-yellow-950/40 border-yellow-500/50 text-yellow-400' : '' }}
                    {{ $booking->status == 'selesai' ? 'bg-green-950/40 border-green-500/50 text-green-400' : '' }}">
                    {{ $booking->status }}
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="px-4 py-8 text-center text-zinc-500 text-sm">
                Belum ada riwayat booking.
            </td>
        </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
