@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans">
    
    <!-- Sidebar Admin -->
    <aside class="w-64 bg-gray-50 dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-gray-200 dark:border-zinc-800/100">
            <span class="text-3xl font-bengkel tracking-wider">ADMIN<span class="text-red-600">PANEL</span></span>
        </div>

        {{-- Profile section in sidebar --}}
        <div class="p-5 border-b border-gray-200 dark:border-zinc-800 flex items-center gap-3 bg-gray-100/50 dark:bg-zinc-950/20">
            <div class="h-10 w-10 bg-red-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg uppercase shrink-0">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex flex-col min-w-0 text-left">
                <span class="text-zinc-800 dark:text-zinc-200 text-sm font-bold truncate leading-none mb-1.5">{{ Auth::user()->name }}</span>
                <span class="text-zinc-500 text-[10px] uppercase tracking-widest font-semibold leading-none">Admin Bengkelin</span>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}?section=profile" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                PROFIL
            </a>
            <a href="{{ route('admin.dashboard') }}?section=stats" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                STATISTIK
            </a>
            <a href="{{ route('admin.dashboard') }}?section=users" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                KELOLA USER
            </a>
            <a href="{{ route('admin.dashboard') }}?section=services" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                KELOLA SERVIS
            </a>
            <a href="{{ route('admin.dashboard') }}?section=tires" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                KELOLA BAN MOTOR
            </a>
            <a href="{{ route('admin.dashboard') }}?section=oils" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                KELOLA OLI MOTOR
            </a>
            <a href="{{ route('admin.dashboard') }}?section=spareparts" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                KELOLA SPAREPART
            </a>
            <a href="{{ route('admin.payments.index') }}" class="w-full flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.payments.*') ? 'text-red-600 bg-red-50 dark:bg-red-900/20' : 'text-gray-500 dark:text-zinc-400 hover:text-red-800' }} rounded-xl font-bold transition">
                 RIWAYAT PEMBAYARAN
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-zinc-800 space-y-2">
            <a href="{{ route('home') }}" class="group relative flex items-center justify-center gap-2 w-full text-center text-[10px] font-bold text-zinc-500 dark:text-zinc-400 hover:text-white uppercase tracking-widest border border-zinc-300 dark:border-zinc-855 hover:border-red-600 bg-white dark:bg-zinc-900/50 hover:bg-red-600/10 py-2.5 rounded-xl transition-all duration-300 overflow-hidden shadow-sm hover:shadow-red-650/10">
                <svg class="w-3.5 h-3.5 transform transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" onsubmit="localStorage.removeItem('bengkelin_cart'); return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-red-500 hover:bg-red-500/10 rounded-xl transition font-bold uppercase tracking-widest text-[10px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    <span>Sign Out Account</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-10 bg-gray-50 dark:bg-zinc-950 min-h-screen text-gray-900 dark:text-white">
        {{-- Header / Navbar --}}
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-bengkel tracking-wider text-zinc-800 dark:text-white">ADMIN <span class="text-red-600">DASHBOARD</span></h2>
                <p class="text-zinc-500 text-xs uppercase tracking-[0.2em] mt-1 italic">Sidoarjo High Performance Garage</p>
            </div>
            <div class="flex items-center gap-4 bg-gray-50 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 p-2 pr-6 rounded-full shadow-lg">
                <div class="h-10 w-10 bg-red-650 rounded-full flex items-center justify-center font-bold text-white shadow-lg uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex flex-col text-left">
                    <span class="text-zinc-800 dark:text-white text-sm font-bold leading-none">{{ Auth::user()->name }}</span>
                    <span class="text-zinc-500 text-[10px] uppercase mt-1 tracking-widest">Admin Bengkelin</span>
                </div>
            </div>
        </header>

        <div class="mb-8">
            <h1 class="text-2xl font-bengkel uppercase tracking-widest text-gray-900 dark:text-white">Semua Booking Servis</h1>
            <p class="text-gray-400 dark:text-zinc-500 text-xs mt-1 uppercase tracking-widest">Total: {{ $bookings->total() }} booking terdaftar</p>
        </div>



        <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-gray-200 dark:border-zinc-800 overflow-hidden shadow-sm dark:shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] uppercase tracking-tighter">
                    <thead class="bg-gray-100 dark:bg-zinc-950 text-gray-500 dark:text-zinc-500 border-b border-gray-200 dark:border-zinc-800">
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
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/50 text-gray-600 dark:text-zinc-300">
                        @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-gray-900 dark:text-white font-bold">{{ $booking->user->name ?? 'Guest' }}</span>
                                    <span class="text-[9px] text-gray-400 dark:text-zinc-500 lowercase italic">Telp: {{ $booking->user->nomor_telepon ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-red-600 dark:text-red-500 font-bold">{{ $booking->nama_kendaraan }}</span>
                                <span class="text-gray-400 dark:text-zinc-400 text-[10px]">{{ $booking->service->nama ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->tanggal_booking->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-900 dark:text-white">{{ $booking->mechanic->name ?? 'Belum Ditugaskan' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $bc = match($booking->status) {
                                        'pending'    => 'bg-orange-950/40 text-orange-400 border-orange-900/60',
                                        'diterima'   => 'bg-blue-950/40 text-blue-400 border-blue-900/60',
                                        'diproses'   => 'bg-yellow-950/40 text-yellow-500 border-yellow-900/60',
                                        'selesai'    => 'bg-emerald-950/40 text-emerald-400 border-emerald-900/60',
                                        'ditolak'    => 'bg-red-950/40 text-red-400 border-red-900/60',
                                        'dibatalkan' => 'bg-red-950/40 text-red-500 border-red-900/60',
                                        default      => 'bg-zinc-800 text-zinc-400 border-zinc-700',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold border inline-block {{ $bc }}">
                                    {{ strtoupper($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                   class="text-blue-400 hover:text-blue-300 font-bold transition">Kelola</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-gray-400 dark:text-zinc-600">
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
    </main>
</div>
@endsection
