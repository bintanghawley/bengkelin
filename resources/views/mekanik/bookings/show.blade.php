@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans">
    
    <!-- Sidebar Mekanik -->
    <aside class="w-64 bg-gray-50 dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-gray-200 dark:border-zinc-800/100">
            <span class="text-3xl font-bengkel tracking-wider">MEKANIK<span class="text-red-600">PANEL</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('mekanik.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                DASHBOARD
            </a>
            <a href="{{ route('mekanik.bookings.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-900/20 rounded-xl font-bold transition">
                TUGAS SAYA
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-zinc-800">
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-gray-500 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest border border-gray-300 dark:border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-10 bg-zinc-950 min-h-screen text-white">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('mekanik.bookings.index') }}" class="text-xs text-red-500 hover:text-red-400 transition uppercase font-bold tracking-widest">← Kembali ke Tugas</a>
                <h1 class="text-2xl font-bengkel uppercase tracking-widest mt-2">Detail Pekerjaan #{{ $booking->id }}</h1>
            </div>
            <span class="px-4 py-1.5 rounded-full text-xs font-bold border
                {{ $booking->status === 'ditugaskan' ? 'bg-blue-950/40 text-blue-400 border-blue-900/60' : '' }}
                {{ $booking->status === 'diproses' ? 'bg-yellow-950/40 text-yellow-500 border-yellow-900/60' : '' }}
                {{ $booking->status === 'selesai' ? 'bg-emerald-950/40 text-emerald-400 border-emerald-900/60' : '' }}
                {{ $booking->status === 'dibatalkan' ? 'bg-red-950/40 text-red-500 border-red-900/60' : '' }}
            ">
                {{ strtoupper($booking->status) }}
            </span>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-900/30 border border-emerald-700 text-emerald-400 px-6 py-4 rounded-2xl text-sm font-semibold">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-900/30 border border-red-700 text-red-400 px-6 py-4 rounded-2xl text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left: Info Utama -->
            <div class="lg:col-span-1 bg-zinc-900 border border-zinc-800 rounded-3xl p-6 space-y-6 shadow-2xl">
                <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3">Informasi Tugas</h3>
                
                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Pelanggan</p>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->user->name ?? 'Guest' }}</p>
                </div>

                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Layanan</p>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->service->nama }}</p>
                    <p class="text-xs text-zinc-500">Estimasi Waktu: {{ $booking->service->estimasi_waktu }}</p>
                </div>

                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Jadwal</p>
                    <p class="text-sm font-semibold text-white">
                        {{ $booking->tanggal_booking->format('d/m/Y') }} @ {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Kendaraan</p>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->nama_kendaraan }}</p>
                    <p class="text-xs text-zinc-500 font-mono">{{ $booking->plat_nomor }}</p>
                </div>
            </div>

            <!-- Right: Keluhan & Aksi Pekerjaan -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Keluhan & Catatan Admin -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 shadow-2xl space-y-4">
                    <div>
                        <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3 mb-2">Keluhan Pelanggan</h3>
                        <p class="text-zinc-300 text-sm leading-relaxed whitespace-pre-line bg-zinc-950 p-4 rounded-xl border border-zinc-850">
                            {{ $booking->keluhan ?: 'Tidak ada keluhan tertulis.' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3 mb-2">Catatan dari Admin</h3>
                        <p class="text-zinc-300 text-sm leading-relaxed whitespace-pre-line bg-zinc-950 p-4 rounded-xl border border-zinc-850">
                            {{ $booking->catatan_admin ?: 'Tidak ada catatan khusus dari admin.' }}
                        </p>
                    </div>
                </div>

                <!-- Aksi Mekanik -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 shadow-2xl space-y-4">
                    <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3">Update Pekerjaan</h3>

                    @if($booking->status === 'ditugaskan')
                        <form action="{{ route('mekanik.bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="start">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl uppercase text-[10px] tracking-widest transition shadow-lg shadow-blue-900/40">
                                Mulai Pekerjaan
                            </button>
                        </form>
                    @elseif($booking->status === 'diproses')
                        <form action="{{ route('mekanik.bookings.update', $booking->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="complete">

                            <div class="space-y-2">
                                <label class="text-[10px] uppercase text-zinc-500 font-bold tracking-widest">Catatan Pekerjaan Mekanik</label>
                                <textarea name="catatan_mekanik" required rows="4" placeholder="Tuliskan detail pekerjaan yang telah diselesaikan (misal: ganti oli berhasil, kampas rem belakang diganti)..."
                                          class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3.5 text-sm text-white focus:border-red-600 outline-none transition">{{ $booking->catatan_mekanik }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl uppercase text-[10px] tracking-widest transition shadow-lg shadow-emerald-900/40">
                                Selesaikan Servis
                            </button>
                        </form>
                    @else
                        <!-- Selesai atau Dibatalkan -->
                        <div>
                            <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest mb-2">Catatan Mekanik Anda</p>
                            <p class="text-zinc-300 text-sm leading-relaxed whitespace-pre-line bg-zinc-950 p-4 rounded-xl border border-zinc-850">
                                {{ $booking->catatan_mekanik ?: 'Tidak ada catatan pekerjaan tertulis.' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
