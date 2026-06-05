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
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs text-red-500 hover:text-red-400 transition uppercase font-bold tracking-widest">← Kembali ke Daftar</a>
                <h1 class="text-2xl font-bengkel uppercase tracking-widest mt-2">Kelola Booking #{{ $booking->id }}</h1>
            </div>
            <span class="px-4 py-1.5 rounded-full text-xs font-bold border
                {{ $booking->status === 'pending' ? 'bg-orange-950/40 text-orange-400 border-orange-900/60' : '' }}
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left: Detail Booking -->
            <div class="lg:col-span-1 bg-zinc-900 border border-zinc-800 rounded-3xl p-6 space-y-6 shadow-2xl">
                <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3">Detail Booking</h3>
                
                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Pelanggan</p>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->user->name ?? 'Guest' }}</p>
                    <p class="text-xs text-zinc-500">Telp: {{ $booking->user->nomor_telepon ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Layanan</p>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->service->nama }}</p>
                    <p class="text-xs text-emerald-500 font-bold">Mulai: {{ $booking->service->harga_mulai_formatted }}</p>
                </div>

                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Waktu Booking</p>
                    <p class="text-sm font-semibold text-white">
                        {{ $booking->tanggal_booking->format('d/m/Y') }} @ {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }} WIB
                    </p>
                </div>

                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Unit Motor</p>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->nama_kendaraan }}</p>
                    <p class="text-xs text-zinc-500 font-mono">{{ $booking->plat_nomor }}</p>
                </div>

                <div>
                    <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest">Mekanik Terkini</p>
                    <p class="text-sm font-semibold text-white">
                        {{ $booking->mechanic ? $booking->mechanic->name : 'Belum Ditugaskan' }}
                    </p>
                </div>
            </div>

            <!-- Right: Action & Keluhan -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Keluhan -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 shadow-2xl">
                    <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3 mb-4">Keluhan Pelanggan</h3>
                    <p class="text-zinc-300 text-sm leading-relaxed whitespace-pre-line bg-zinc-950 p-4 rounded-xl border border-zinc-850">
                        {{ $booking->keluhan ?: 'Tidak ada keluhan tertulis.' }}
                    </p>
                </div>

                <!-- Update Status & Penugasan -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 shadow-2xl space-y-6">
                    <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3">Penugasan & Status</h3>
                    
                    @if($booking->status === 'pending')
                    <!-- Form Tugaskan Mekanik -->
                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="assign">

                        <div class="space-y-2">
                            <label class="text-[10px] uppercase text-zinc-500 font-bold tracking-widest">Pilih Mekanik Untuk Ditugaskan</label>
                            <select name="mechanic_id" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3.5 text-sm text-white focus:border-red-600 outline-none transition">
                                <option value="">-- Pilih Mekanik --</option>
                                @foreach($mechanics as $mechanic)
                                    <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] uppercase text-zinc-500 font-bold tracking-widest">Tambahkan Catatan Admin</label>
                            <textarea name="catatan_admin" rows="3" placeholder="Misal: Kerjakan motor ini terlebih dahulu..." class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition">{{ $booking->catatan_admin }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl uppercase text-[10px] tracking-widest transition shadow-lg shadow-red-900/40">
                            Terima dan Tugaskan
                        </button>
                    </form>

                    <div class="border-t border-zinc-800 pt-4">
                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="cancel">
                            <button type="submit" class="w-full bg-zinc-800 hover:bg-red-950 hover:text-red-400 text-white font-bold py-4 rounded-xl uppercase text-[10px] tracking-widest transition">
                                Batalkan Booking
                            </button>
                        </form>
                    </div>
                    @else
                    <!-- Hanya edit catatan admin jika status bukan pending lagi -->
                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="update_notes">

                        <div class="space-y-2">
                            <label class="text-[10px] uppercase text-zinc-500 font-bold tracking-widest">Catatan Admin</label>
                            <textarea name="catatan_admin" rows="3" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition">{{ $booking->catatan_admin }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-zinc-850 hover:bg-zinc-850 hover:text-white text-zinc-400 font-bold py-3.5 rounded-xl uppercase text-[10px] tracking-widest transition">
                            Simpan Catatan
                        </button>
                    </form>
                    @endif
                </div>

                <!-- Detail Catatan Mekanik -->
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 shadow-2xl">
                    <h3 class="text-xs text-zinc-500 uppercase tracking-widest font-bold border-b border-zinc-800 pb-3 mb-4">Catatan Mekanik</h3>
                    <p class="text-zinc-300 text-sm leading-relaxed whitespace-pre-line bg-zinc-950 p-4 rounded-xl border border-zinc-850">
                        {{ $booking->catatan_mekanik ?: 'Mekanik belum menambahkan catatan.' }}
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
