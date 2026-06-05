@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans">

    {{-- Sidebar Admin --}}
    <aside class="w-64 bg-gray-50 dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-gray-200 dark:border-zinc-800">
            <span class="text-3xl font-bengkel tracking-wider">ADMIN<span class="text-red-600">PANEL</span></span>
        </div>
        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 text-gray-500 dark:text-zinc-400 hover:text-red-800 rounded-xl font-bold transition">
                DASHBOARD
            </a>
            <a href="{{ route('admin.services.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-900/20 rounded-xl font-bold transition">
                KELOLA SERVIS
            </a>
        </nav>
        <div class="p-4 space-y-2 border-t border-gray-200 dark:border-zinc-800">
            <a href="{{ route('admin.dashboard') }}" class="block text-center text-[10px] text-gray-500 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest border border-gray-300 dark:border-zinc-800 py-2 rounded-lg">Kembali ke Admin</a>
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-gray-500 dark:text-zinc-500 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest border border-gray-300 dark:border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 ml-64 p-10 bg-zinc-950 min-h-screen">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-900/30 border border-emerald-700 text-emerald-400 px-6 py-4 rounded-2xl text-sm font-semibold">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bengkel uppercase tracking-widest text-white">Kelola Layanan Servis</h1>
                <p class="text-zinc-500 text-xs mt-1 uppercase tracking-widest">Total: {{ $services->count() }} layanan terdaftar</p>
            </div>
            <a href="{{ route('admin.services.create') }}"
               class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-[10px] font-bold px-6 py-3 rounded-xl uppercase tracking-widest transition shadow-lg shadow-red-900/40">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"/>
                </svg>
                Tambah Layanan
            </a>
        </div>

        {{-- Table --}}
        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] uppercase tracking-tighter">
                    <thead class="bg-zinc-950 text-zinc-500 border-b border-zinc-800">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama Servis</th>
                            <th class="px-6 py-4">Harga Mulai</th>
                            <th class="px-6 py-4">Estimasi</th>
                            <th class="px-6 py-4 text-center">Jml Pekerjaan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-zinc-300">
                        @forelse($services as $service)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-bold text-white">{{ $service->nama }}</td>
                            <td class="px-6 py-4 text-emerald-500 font-bold">
                                Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-zinc-400">{{ $service->estimasi_waktu }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-zinc-800 px-3 py-1 rounded-full border border-zinc-700 text-zinc-300">
                                    {{ $service->items_count }} item
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.services.show', $service->id) }}"
                                       class="text-blue-400 hover:text-blue-300 font-bold transition">Detail</a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}"
                                       class="text-amber-400 hover:text-amber-300 font-bold transition">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus layanan ini beserta semua item pekerjaannya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-400 font-bold transition">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-zinc-600">
                                <div class="flex flex-col items-center gap-3 opacity-40">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                    <p class="italic tracking-widest text-sm">Belum ada layanan servis</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection


