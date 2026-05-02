@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider">Daftar Barang</h1>
            <a href="{{ route('home') }}" class="px-4 py-2 bg-zinc-800 rounded-md text-sm">Kembali ke Beranda</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5">
                    <h2 class="text-xl font-bengkel text-white mb-2">{{ $item['nama'] }}</h2>
                    <p class="text-red-500 font-bold mb-4">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                    <div class="flex gap-2">
                        <a href="{{ route('toko.show', $item['id']) }}" class="px-3 py-2 bg-zinc-800 rounded text-sm">Detail</a>
                        <form action="{{ route('toko.buy', $item['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-2 bg-red-600 rounded text-sm">Beli</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
