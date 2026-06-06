@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans bg-gray-100 dark:bg-zinc-950">
    <aside class="w-64 bg-gray-50 dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-gray-200 dark:border-zinc-800/50">
            <span class="text-3xl font-bengkel tracking-wider text-zinc-800 dark:text-white">MEKANIK<span class="text-red-600">PANEL</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('mekanik.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 dark:text-red-500 bg-red-50 dark:bg-red-900/20 rounded-xl font-bold transition">
                DASHBOARD
            </a>
            <a href="{{ route('mekanik.bookings.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 dark:hover:text-red-500 rounded-xl font-bold transition">
                TUGAS SAYA
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-zinc-800 space-y-2">
            <button onclick="toggleTheme()" class="w-full flex items-center justify-center gap-2 text-[10px] text-gray-600 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 uppercase tracking-widest border border-gray-300 dark:border-zinc-700 py-2 rounded-lg transition font-bold">
                <svg id="themeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m6.364 1.636l-.707-.707M21 12h-1m1.364 6.364l-.707-.707M12 21v1m-6.364-1.636l.707.707M3 12h1M3.636 5.636l.707.707"/>
                </svg>
                <span id="themeText">Mode Gelap</span>
            </button>
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-gray-500 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest border border-gray-300 dark:border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-10 bg-gray-100 dark:bg-zinc-950 min-h-screen text-zinc-800 dark:text-white">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bengkel tracking-wider uppercase text-zinc-800 dark:text-white">Dashboard Mekanik</h1>
                <p class="text-zinc-500 text-xs mt-1 uppercase tracking-widest">Selamat bekerja! Pantau tugas servis Anda di bawah ini.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-emerald-100 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-700 text-emerald-700 dark:text-emerald-400 px-6 py-4 rounded-2xl text-sm font-semibold">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-400 px-6 py-4 rounded-2xl text-sm font-semibold">
                ✗ {{ session('error') }}
            </div>
        @endif

        <div class="bg-gray-50 dark:bg-zinc-900 rounded-3xl border border-gray-200 dark:border-zinc-800 overflow-hidden shadow-2xl">
            <div class="p-6 border-b border-gray-200 dark:border-zinc-800 flex justify-between items-center">
                <h3 class="font-bengkel text-lg text-zinc-800 dark:text-white uppercase tracking-wider">Tugas Servis Aktif</h3>
                <span class="text-[9px] bg-red-100 dark:bg-red-950/40 text-red-600 dark:text-red-500 px-3 py-1 rounded-full border border-red-200 dark:border-red-900/60 font-bold uppercase tracking-widest">
                    {{ $bookings->count() }} Tugas
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] uppercase tracking-tighter">
                    <thead class="bg-gray-100 dark:bg-zinc-950 text-zinc-500 border-b border-gray-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-6 py-4 text-zinc-800 dark:text-white font-bold">Pelanggan</th>
                            <th class="px-6 py-4 text-zinc-800 dark:text-white font-bold">Servis / Motor</th>
                            <th class="px-6 py-4 text-zinc-800 dark:text-white font-bold">Tanggal Booking</th>
                            <th class="px-6 py-4 text-center text-zinc-800 dark:text-white font-bold">Status</th>
                            <th class="px-6 py-4 text-right text-zinc-800 dark:text-white font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-800/50 text-zinc-600 dark:text-zinc-300">
                        @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-100 dark:hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <span class="block font-bold text-zinc-800 dark:text-white">{{ $booking->user->name ?? 'Guest' }}</span>
                                <span class="text-[9px] text-zinc-500 italic font-mono lowercase">Telp: {{ $booking->user->nomor_telepon ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-red-500 font-bold">{{ $booking->nama_kendaraan }}</span>
                                <span class="text-zinc-600 dark:text-zinc-400 text-[10px]">{{ $booking->service->nama ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 text-zinc-800 dark:text-white">
                                {{ $booking->tanggal_booking ? $booking->tanggal_booking->format('d/m/Y') : '-' }} @ {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold border inline-block
                                    {{ $booking->status === 'ditugaskan' ? 'bg-blue-100 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-900/60' : '' }}
                                    {{ $booking->status === 'diproses' ? 'bg-yellow-100 dark:bg-yellow-950/40 text-yellow-600 dark:text-yellow-500 border-yellow-200 dark:border-yellow-900/60' : '' }}
                                    {{ $booking->status === 'selesai' ? 'bg-emerald-100 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-900/60' : '' }}
                                    {{ $booking->status === 'dibatalkan' ? 'bg-red-100 dark:bg-red-950/40 text-red-600 dark:text-red-500 border-red-200 dark:border-red-900/60' : '' }}
                                ">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('mekanik.bookings.show', $booking->id) }}"
                                   class="inline-block bg-zinc-200 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-700 text-zinc-800 dark:text-white text-[9px] font-bold py-2 px-4 rounded-lg transition">
                                    Detail & Update
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-zinc-600 dark:text-zinc-500 italic">
                                Belum ada tugas servis yang ditugaskan kepada Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    // Theme Toggle
    function toggleTheme() {
        const html = document.documentElement;
        const isDark = html.classList.contains('dark');
        
        if (isDark) {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
            updateThemeButton(false);
        } else {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
            updateThemeButton(true);
        }
    }

    function updateThemeButton(isDark) {
        const themeText = document.getElementById('themeText');
        const themeIcon = document.getElementById('themeIcon');
        
        if (isDark) {
            themeText.textContent = 'Mode Terang';
            themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 015.646 5.646 9 9 0 0120.354 15.354Z"/>';
        } else {
            themeText.textContent = 'Mode Gelap';
            themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m6.364 1.636l-.707-.707M21 12h-1m1.364 6.364l-.707-.707M12 21v1m-6.364-1.636l.707.707M3 12h1M3.636 5.636l.707.707"/>';
        }
    }

    // Initialize theme on page load
    window.addEventListener('DOMContentLoaded', function() {
        const html = document.documentElement;
        const theme = localStorage.getItem('theme') || 'light';
        
        if (theme === 'dark') {
            html.classList.add('dark');
            updateThemeButton(true);
        } else {
            html.classList.remove('dark');
            updateThemeButton(false);
        }
    });
</script>
@endsection
