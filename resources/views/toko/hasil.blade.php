@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-3xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider">Hasil Pembelian</h1>
            <a href="{{ route('toko.index') }}" class="px-4 py-2 bg-zinc-800 rounded-md text-sm">Kembali ke Toko</a>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 space-y-2">
            <p><span class="text-zinc-500">Nama Barang:</span> {{ $purchase->barang_nama }}</p>
            <p><span class="text-zinc-500">Harga:</span> Rp {{ number_format($purchase->harga, 0, ',', '.') }}</p>
            <p><span class="text-zinc-500">Tanggal:</span> {{ $purchase->created_at }}</p>
        </div>
    </div>
</div>
@endsection
