@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider">Dashboard Mekanik</h1>
            <a href="{{ route('home') }}" class="px-4 py-2 bg-zinc-800 rounded-md text-sm">Kembali ke Beranda</a>
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
    </div>
</div>
@endsection
