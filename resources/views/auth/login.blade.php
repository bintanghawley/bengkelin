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
        
        <div class="p-10 flex flex-col justify-center bg-zinc-800/50">
            <div class="h-16 w-16 bg-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(220,38,38,0.4)] -rotate-12">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-10 h-10 text-white">
                    <path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="18" r="1"/>
                </svg>
            </div>
            <h1 class="text-5xl font-bengkel tracking-wider mb-2">Welcome to <br><span class="text-red-600">Bengkelin</span></h1>
            <p class="text-zinc-400 text-sm leading-relaxed mb-8">Solusi setiap masalah MotorMu. Sign In untuk mendapatkan pengalaman paling seru dalam booking.</p>
            
            <div class="space-y-4">
                <div class="flex items-center gap-3 text-sm text-zinc-300">
                    <span class="w-2 h-2 bg-red-600 rounded-full shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span> Solusi setiap masalah motormu
                </div>
                <div class="flex items-center gap-3 text-sm text-zinc-300">
                    <span class="w-2 h-2 bg-red-600 rounded-full shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span> Jaminan Sparepart Asli
                </div>
            </div>
        </div>

        <div class="p-10 flex flex-col justify-center border-t md:border-t-0 md:border-l border-zinc-800">
            
            {{-- ALERT BERHASIL DAFTAR (DARI REGISTER) --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/50 rounded-xl text-emerald-500 text-xs font-bold flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ALERT GAGAL LOGIN (NOMOR TELEPON/PASS SALAH) --}}
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-xl text-red-500 text-xs font-bold flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-[0.2em] mb-2 ml-1">Nomor Telepon</label>
                    <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required placeholder="08xxxxxxxxxx"
                           inputmode="numeric" autocomplete="tel" maxlength="16" data-phone-input
                           class="w-full bg-zinc-800/50 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition placeholder:text-zinc-600">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-[0.2em] mb-2 ml-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" 
                           class="w-full bg-zinc-800/50 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition placeholder:text-zinc-600">
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-red-900/40 transition active:scale-95 uppercase tracking-widest text-sm">
                    Sign In     
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-zinc-800 space-y-4 text-center">
                <p class="text-zinc-500 text-xs">Belum punya akun Bengkelin?</p>
                <a href="{{ route('register') }}" class="block w-full border border-zinc-700 hover:bg-zinc-800 hover:text-white text-zinc-300 font-bold py-3 rounded-xl transition uppercase tracking-widest text-xs">
                    Daftar Dulu
                </a>
                <a href="#" class="inline-block text-[10px] text-zinc-600 hover:text-red-500 uppercase tracking-widest transition">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
@endsection