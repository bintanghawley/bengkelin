@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">

    {{-- Navbar mini --}}
    <nav class="w-full border-b border-zinc-200 dark:border-zinc-800 bg-white/90 dark:bg-zinc-950/90 backdrop-blur relative z-30">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-9 h-9 object-contain">
                <span class="text-lg font-bengkel tracking-wider text-zinc-900 dark:text-white">Bengkel<span class="text-red-600">in</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-8 text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                <a href="{{ route('toko.banmotor') }}" class="hover:text-zinc-900 dark:hover:text-white transition">Ban Motor</a>
                <a href="{{ route('toko.oli') }}" class="hover:text-zinc-900 dark:hover:text-white transition">Oli Motor</a>
                <a href="{{ route('toko.sparepart') }}" class="text-red-600 dark:text-red-400">Sparepart</a>
            </div>
            <div class="flex items-center gap-3">
                @include('partials.cart-widget')
                <button type="button" class="theme-toggle-btn inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition">
                    <svg class="theme-toggle-dark-icon hidden w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/></svg>
                    <svg class="theme-toggle-light-icon hidden w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 5a7 7 0 100 14 7 7 0 000-14z"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">
        
        {{-- Breadcrumbs --}}
        <div class="flex items-center gap-2 text-xs text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-10">
            <a href="{{ route('toko.sparepart') }}" class="hover:text-blue-600 transition">Sparepart Motor</a>
            <span>/</span>
            <span class="hover:text-blue-600 transition">{{ $sparepart->merek }}</span>
            <span>/</span>
            <span class="text-zinc-700 dark:text-zinc-300 font-bold">{{ $sparepart->nama }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            {{-- Column Left: Image (Single Cover) --}}
            <div class="lg:col-span-6">
                <div class="relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-[2.5rem] aspect-square flex items-center justify-center p-8 group shadow-sm">
                    @if($sparepart->gambar)
                        <img src="{{ asset('storage/' . $sparepart->gambar) }}" alt="{{ $sparepart->nama }}" class="max-h-full max-w-full object-contain">
                    @else
                        {{-- Empty Placeholder --}}
                        <div class="w-full h-full border-2 border-dashed border-zinc-200 dark:border-zinc-800 rounded-2xl flex flex-col items-center justify-center text-zinc-400 dark:text-zinc-650 gap-3">
                            <svg class="w-16 h-16 stroke-[1.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-xs uppercase tracking-widest font-bold">Foto Sparepart Belum Tersedia</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Column Right: Specs & Actions --}}
            <div class="lg:col-span-6 space-y-8">
                <div class="space-y-3">
                    <span class="inline-block px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-widest bg-blue-500/10 text-blue-600 dark:text-blue-400">
                        {{ $sparepart->merek }}
                    </span>
                    <h1 class="text-3xl lg:text-4xl font-bengkel tracking-wide uppercase text-zinc-900 dark:text-white">
                        {{ $sparepart->nama }}
                    </h1>
                    <div class="flex items-center gap-2 text-xs text-zinc-400">
                        <span>Belum Ada Ulasan</span>
                        <span>•</span>
                        <span>Belum Terjual</span>
                        <span>•</span>
                        <span>SKU: SP-{{ str_pad($sparepart->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                {{-- Price --}}
                <div class="border-y border-zinc-200 dark:border-zinc-800 py-6">
                    <div class="flex items-baseline gap-1">
                        <span class="text-lg font-bold text-zinc-900 dark:text-white">Rp</span>
                        <span class="text-4xl font-bengkel tracking-wider text-zinc-900 dark:text-white">
                            {{ number_format($sparepart->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                {{-- Specs Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 bg-white dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800/80 rounded-3xl p-6">
                    <div>
                        <span class="block text-[10px] text-zinc-400 dark:text-zinc-500 font-bold uppercase tracking-widest">Kategori</span>
                        <span class="block text-sm font-semibold mt-1 capitalize">{{ $sparepart->jenis_sparepart }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-zinc-400 dark:text-zinc-500 font-bold uppercase tracking-widest">Merek</span>
                        <span class="block text-sm font-semibold mt-1">{{ $sparepart->merek }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-zinc-400 dark:text-zinc-500 font-bold uppercase tracking-widest">Stok</span>
                        <span class="block text-sm font-semibold mt-1 {{ $sparepart->stok > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600' }}">
                            {{ $sparepart->stok > 0 ? $sparepart->stok . ' Pcs' : 'Habis' }}
                        </span>
                    </div>
                </div>

                {{-- Promo banner text --}}
                <p class="text-xs text-blue-600 dark:text-blue-400 font-bold">
                    Ganti / Pasang Sparepart {{ $sparepart->nama }} Langsung di Bengkelin Untuk Jaminan Keaslian Produk 100%
                </p>

                {{-- Action buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('toko.sparepart.checkout', $sparepart->id) }}" class="flex-1 text-center border border-blue-600 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/10 font-semibold py-3.5 px-8 rounded-full transition text-sm uppercase tracking-wider">
                        Beli Langsung
                    </a>
                    
                    <button 
                        type="button"
                        onclick='addToCart({
                            id: "sp-{{ $sparepart->id }}",
                            nama: {{ json_encode($sparepart->nama) }},
                            harga: {{ $sparepart->harga }},
                            gambar: "{{ $sparepart->gambar ? asset("storage/".$sparepart->gambar) : "" }}",
                            kategori: "Sparepart"
                        })'
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 px-8 rounded-full transition flex items-center justify-center gap-2 text-sm uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        + Keranjang
                    </button>
                </div>

                {{-- Description --}}
                <div class="space-y-3 border-t border-zinc-200 dark:border-zinc-800 pt-6">
                    <h3 class="text-xs text-zinc-400 dark:text-zinc-500 font-bold uppercase tracking-widest">Deskripsi</h3>
                    <p class="text-sm text-zinc-650 dark:text-zinc-300 leading-relaxed">
                        {{ $sparepart->deskripsi ?: 'Tidak ada deskripsi untuk produk ini.' }}
                    </p>
                </div>

                {{-- Product Features --}}
                @if($sparepart->fitur)
                    <div class="space-y-3 border-t border-zinc-200 dark:border-zinc-800 pt-6">
                        <h3 class="text-xs text-zinc-400 dark:text-zinc-500 font-bold uppercase tracking-widest">Keunggulan &amp; Fitur</h3>
                        <ul class="space-y-2.5 text-sm text-zinc-650 dark:text-zinc-350">
                            @foreach(explode(',', $sparepart->fitur) as $ft)
                                @if(trim($ft))
                                    <li class="flex items-start gap-2.5">
                                        <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>{{ trim($ft) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
                
            </div>
            
        </div>
        
    </div>
</div>
@endsection
