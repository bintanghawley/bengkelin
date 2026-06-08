@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white flex flex-col transition-colors duration-300">
    <div class="flex-1 flex items-center justify-center p-6 pt-4">
        <div class="max-w-4xl w-full min-h-[540px] grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden shadow-2xl border border-zinc-200 dark:border-zinc-800 transition-colors duration-300">
        
        <div class="p-10 flex flex-col justify-center bg-zinc-50/50 dark:bg-zinc-800/50 border-r border-zinc-100 dark:border-zinc-800">
            <!-- Kembali ke Home Button -->
            <div class="mb-8">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 text-[10px] uppercase tracking-[0.2em] font-semibold text-zinc-500 hover:text-zinc-900 dark:hover:text-white transition-all duration-300 border border-zinc-200 dark:border-zinc-800 hover:border-red-600 rounded-full px-4 py-2 bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm shadow-sm hover:shadow-red-600/10">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 transform transition-transform duration-300 group-hover:-translate-x-1">
                        <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Kembali ke Home</span>
                </a>
            </div>

            <div class="h-16 w-16 bg-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(220,38,38,0.4)] -rotate-12">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-10 h-10 text-white">
                    <path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="18" r="1"/>
                </svg>
            </div>
            <h1 class="text-5xl font-bengkel tracking-wider mb-2 text-zinc-900 dark:text-white">Welcome to <br><span class="text-red-600">Bengkelin</span></h1>
            <p class="text-zinc-600 dark:text-zinc-400 text-sm leading-relaxed mb-8">Solusi setiap masalah MotorMu. Sign In untuk mendapatkan pengalaman paling seru dalam booking.</p>
            
            <div class="space-y-4">
                <div class="flex items-center gap-3 text-sm text-zinc-700 dark:text-zinc-300">
                    <span class="w-2 h-2 bg-red-600 rounded-full shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span> Solusi setiap masalah motormu
                </div>
                <div class="flex items-center gap-3 text-sm text-zinc-700 dark:text-zinc-300">
                    <span class="w-2 h-2 bg-red-600 rounded-full shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span> Jaminan Sparepart Asli
                </div>
            </div>
        </div>

        <div class="p-10 flex flex-col justify-center border-t md:border-t-0 md:border-l border-zinc-200 dark:border-zinc-800">
            
            {{-- ALERT BERHASIL DAFTAR (DARI REGISTER) --}}
            @if(session('success'))
                <div class="fixed top-6 right-6 z-[60] max-w-md p-4 bg-emerald-500/10 border border-emerald-500/50 rounded-xl text-emerald-500 text-xs font-bold flex items-center gap-3 shadow-xl backdrop-blur-md animate-toast">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- ALERT GAGAL LOGIN (NOMOR TELEPON/PASS SALAH) --}}
            @if(session('error'))
                <div class="fixed top-6 right-6 z-[60] max-w-md p-4 bg-red-500/10 border border-red-500/50 rounded-xl text-red-500 text-xs font-bold flex items-center gap-3 shadow-xl backdrop-blur-md animate-toast">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-[0.2em] mb-2 ml-1">Nomor Telepon</label>
                    <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required placeholder="08xxxxxxxxxx"
                           inputmode="numeric" autocomplete="tel" maxlength="16" data-phone-input
                           class="w-full bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-3 text-base text-zinc-900 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition-all duration-200 placeholder:text-zinc-400 dark:placeholder:text-zinc-500">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-[0.2em] mb-2 ml-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" 
                           class="w-full bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl px-4 py-3 text-base text-zinc-900 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition-all duration-200 placeholder:text-zinc-400 dark:placeholder:text-zinc-500">
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-red-900/40 transition active:scale-95 uppercase tracking-widest text-sm">
                    Masuk     
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-zinc-200 dark:border-zinc-800 space-y-4 text-center">
                <p class="text-zinc-500 dark:text-zinc-400 text-xs">Belum punya akun Bengkelin?</p>
                <a href="{{ route('register') }}" class="block w-full border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300 font-bold py-3 rounded-xl transition uppercase tracking-widest text-xs">
                    Daftar Dulu
                </a>
            </div>
        </div>
    </div>
</div>
@endsection