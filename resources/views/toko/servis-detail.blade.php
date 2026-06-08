@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white transition-colors duration-300">

    {{-- Navbar --}}
    <nav class="w-full border-b border-zinc-900 bg-zinc-950/90 backdrop-blur sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-9 h-9 object-contain">
                <span class="text-lg font-bengkel tracking-wider text-white">Bengkel<span class="text-red-600">in</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-8 text-xs font-semibold uppercase tracking-widest text-zinc-400">
                <a href="{{ route('servis') }}" class="text-red-500">Servis</a>
                <a href="{{ route('toko.banmotor') }}" class="hover:text-white transition">Ban Motor</a>
                <a href="{{ route('toko.oli') }}" class="hover:text-white transition">Oli Motor</a>
                <a href="{{ route('toko.sparepart') }}" class="hover:text-white transition">Sparepart</a>
            </div>
            <div class="flex items-center gap-3">
                @include('partials.cart-widget')

                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @elseif (Auth::user()->role === 'mekanik')
                        <a href="{{ route('mekanik.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition">
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

    <div class="max-w-7xl mx-auto px-6 py-10">
        
        {{-- Breadcrumbs --}}
        <div class="flex items-center gap-2 text-xs text-zinc-500 uppercase tracking-widest mb-10">
            <a href="{{ route('servis') }}" class="hover:text-red-500 transition">Servis</a>
            <span>/</span>
            <span class="text-zinc-350 font-bold">{{ $service->nama }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            {{-- Column Left: Image --}}
            <div class="lg:col-span-6">
                <div class="relative bg-zinc-900 border border-zinc-800 rounded-[2.5rem] aspect-square flex items-center justify-center overflow-hidden group shadow-sm">
                    <img src="{{ $service->gambar_url }}" alt="{{ $service->nama }}" class="w-full h-full object-cover">
                </div>
            </div>

            {{-- Column Right: Detail Information --}}
            <div class="lg:col-span-6 space-y-8">
                <div class="space-y-3">
                    <span class="inline-block px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-widest bg-red-500/10 text-red-500 border border-red-500/20">
                        Layanan Servis
                    </span>
                    <h1 class="text-3xl lg:text-4xl font-bengkel tracking-wide uppercase text-white">
                        {{ $service->nama }}
                    </h1>
                    <div class="flex items-center gap-2 text-xs text-zinc-450">
                        <span>Estimasi: {{ $service->estimasi_waktu }}</span>
                        <span>•</span>
                        <span>Total Pekerjaan: {{ $service->items->count() }} Item</span>
                        <span>•</span>
                        <span>SKU: SRV-{{ str_pad($service->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                {{-- Price --}}
                <div class="border-y border-zinc-800 py-6">
                    <span class="text-xs text-zinc-500 uppercase font-bold tracking-widest block mb-2">Mulai Dari</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-lg font-bold text-white">Rp</span>
                        <span class="text-4xl font-bengkel tracking-wider text-red-500">
                            {{ number_format($service->harga_mulai, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                {{-- Specs Grid --}}
                <div class="grid grid-cols-2 gap-6 bg-zinc-900/60 border border-zinc-800/80 rounded-3xl p-6">
                    <div>
                        <span class="block text-[10px] text-zinc-500 font-bold uppercase tracking-widest">Estimasi Waktu</span>
                        <span class="block text-sm font-semibold mt-1">{{ $service->estimasi_waktu }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-zinc-500 font-bold uppercase tracking-widest">Detail Pekerjaan</span>
                        <span class="block text-sm font-semibold mt-1">{{ $service->items->count() }} Pekerjaan</span>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('booking.create', $service->slug) }}" class="flex-1 text-center bg-red-650 hover:bg-red-750 text-white font-semibold py-3.5 px-8 rounded-full transition text-sm uppercase tracking-wider shadow-lg shadow-red-950/20">
                        🔧 Booking Servis
                    </a>
                    
                    <a href="{{ route('servis') }}" class="flex-1 text-center border border-zinc-800 text-zinc-400 hover:text-white hover:bg-zinc-900/50 font-semibold py-3.5 px-8 rounded-full transition text-sm uppercase tracking-wider">
                        Kembali ke Daftar
                    </a>
                </div>

                {{-- Description --}}
                <div class="space-y-3 border-t border-zinc-800 pt-6">
                    <h3 class="text-xs text-zinc-500 font-bold uppercase tracking-widest">Deskripsi Layanan</h3>
                    <p class="text-sm text-zinc-350 leading-relaxed">
                        {{ $service->deskripsi }}
                    </p>
                </div>

                {{-- Details list --}}
                <div class="space-y-3 border-t border-zinc-800 pt-6">
                    <h3 class="text-xs text-zinc-500 font-bold uppercase tracking-widest">Yang Dikerjakan</h3>
                    @if($service->items->isEmpty())
                        <p class="text-zinc-650 text-sm italic">Belum ada detail pekerjaan.</p>
                    @else
                        <ul class="space-y-2.5 text-sm text-zinc-350">
                            @foreach($service->items as $item)
                                <li class="flex items-start gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>{{ $item->nama_pekerjaan }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                
            </div>
            
        </div>
        
    </div>
</div>
@endsection


