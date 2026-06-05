@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans">
    
    <!-- Sidebar Admin -->
    <aside class="w-64 bg-gray-50 dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-gray-200 dark:border-zinc-800/100">
            <span class="text-3xl font-bengkel tracking-wider">ADMIN<span class="text-red-600">PANEL</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                DASHBOARD
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-900/20 rounded-xl font-bold transition">
                BOOKING MASUK
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-zinc-800">
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-gray-500 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest border border-gray-300 dark:border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-10 bg-zinc-950 min-h-screen text-white">
        <div class="mb-8">
            <h1 class="text-2xl font-bengkel uppercase tracking-widest">Semua Booking Servis</h1>
            <p class="text-zinc-500 text-xs mt-1 uppercase tracking-widest">Total: {{ $bookings->total() }} booking terdaftar</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-900/30 border border-emerald-700 text-emerald-400 px-6 py-4 rounded-2xl text-sm font-semibold">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] uppercase tracking-tighter">
                    <thead class="bg-zinc-950 text-zinc-500 border-b border-zinc-800">
                        <tr>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Layanan</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Jam</th>
                            <th class="px-6 py-4">Mekanik</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-zinc-300">
                        @forelse ($bookings as $booking)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-white font-bold">{{ $booking->user->name ?? 'Guest' }}</span>
                                    <span class="text-[9px] text-zinc-500 lowercase italic">Telp: {{ $booking->user->nomor_telepon ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-red-500 font-bold">{{ $booking->nama_kendaraan }}</span>
                                <span class="text-zinc-400 text-[10px]">{{ $booking->service->nama ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->tanggal_booking->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white">{{ $booking->mechanic->name ?? 'Belum Ditugaskan' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold border inline-block
                                    {{ $booking->status === 'pending' ? 'bg-orange-950/40 text-orange-400 border-orange-900/60' : '' }}
                                    {{ $booking->status === 'ditugaskan' ? 'bg-blue-950/40 text-blue-400 border-blue-900/60' : '' }}
                                    {{ $booking->status === 'diproses' ? 'bg-yellow-950/40 text-yellow-500 border-yellow-900/60' : '' }}
                                    {{ $booking->status === 'selesai' ? 'bg-emerald-950/40 text-emerald-400 border-emerald-900/60' : '' }}
                                    {{ $booking->status === 'dibatalkan' ? 'bg-red-950/40 text-red-500 border-red-900/60' : '' }}
                                ">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                   class="text-blue-400 hover:text-blue-300 font-bold transition">Kelola</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-zinc-600">
                                Belum ada booking masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </main>
</div>
@endsection
