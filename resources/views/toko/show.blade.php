@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">
    <div class="max-w-3xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider text-zinc-900 dark:text-white">Detail Barang</h1>
            <a href="{{ route('toko.index') }}" class="px-4 py-2 bg-zinc-200 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-700 text-zinc-900 dark:text-white rounded-md text-sm border border-zinc-300 dark:border-zinc-700 transition">Kembali</a>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm transition-colors duration-300">
            <h2 class="text-2xl font-bengkel text-zinc-900 dark:text-white mb-2">{{ $item['nama'] }}</h2>
            <p class="text-red-500 font-bold mb-4">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
            <p class="text-zinc-600 dark:text-zinc-400 mb-6">{{ $item['deskripsi'] }}</p>

            <form action="{{ route('toko.buy', $item['id']) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 rounded">Beli Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection
