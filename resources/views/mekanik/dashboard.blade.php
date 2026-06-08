@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans bg-zinc-950 text-white">
    <!-- Sidebar -->
    <aside class="w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-zinc-800/50">
            <span class="text-3xl font-bengkel tracking-wider">MEKANIK<span class="text-red-600">PANEL</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('mekanik.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 bg-red-900/20 rounded-xl font-bold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                DASHBOARD
            </a>
            <a href="{{ route('mekanik.bookings.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-400 rounded-xl font-bold transition relative">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                BOOKING MASUK
                @if($pendingCount > 0)
                    <span class="absolute right-3 bg-red-600 text-white text-[9px] font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $pendingCount }}</span>
                @endif
            </a>
        </nav>

        <div class="p-4 border-t border-zinc-800 space-y-2">
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-zinc-500 hover:text-white uppercase tracking-widest border border-zinc-800 py-2 rounded-lg transition">Kembali ke Beranda</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-[10px] text-red-500 hover:bg-red-900/20 py-2 rounded-lg transition font-bold uppercase tracking-widest">Sign Out</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-10 min-h-screen">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-bengkel tracking-wider uppercase">MEKANIK <span class="text-red-600">DASHBOARD</span></h1>
                <p class="text-zinc-500 text-xs mt-1 uppercase tracking-widest">Selamat bekerja! Pantau dan kelola tugas servis Anda.</p>
            </div>
            <div class="flex items-center gap-4 bg-zinc-900 border border-zinc-800 p-2 pr-6 rounded-full">
                <div class="h-10 w-10 bg-red-600 rounded-full flex items-center justify-center font-bold text-white uppercase">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <span class="block text-sm font-bold">{{ auth()->user()->name }}</span>
                    <span class="text-zinc-500 text-[10px] uppercase tracking-widest">Mekanik Bengkelin</span>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-emerald-900/30 border border-emerald-700 text-emerald-400 px-6 py-4 rounded-2xl text-sm font-semibold">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 bg-red-900/30 border border-red-700 text-red-400 px-6 py-4 rounded-2xl text-sm font-semibold">
                ✗ {{ session('error') }}
            </div>
        @endif

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800 shadow-xl">
                <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest mb-2">Booking Menunggu</p>
                <h3 class="text-4xl font-bengkel {{ $pendingCount > 0 ? 'text-red-500' : 'text-zinc-500' }}">{{ $pendingCount }}</h3>
                <a href="{{ route('mekanik.bookings.index') }}" class="text-[10px] text-zinc-500 hover:text-red-400 transition uppercase tracking-wider mt-2 block">Lihat Semua →</a>
            </div>
            <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800 shadow-xl">
                <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest mb-2">Tugas Aktif Saya</p>
                <h3 class="text-4xl font-bengkel text-yellow-500">{{ $activeBookings->count() }}</h3>
                <p class="text-[10px] text-zinc-500 uppercase tracking-wider mt-2">Diterima / Diproses</p>
            </div>
            <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800 shadow-xl">
                <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest mb-2">Total Selesai</p>
                <h3 class="text-4xl font-bengkel text-emerald-500">{{ $completedCount }}</h3>
                <p class="text-[10px] text-zinc-500 uppercase tracking-wider mt-2">Servis berhasil</p>
            </div>
        </div>

        <!-- Active Tasks -->
        @if($activeBookings->count() > 0)
        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden shadow-2xl mb-8">
            <div class="p-6 border-b border-zinc-800 flex justify-between items-center">
                <h3 class="font-bengkel text-lg text-white uppercase tracking-wider">⚡ Tugas Aktif Saya</h3>
                <span class="text-[9px] bg-yellow-950/40 text-yellow-400 px-3 py-1 rounded-full border border-yellow-900/60 font-bold uppercase">{{ $activeBookings->count() }} Aktif</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] uppercase tracking-tighter">
                    <thead class="bg-zinc-950 text-zinc-500 border-b border-zinc-800">
                        <tr>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Servis / Motor</th>
                            <th class="px-6 py-4">Tanggal Booking</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-zinc-300">
                        @foreach ($activeBookings as $booking)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <span class="block font-bold text-white">{{ $booking->user->name ?? 'Guest' }}</span>
                                <span class="text-[9px] text-zinc-500 font-mono">{{ $booking->user->nomor_telepon ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-red-500 font-bold">{{ $booking->nama_kendaraan }}</span>
                                <span class="text-zinc-400 text-[10px]">{{ $booking->service->nama ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->tanggal_booking ? $booking->tanggal_booking->format('d/m/Y') : '-' }}
                                @ {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $sc = match($booking->status) {
                                        'diterima' => 'bg-blue-950/40 text-blue-400 border-blue-900/60',
                                        'diproses' => 'bg-yellow-950/40 text-yellow-500 border-yellow-900/60',
                                        default => 'bg-zinc-800 text-zinc-400 border-zinc-700',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold border inline-block {{ $sc }}">
                                    {{ strtoupper($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('mekanik.bookings.show', $booking->id) }}"
                                   class="inline-block bg-zinc-800 hover:bg-zinc-700 text-white text-[9px] font-bold py-2 px-4 rounded-lg transition">
                                    Detail & Update
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- All My Bookings -->
        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden shadow-2xl">
            <div class="p-6 border-b border-zinc-800 flex justify-between items-center">
                <h3 class="font-bengkel text-lg text-white uppercase tracking-wider">Riwayat Tugas Saya</h3>
                <span class="text-[9px] bg-zinc-800 text-zinc-400 px-3 py-1 rounded-full border border-zinc-700 font-bold">{{ $bookings->count() }} Total</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] uppercase tracking-tighter">
                    <thead class="bg-zinc-950 text-zinc-500 border-b border-zinc-800">
                        <tr>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Servis / Motor</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-zinc-300">
                        @forelse ($bookings as $booking)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <span class="block font-bold text-white">{{ $booking->user->name ?? 'Guest' }}</span>
                                <span class="text-[9px] text-zinc-500 italic font-mono">Telp: {{ $booking->user->nomor_telepon ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-red-500 font-bold">{{ $booking->nama_kendaraan }}</span>
                                <span class="text-zinc-400 text-[10px]">{{ $booking->service->nama ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->tanggal_booking ? $booking->tanggal_booking->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $sc = match($booking->status) {
                                        'pending'    => 'bg-orange-950/40 text-orange-400 border-orange-900/60',
                                        'diterima'   => 'bg-blue-950/40 text-blue-400 border-blue-900/60',
                                        'diproses'   => 'bg-yellow-950/40 text-yellow-500 border-yellow-900/60',
                                        'selesai'    => 'bg-emerald-950/40 text-emerald-400 border-emerald-900/60',
                                        'ditolak'    => 'bg-red-950/40 text-red-400 border-red-900/60',
                                        'dibatalkan' => 'bg-red-950/40 text-red-500 border-red-900/60',
                                        default      => 'bg-zinc-800 text-zinc-400 border-zinc-700',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold border inline-block {{ $sc }}">
                                    {{ strtoupper($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('mekanik.bookings.show', $booking->id) }}"
                                   class="inline-block bg-zinc-800 hover:bg-zinc-700 text-white text-[9px] font-bold py-2 px-4 rounded-lg transition">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-zinc-600 italic">
                                Belum ada tugas servis yang pernah dikerjakan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
