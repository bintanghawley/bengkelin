@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">
    <div class="max-w-3xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider text-zinc-900 dark:text-white">Hasil Pembelian</h1>
            <a href="{{ route('toko.index') }}" class="px-4 py-2 bg-zinc-200 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-700 text-zinc-900 dark:text-white rounded-md text-sm border border-zinc-300 dark:border-zinc-700 transition">Kembali ke Toko</a>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 space-y-2 shadow-sm transition-colors duration-300">
            <p><span class="text-zinc-500 dark:text-zinc-400">Nama Barang:</span> <span class="text-zinc-900 dark:text-white font-medium">{{ $purchase->barang_nama }}</span></p>
            <p><span class="text-zinc-500 dark:text-zinc-400">Harga:</span> <span class="text-zinc-900 dark:text-white font-medium">Rp {{ number_format($purchase->harga, 0, ',', '.') }}</span></p>
            <p><span class="text-zinc-500 dark:text-zinc-400">Tanggal:</span> <span class="text-zinc-900 dark:text-white font-medium">{{ $purchase->created_at }}</span></p>
        </div>
    </div>
</div>
@endsection
