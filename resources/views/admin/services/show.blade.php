@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-50 dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-gray-200 dark:border-zinc-800">
            <span class="text-3xl font-bengkel tracking-wider">ADMIN<span class="text-red-600">PANEL</span></span>
        </div>
        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">DASHBOARD</a>
            <a href="{{ route('admin.services.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-900/20 rounded-xl font-bold transition">KELOLA SERVIS</a>
        </nav>
        <div class="p-4 space-y-2 border-t border-gray-200 dark:border-zinc-800">
            <a href="{{ route('admin.services.index') }}" class="block text-center text-[10px] text-gray-500 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest border border-gray-300 dark:border-zinc-800 py-2 rounded-lg">← Kembali ke Daftar</a>
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-gray-500 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest border border-gray-300 dark:border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    {{-- Main --}}
    <main class="flex-1 ml-64 p-10 bg-zinc-950 min-h-screen">
        <div class="max-w-3xl">
            {{-- Header --}}
            <div class="flex items-start justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bengkel uppercase tracking-widest text-white">{{ $service->nama }}</h1>
                    <p class="text-zinc-500 text-xs mt-1 uppercase tracking-widest">Detail Layanan Servis</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.services.edit', $service->id) }}"
                       class="bg-amber-500 hover:bg-amber-600 text-black text-[10px] font-bold px-5 py-3 rounded-xl uppercase tracking-widest transition">
                        Edit
                    </a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus layanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-700 text-white text-[10px] font-bold px-5 py-3 rounded-xl uppercase tracking-widest transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            {{-- Gambar --}}
            <div class="bg-zinc-900 rounded-2xl border border-zinc-800 overflow-hidden mb-6">
                @if($service->gambar)
                    <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama }}"
                         class="w-full h-56 object-cover">
                @else
                    <div class="w-full h-56 bg-gradient-to-br from-zinc-800 to-zinc-900 flex items-center justify-center">
                        <span class="text-zinc-600 text-sm uppercase tracking-widest">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            {{-- Info Cards --}}
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5">
                    <p class="text-[9px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Harga Mulai</p>
                    <p class="text-xl font-bengkel text-emerald-500">Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}</p>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5">
                    <p class="text-[9px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Estimasi</p>
                    <p class="text-xl font-bengkel text-white">{{ $service->estimasi_waktu }}</p>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5">
                    <p class="text-[9px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Total Pekerjaan</p>
                    <p class="text-xl font-bengkel text-red-500">{{ $service->items->count() }} Item</p>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 mb-6">
                <p class="text-[9px] text-zinc-500 uppercase font-bold tracking-widest mb-3">Deskripsi</p>
                <p class="text-zinc-300 text-sm leading-relaxed">{{ $service->deskripsi }}</p>
            </div>

            {{-- Item Pekerjaan --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                <p class="text-[9px] text-zinc-500 uppercase font-bold tracking-widest mb-4">Yang Dikerjakan</p>
                @if($service->items->isEmpty())
                    <p class="text-zinc-600 text-sm italic">Belum ada item pekerjaan.</p>
                @else
                    <ul class="space-y-3">
                        @foreach($service->items as $item)
                        <li class="flex items-center gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-900/30 border border-emerald-700 flex items-center justify-center">
                                <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text-sm text-zinc-300">{{ $item->nama_pekerjaan }}</span>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Meta --}}
            <div class="mt-4 text-[10px] text-zinc-700 text-right uppercase tracking-widest">
                Slug: <span class="text-zinc-600">{{ $service->slug }}</span>
                &nbsp;·&nbsp; Dibuat: {{ $service->created_at->format('d M Y') }}
                &nbsp;·&nbsp; Diperbarui: {{ $service->updated_at->format('d M Y') }}
            </div>
        </div>
    </main>
</div>
@endsection


