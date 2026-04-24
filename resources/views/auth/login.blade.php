@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 bg-zinc-900 rounded-3xl overflow-hidden shadow-2xl border border-zinc-800">
        
        <div class="p-10 flex flex-col justify-center bg-zinc-800/50">
            <div class="h-16 w-16 bg-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(220,38,38,0.4)]">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-10 h-10 text-white">
                    <path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="18" r="1"/>
                </svg>
            </div>
            <h1 class="text-5xl font-bengkel tracking-wider mb-2">Welcome to <br><span class="text-red-600">Bengkelin</span></h1>
            <p class="text-zinc-400 text-sm leading-relaxed mb-8">Solusi setiap masalah MotorMu. Sign In untuk mendapatkan pengalaman paling seru dalam booking.</p>
            
            <div class="space-y-4">
                <div class="flex items-center gap-3 text-sm text-zinc-300">
                    <span class="w-2 h-2 bg-red-600 rounded-full"></span> Solusi setiap masalah motormu
                </div>
                <div class="flex items-center gap-3 text-sm text-zinc-300">
                    <span class="w-2 h-2 bg-red-600 rounded-full"></span> Jaminan Sparepart Asli
                </div>
            </div>
        </div>

        <div class="p-10 flex flex-col justify-center border-t md:border-t-0 md:border-l border-zinc-800">
            @if(session('success'))
                <div class="mb-6 p-3 bg-emerald-500/10 border border-emerald-500/50 rounded-lg text-emerald-500 text-xs">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full bg-zinc-800 border-0 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-widest mb-2">Password</label>
                    <input type="password" name="password" required class="w-full bg-zinc-800 border-0 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition">
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-red-900/20 transition active:scale-95">
                    Sign In
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-zinc-800 space-y-4 text-center">
                <a href="{{ route('register') }}" class="block w-full border border-zinc-700 hover:bg-zinc-800 text-zinc-300 font-semibold py-3 rounded-xl transition">
                    Create Account
                </a>
                <a href="#" class="inline-block text-xs text-zinc-500 hover:text-white uppercase tracking-tighter transition">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
@endsection