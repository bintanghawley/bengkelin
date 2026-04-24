@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 bg-zinc-900 rounded-3xl overflow-hidden shadow-2xl border border-zinc-800">
        
        <div class="p-10 flex flex-col justify-center bg-red-600 shadow-inner">
            <h1 class="text-6xl font-bengkel tracking-wider leading-none mb-4">Join The <br>Crew</h1>
            <p class="text-red-100 font-medium">Daftar sekarang buat dapet pelayanan servis tercepat di SIDOARJO.</p>
        </div>

        <div class="p-10">
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-widest mb-1">Full Name</label>
                    <input type="text" name="name" required class="w-full bg-zinc-800 border-0 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-widest mb-1">Email</label>
                    <input type="email" name="email" required class="w-full bg-zinc-800 border-0 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-widest mb-1">Password</label>
                    <input type="password" name="password" required class="w-full bg-zinc-800 border-0 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-red-600 outline-none transition">
                </div>
                
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl mt-4 transition active:scale-95">
                    Register Now
                </button>
            </form>
            <p class="mt-6 text-center text-xs text-zinc-500">
                Already member? <a href="{{ route('login') }}" class="text-white font-bold hover:underline">Sign In</a>
            </p>
        </div>
    </div>
</div>
@endsection