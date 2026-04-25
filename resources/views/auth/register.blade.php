@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
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
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-1 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com"
                           class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition text-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-1 ml-1">Gender</label>
                    <select name="jenis_kelamin" required 
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition text-sm appearance-none">
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
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