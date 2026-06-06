@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bengkel tracking-wider text-zinc-900 dark:text-white">TOKO<span class="text-red-600">ONLINE</span></h1>
                <p class="text-xs text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mt-1">Temukan kebutuhan motor kamu</p>
            </div>
            <a href="{{ route('home') }}" class="px-5 py-2.5 bg-zinc-200 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-xl text-xs font-bold border border-zinc-300 dark:border-zinc-700 transition uppercase tracking-widest">← Beranda</a>
        </div>

        {{-- Kategori Nav --}}
        <nav class="flex flex-wrap gap-3 mb-10">
            <a href="{{ route('toko.index') }}"
               class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest border transition-all duration-200
               {{ !$kategori ? 'bg-red-600 text-white border-red-600 shadow-lg shadow-red-600/20' : 'bg-white dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 border-zinc-200 dark:border-zinc-800 hover:border-red-500 hover:text-red-600 dark:hover:text-red-400' }}">
                Semua
            </a>
            <a href="{{ route('toko.index', ['kategori' => 'sparepart']) }}"
               class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest border transition-all duration-200
               {{ $kategori === 'sparepart' ? 'bg-red-600 text-white border-red-600 shadow-lg shadow-red-600/20' : 'bg-white dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 border-zinc-200 dark:border-zinc-800 hover:border-red-500 hover:text-red-600 dark:hover:text-red-400' }}">
                🔧 Sparepart
            </a>
            <a href="{{ route('toko.index', ['kategori' => 'ban']) }}"
               class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest border transition-all duration-200
               {{ $kategori === 'ban' ? 'bg-red-600 text-white border-red-600 shadow-lg shadow-red-600/20' : 'bg-white dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 border-zinc-200 dark:border-zinc-800 hover:border-red-500 hover:text-red-600 dark:hover:text-red-400' }}">
                🛞 Ban Motor
            </a>
            <a href="{{ route('toko.index', ['kategori' => 'oli']) }}"
               class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest border transition-all duration-200
               {{ $kategori === 'oli' ? 'bg-red-600 text-white border-red-600 shadow-lg shadow-red-600/20' : 'bg-white dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 border-zinc-200 dark:border-zinc-800 hover:border-red-500 hover:text-red-600 dark:hover:text-red-400' }}">
                🛢️ Oli Motor
            </a>
        </nav>

        {{-- Jumlah hasil --}}
        <p class="text-xs text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-6">
            Menampilkan <span class="text-zinc-900 dark:text-white font-bold">{{ $products->count() }}</span> produk
            @if($kategori)
                untuk kategori <span class="text-red-600 font-bold">{{ $kategori }}</span>
            @endif
        </p>

        {{-- Product Grid --}}
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="group bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-red-500/30 dark:hover:border-red-500/30 transition-all duration-300">

                {{-- Gambar --}}
                <div class="relative aspect-square bg-zinc-100 dark:bg-zinc-800 overflow-hidden">
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-zinc-300 dark:text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Badge Kategori --}}
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[9px] font-bold uppercase tracking-wider
                        {{ $product->kategori === 'ban' ? 'bg-blue-500/90 text-white' : '' }}
                        {{ $product->kategori === 'oli' ? 'bg-amber-500/90 text-white' : '' }}
                        {{ $product->kategori === 'sparepart' ? 'bg-emerald-500/90 text-white' : '' }}
                    ">
                        {{ $product->kategori }}
                    </span>

                    {{-- Badge Stok --}}
                    @if($product->stok <= 3)
                    <span class="absolute top-3 right-3 px-2.5 py-1 rounded-lg text-[9px] font-bold uppercase tracking-wider bg-red-500/90 text-white">
                        Sisa {{ $product->stok }}
                    </span>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-5 space-y-3">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white uppercase tracking-wide leading-tight line-clamp-2">{{ $product->nama }}</h2>

                    @if($product->deskripsi)
                        <p class="text-xs text-zinc-400 dark:text-zinc-500 line-clamp-2 leading-relaxed">{{ $product->deskripsi }}</p>
                    @endif

                    <div class="flex items-center justify-between pt-1">
                        <span class="text-lg font-bengkel text-red-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                        <span class="text-[10px] text-zinc-400 dark:text-zinc-600 uppercase">Stok: {{ $product->stok }}</span>
                    </div>

                    <div class="flex gap-2 pt-1">
                        <a href="{{ route('toko.show', $product->id) }}"
                           class="flex-1 text-center px-3 py-2.5 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-xl text-[10px] font-bold uppercase tracking-widest transition">
                            Detail
                        </a>
                        <a href="{{ route('toko.checkout', $product->id) }}" class="flex-1 text-center px-3 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-[10px] font-bold uppercase tracking-widest transition shadow-lg shadow-red-600/20">
                            Beli
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <svg class="w-20 h-20 text-zinc-200 dark:text-zinc-800 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h3 class="text-lg font-bengkel text-zinc-400 dark:text-zinc-600 uppercase tracking-widest mb-2">Produk Tidak Ditemukan</h3>
            <p class="text-xs text-zinc-400 dark:text-zinc-600">
                @if($kategori)
                    Belum ada produk di kategori <span class="font-bold">{{ $kategori }}</span>.
                @else
                    Belum ada produk di toko.
                @endif
            </p>
            @if($kategori)
                <a href="{{ route('toko.index') }}" class="mt-6 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-[10px] font-bold uppercase tracking-widest transition">Lihat Semua Produk</a>
            @endif
        </div>
        @endif

    </div>
</div>
@endsection
