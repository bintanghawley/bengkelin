@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white flex flex-col">
    <nav class="w-full border-b border-zinc-900/60 relative z-30">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-10 h-10 object-contain">
                <span class="text-xl font-bengkel tracking-wider">Bengkel<span class="text-red-600">in</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-10 text-xs font-semibold uppercase tracking-widest text-zinc-400">
                <a href="{{ route('home') }}" class="hover:text-white transition">Servis</a>
                <div class="relative group">
                    <button type="button" class="inline-flex items-center gap-1 hover:text-white transition" aria-haspopup="true">
                        Ban Motor
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-3 h-3">
                            <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full pt-2 w-64 opacity-0 translate-y-1 pointer-events-none transition group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:translate-y-0 group-focus-within:pointer-events-auto">
                        <div class="bg-white text-zinc-900 border border-zinc-200 rounded-2xl shadow-2xl py-3">
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Ban Motor Matic</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Ban Motor Bebek</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Ban Motor Sport</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Ban Motor Big Matic</a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <button type="button" class="inline-flex items-center gap-1 hover:text-white transition" aria-haspopup="true">
                        Oli Motor
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-3 h-3">
                            <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full pt-2 w-64 opacity-0 translate-y-1 pointer-events-none transition group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:translate-y-0 group-focus-within:pointer-events-auto">
                        <div class="bg-white text-zinc-900 border border-zinc-200 rounded-2xl shadow-2xl py-3">
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Oli Motor Matic</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Oli Motor Bebek</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Oli Motor Sport</a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <button type="button" class="inline-flex items-center gap-1 hover:text-white transition" aria-haspopup="true">
                        Sparepart
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-3 h-3">
                            <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full pt-2 w-64 opacity-0 translate-y-1 pointer-events-none transition group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:translate-y-0 group-focus-within:pointer-events-auto">
                        <div class="bg-white text-zinc-900 border border-zinc-200 rounded-2xl shadow-2xl py-3">
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Aki Motor</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Filter Udara Motor</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Kampas Rem</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-zinc-100">Cairan Anti Bocor</a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('home') }}#location" class="hover:text-white transition">Lokasi Toko</a>
                <a href="#" class="hover:text-white transition">Promo</a>
                <a href="#" class="hover:text-white transition">Buku Servis</a>
                <a href="#" class="hover:text-white transition">Blog</a>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Cari">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                        <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <a href="{{ route('toko.index') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Keranjang">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                        <path d="M6 6h15l-1.5 9h-12z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6 6l-2-3H2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="18" cy="20" r="1" />
                    </svg>
                </a>
                <div class="relative group">
                    <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Akun">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="absolute right-0 top-full pt-2 w-72 z-50 opacity-0 translate-y-1 pointer-events-none transition group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:translate-y-0 group-focus-within:pointer-events-auto">
                        <div class="bg-white text-zinc-900 border border-zinc-200 rounded-2xl shadow-2xl p-4 space-y-3">
                            <p class="text-sm font-semibold">Akun</p>
                            <a href="{{ route('login') }}" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-full transition">Login</a>
                            <a href="{{ route('register') }}" class="block w-full text-center border border-red-600 text-red-600 hover:bg-red-50 font-semibold py-2.5 rounded-full transition">Daftar Akun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex-1 flex items-center justify-center p-6">
        <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 bg-zinc-900 rounded-3xl overflow-hidden shadow-2xl border border-zinc-800">
        
        <div class="p-10 flex flex-col justify-center bg-red-600 shadow-inner relative overflow-hidden">
            <div class="absolute -bottom-10 -left-10 opacity-10 rotate-12">
                <svg viewBox="0 0 24 24" fill="white" class="w-64 h-64">
                    <path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8"/>
                </svg>
            </div>

            <div class="relative z-10">
                <h1 class="text-6xl font-bengkel tracking-wider leading-none mb-4 uppercase">Join The <br>Journey</h1>
                <p class="text-red-100 font-medium leading-relaxed">Daftar sekarang buat dapet pelayanan servis tercepat di SIDOARJO. Sat set, mesin awet!</p>
                
                <div class="mt-8 space-y-2">
                    <div class="flex items-center gap-1 text-xs font-bold text-red-900 uppercase tracking-widest bg-white/20 w-fit px-3 py-1 rounded-full">
                        ✓ Fast Booking
                    </div>
                    <div class="flex items-center gap-1 text-xs font-bold text-red-900 uppercase tracking-widest bg-white/20 w-fit px-3 py-1 rounded-full">
                        ✓ History Service
                    </div>
                </div>
            </div>
        </div>

        <div class="p-10 bg-zinc-900 flex flex-col justify-center">
            {{-- Tampilkan Error Validasi Jika Ada --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-500/10 border border-red-500/50 rounded-xl text-red-500 text-[10px] font-bold uppercase tracking-widest">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-1 ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap"
                           class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition text-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-1 ml-1">Nomor Telepon</label>
                    <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required placeholder="08xxxxxxxxxx"
                           inputmode="numeric" autocomplete="tel" maxlength="16" data-phone-input
                           class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition text-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-1 ml-1">Password</label>
                    <input type="password" name="password" required placeholder="Minimal 6 Karakter"
                           class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition text-sm">
                </div>
                
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl mt-4 shadow-lg shadow-red-900/20 transition active:scale-95 uppercase tracking-widest text-sm">
                    Create Account
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-zinc-500 uppercase tracking-widest">
                Already member? <a href="{{ route('login') }}" class="text-white font-bold hover:text-red-500 transition">Sign In Now</a>
            </p>
        </div>
    </div>
</div>
@endsection