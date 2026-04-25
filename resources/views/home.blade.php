@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950">
    <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <div class="h-10 w-10 bg-red-600 rounded-lg flex items-center justify-center shadow-[0_0_15px_rgba(220,38,38,0.4)] -rotate-12">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6 text-white">
                    <path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="text-2xl font-bengkel tracking-wider">Bengkel<span class="text-red-600">in</span></span>
        </div>
        <div class="hidden md:flex gap-8 text-xs font-semibold uppercase tracking-widest text-zinc-400">
            <a href="#" class="hover:text-white transition">Services</a>
            <a href="#" class="hover:text-white transition">Spareparts</a>
            <a href="#" class="hover:text-white transition">About</a>
        </div>
        <div>
            <a href="{{ route('login') }}" class="text-sm font-bold border border-zinc-700 px-6 py-2 rounded-full hover:bg-zinc-800 transition">LOGIN</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-8 py-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 text-center lg:text-left">
            <div class="inline-block px-4 py-1 rounded-full bg-red-600/10 border border-red-600/20 text-red-500 text-xs font-bold tracking-[0.2em] mb-6">
                PREMIUM GARAGE SERVICE
            </div>
            <h1 class="text-7xl md:text-8xl font-bengkel leading-none tracking-tight mb-6">
                KEEP YOUR ENGINE <br> <span class="text-red-600">PERFORMANCE</span>
            </h1>
            <p class="text-zinc-400 text-lg max-w-lg mx-auto lg:mx-0 mb-10 leading-relaxed">
                Solusi servis kendaraan sat-set tanpa antre. Mekanik pro, sparepart ori, harga gak bikin dompet mati.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold px-10 py-4 rounded-xl shadow-lg shadow-red-900/20 transition active:scale-95 text-center">
                    BOOKING SEKARANG
                </a>
                <a href="#" class="w-full sm:w-auto bg-zinc-800 hover:bg-zinc-700 text-white font-bold px-10 py-4 rounded-xl transition text-center border border-zinc-700">
                    LIHAT LAYANAN
                </a>
            </div>

            <div class="mt-16 grid grid-cols-3 gap-8 border-t border-zinc-900 pt-8">
                <div>
                    <p class="text-3xl font-bengkel text-white">500+</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-widest mt-1">Customers</p>
                </div>
                <div>
                    <p class="text-3xl font-bengkel text-white">10+</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-widest mt-1">Expert Mechanics</p>
                </div>
                <div>
                    <p class="text-3xl font-bengkel text-white">24/7</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-widest mt-1">Support</p>
                </div>
            </div>
        </div>

        <div class="order-1 lg:order-2 relative">
            <div class="absolute -inset-1 bg-red-600 rounded-3xl blur opacity-10"></div>
            <div class="relative bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden aspect-video lg:aspect-square flex items-center justify-center group">
                <svg viewBox="0 0 24 24 " fill="none" stroke="currentColor" class="w-64 h-64 text-zinc-800 group-hover:text-red-600/20 transition duration-700">
                   <img src="{{ asset ('img/Gemini_Generated_Image_rlwfwprlwfwprlwf.png') }}" alt="Gambar">
            </svg>
                <div class="absolute bottom-8 right-8 text-right">
                    <p class="text-zinc-600 text-6xl font-bengkel opacity-100 uppercase leading-none">Bengkelin<br>Sidoarjo</p>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection