@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen bg-zinc-950 text-white font-sans">
    <aside class="w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-zinc-800/50">
            <span class="text-3xl font-bengkel tracking-wider">MEKANIK<span class="text-red-600">PANEL</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <div class="w-full flex items-center gap-3 px-4 py-3 hover:text-red-800 focus:text-red-600 outline-none text-white rounded-xl font-bold transition">
                DASHBOARD   
            </div>
            <div class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-800 focus:text-red-600 outline-none rounded-xl font-bold transition">
                DATA BOOKING
            </div>
        </nav>

        <div class="p-4 border-t border-zinc-800">
            <a href="{{ route('home') }}" class="block w-full text-center text-[10px] text-zinc-500 hover:text-white uppercase tracking-widest border border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider">Dashboard Mekanik</h1>
        </div>

        @if (session('success'))
            <div class="bg-emerald-900/30 border border-emerald-700 text-emerald-300 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-900/30 border border-red-700 text-red-300 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @include('mekanik.booking.index')
    </main>
</div>
@endsection
