@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-3xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel tracking-wider">Buat Booking</h1>
            <a href="{{ route('pengguna.dashboard') }}" class="px-4 py-2 bg-zinc-800 rounded-md text-sm">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-900/30 border border-red-700 text-red-300 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengguna.booking.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Jenis Motor</label>
                <input type="text" name="jenis_motor" value="{{ old('jenis_motor') }}" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Layanan</label>
                <input type="text" name="layanan" value="{{ old('layanan') }}" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Metode</label>
                <input type="text" name="metode" value="{{ old('metode') }}" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-red-600 px-4 py-2 rounded">Simpan Booking</button>
        </form>
    </div>
</div>
@endsection
