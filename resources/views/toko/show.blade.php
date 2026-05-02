@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-3xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider">Detail Barang</h1>
            <a href="{{ route('toko.index') }}" class="px-4 py-2 bg-zinc-800 rounded-md text-sm">Kembali</a>
        </div>

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
            <h2 class="text-2xl font-bengkel mb-2">{{ $item['nama'] }}</h2>
            <p class="text-red-500 font-bold mb-4">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
            <p class="text-zinc-400 mb-6">{{ $item['deskripsi'] }}</p>

            <form action="{{ route('toko.buy', $item['id']) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 rounded">Beli Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection
