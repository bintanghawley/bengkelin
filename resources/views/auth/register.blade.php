@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white flex flex-col transition-colors duration-300">
    <div class="flex-1 flex items-center justify-center p-6 pt-4">
        <div class="max-w-4xl w-full min-h-[540px] grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden shadow-2xl border border-zinc-200 dark:border-zinc-800 transition-colors duration-300">
        
        <div class="p-10 flex flex-col justify-center bg-red-600 shadow-inner relative overflow-hidden">
            <!-- Kembali ke Home Button -->
            <div class="mb-8 relative z-10">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 text-[10px] uppercase tracking-[0.2em] font-bold text-white transition-all duration-300 border border-white/30 hover:border-white rounded-full px-4 py-2 bg-white/15 hover:bg-white/25 shadow-sm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 transform transition-transform duration-300 group-hover:-translate-x-1 text-white">
                        <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-white">Kembali ke Home</span>
                </a>
            </div>
            <div class="absolute -bottom-10 -left-10 opacity-10 rotate-12">
                <svg viewBox="0 0 24 24" fill="white" class="w-64 h-64">
                    <path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8"/>
                </svg>
            </div>

            <div class="relative z-10">
                <h1 class="text-6xl font-bengkel tracking-wider leading-none mb-4 uppercase">Join The <br>Journey</h1>
                <p class="text-red-100 font-medium leading-relaxed">Daftar sekarang buat dapet pelayanan servis tercepat di SIDOARJO. Sat set, mesin awet!</p>
                
                <div class="mt-8 space-y-2">
                    <div class="flex items-center gap-1.5 text-xs font-bold text-white uppercase tracking-widest bg-white/15 border border-white/10 w-fit px-4 py-1.5 rounded-full shadow-sm">
                        ✓ Booking Cepat
                    </div>
                    <div class="flex items-center gap-1.5 text-xs font-bold text-white uppercase tracking-widest bg-white/15 border border-white/10 w-fit px-4 py-1.5 rounded-full shadow-sm">
                        ✓ Riwayat Servis
                    </div>
                </div>
            </div>
        </div>

        <div class="p-10 bg-white dark:bg-zinc-900 flex flex-col justify-center transition-colors duration-300">
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap"
                           class="w-full bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-3 text-base text-zinc-900 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition-all duration-200 placeholder:text-zinc-400 dark:placeholder:text-zinc-500">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-[0.2em] mb-2 ml-1">Nomor Telepon</label>
                    <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required placeholder="08xxxxxxxxxx"
                           inputmode="numeric" autocomplete="tel" maxlength="16" data-phone-input
                           class="w-full bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-3 text-base text-zinc-900 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition-all duration-200 placeholder:text-zinc-400 dark:placeholder:text-zinc-500">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-[0.2em] mb-2 ml-1">Password</label>
                    <input type="password" name="password" required placeholder="Minimal 6 Karakter"
                           class="w-full bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-3 text-base text-zinc-900 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition-all duration-200 placeholder:text-zinc-400 dark:placeholder:text-zinc-500">
                </div>
                
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl mt-4 shadow-lg shadow-red-900/20 transition active:scale-95 uppercase tracking-widest text-sm">
                    Buat Akun
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-zinc-900 dark:text-white font-bold hover:text-red-500 transition">Masuk Sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection