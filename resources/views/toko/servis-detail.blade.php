@extends('layouts.guest')

@section('content')
<div class="bg-zinc-950 text-white min-h-screen">

    {{-- Navbar --}}
    <nav class="w-full border-b border-zinc-900/60 bg-zinc-950/95 backdrop-blur sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-10 h-10 object-contain">
                <span class="text-xl font-bengkel tracking-wider">Bengkel<span class="text-red-600">in</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-10 text-xs font-semibold uppercase tracking-widest text-zinc-400">
                <a href="{{ route('servis') }}" class="text-white transition">Servis</a>
                <a href="{{ route('toko.banmotor') }}" class="hover:text-white transition">Ban Motor</a>
                <a href="{{ route('toko.oli') }}" class="hover:text-white transition">Oli Motor</a>
                <a href="{{ route('toko.sparepart') }}" class="hover:text-white transition">Sparepart</a>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('pengguna.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-zinc-400 hover:text-white transition uppercase tracking-widest">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Breadcrumb --}}
    <div class="max-w-7xl mx-auto px-6 pt-8">
        <nav class="flex items-center gap-2 text-xs text-zinc-500 uppercase tracking-widest">
            <a href="{{ route('servis') }}" class="hover:text-white transition">Servis</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="text-zinc-400">{{ $service->nama }}</span>
        </nav>
    </div>

    {{-- Konten Utama --}}
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Kolom Kiri: Gambar + Info Singkat --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Gambar --}}
            <div class="rounded-3xl overflow-hidden border border-zinc-800 shadow-2xl shadow-black/40">
                @if($service->gambar && file_exists(public_path('storage/' . $service->gambar)))
                    <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama }}"
                         class="w-full aspect-square object-cover">
                @else
                    <div class="w-full aspect-square bg-gradient-to-br from-red-900/40 via-zinc-900 to-zinc-900 flex items-center justify-center">
                        <svg class="w-24 h-24 text-red-700/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" stroke-width="1" stroke-linecap="round"/>
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="1" stroke-linecap="round"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Info Cards --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-zinc-800">
                    <span class="text-xs text-zinc-500 uppercase tracking-widest font-bold">Harga Mulai</span>
                    <span class="text-lg font-bengkel text-emerald-500">Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-zinc-800">
                    <span class="text-xs text-zinc-500 uppercase tracking-widest font-bold">Estimasi</span>
                    <span class="text-sm font-semibold text-white">{{ $service->estimasi_waktu }}</span>
                </div>
                <div class="flex items-center justify-between py-3">
                    <span class="text-xs text-zinc-500 uppercase tracking-widest font-bold">Total Pekerjaan</span>
                    <span class="text-sm font-semibold text-red-500">{{ $service->items->count() }} Item</span>
                </div>
            </div>

            {{-- Tombol Booking --}}
            <a href="#"
               class="block w-full text-center bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 shadow-lg shadow-red-900/40 text-sm uppercase tracking-widest">
                🔧 Booking Servis
            </a>

            <a href="{{ route('servis') }}"
               class="block w-full text-center border border-zinc-800 hover:border-zinc-700 text-zinc-400 hover:text-white font-semibold py-3 px-6 rounded-2xl transition text-xs uppercase tracking-widest">
                ← Kembali ke Daftar
            </a>
        </div>

        {{-- Kolom Kanan: Detail --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Judul --}}
            <div>
                <span class="inline-block bg-red-600/20 text-red-400 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full border border-red-700/40 mb-3">Layanan Servis</span>
                <h1 class="text-3xl md:text-4xl font-bengkel uppercase tracking-wide text-white">{{ $service->nama }}</h1>
            </div>

            {{-- Deskripsi --}}
            <div class="bg-zinc-900/60 border border-zinc-800 rounded-2xl p-6">
                <h2 class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest mb-3">Tentang Layanan Ini</h2>
                <p class="text-zinc-300 leading-relaxed">{{ $service->deskripsi }}</p>
            </div>

            {{-- Yang Dikerjakan --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                <h2 class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest mb-5">Yang Dikerjakan</h2>
                @if($service->items->isEmpty())
                    <p class="text-zinc-600 text-sm italic">Belum ada detail pekerjaan.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($service->items as $item)
                        <div class="flex items-center gap-3 bg-zinc-950/80 border border-zinc-800/60 rounded-xl px-4 py-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-900/40 border border-emerald-700/60 flex items-center justify-center">
                                <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span class="text-sm text-zinc-200">{{ $item->nama_pekerjaan }}</span>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- CTA Mobile --}}
            <div class="lg:hidden">
                <a href="#"
                   class="block w-full text-center bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-6 rounded-2xl transition shadow-lg shadow-red-900/40 text-sm uppercase tracking-widest">
                    🔧 Booking Servis
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


