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
            <div class="mb-8">
                <h1 class="text-2xl font-bengkel uppercase tracking-widest text-white">Tambah Layanan Servis</h1>
                <p class="text-zinc-500 text-xs mt-1 uppercase tracking-widest">Isi detail layanan dan item pekerjaan</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-900/30 border border-red-700 text-red-400 px-6 py-4 rounded-2xl text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama Servis --}}
                <div class="bg-zinc-900 rounded-2xl border border-zinc-800 p-6 space-y-5">
                    <h2 class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest border-b border-zinc-800 pb-3">Informasi Layanan</h2>

                    <div class="space-y-1">
                        <label class="text-[10px] uppercase text-zinc-500 font-bold">Nama Servis <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                               class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition placeholder:text-zinc-700"
                               placeholder="contoh: Servis Ringan">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] uppercase text-zinc-500 font-bold">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" rows="3" required
                                  class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition resize-none placeholder:text-zinc-700"
                                  placeholder="Deskripsi singkat layanan servis ini...">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-zinc-500 font-bold">Harga Mulai (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="harga_mulai" value="{{ old('harga_mulai') }}" min="0" required
                                   class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition"
                                   placeholder="75000">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-zinc-500 font-bold">Estimasi Waktu <span class="text-red-500">*</span></label>
                            <input type="text" name="estimasi_waktu" value="{{ old('estimasi_waktu') }}" required
                                   class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition"
                                   placeholder="30-60 Menit">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] uppercase text-zinc-500 font-bold">Gambar Servis (Opsional)</label>
                        <input type="file" name="gambar" accept="image/*"
                               class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-400 file:bg-red-600 file:border-0 file:text-white file:rounded-lg file:px-3 file:py-1 file:mr-3 file:text-[10px] file:font-bold file:uppercase cursor-pointer">
                        <p class="text-[10px] text-zinc-600">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                    </div>
                </div>

                {{-- Item Pekerjaan --}}
                <div class="bg-zinc-900 rounded-2xl border border-zinc-800 p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-zinc-800 pb-3">
                        <h2 class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest">Item Pekerjaan</h2>
                        <button type="button" id="btn-tambah-item"
                                class="inline-flex items-center gap-1.5 bg-zinc-800 hover:bg-zinc-700 text-white text-[9px] font-bold px-3 py-2 rounded-lg uppercase tracking-widest transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            Tambah Pekerjaan
                        </button>
                    </div>

                    <div id="items-container" class="space-y-3">
                        <div class="item-row flex items-center gap-3">
                            <div class="flex-1 flex items-center gap-3 bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3">
                                <span class="text-emerald-500 text-sm">✓</span>
                                <input type="text" name="items[]"
                                       class="flex-1 bg-transparent text-sm text-white outline-none placeholder:text-zinc-700"
                                       placeholder="contoh: Ganti Oli">
                            </div>
                            <button type="button" class="btn-hapus-item text-zinc-600 hover:text-red-500 transition p-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex gap-4">
                    <a href="{{ route('admin.services.index') }}"
                       class="flex-1 text-center bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-3 rounded-xl uppercase text-[10px] tracking-widest transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-[2] bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl uppercase text-[10px] tracking-widest transition shadow-lg shadow-red-900/40">
                        Simpan Layanan
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    const container = document.getElementById('items-container');
    const btnTambah = document.getElementById('btn-tambah-item');

    function buatItemRow(value = '') {
        const div = document.createElement('div');
        div.className = 'item-row flex items-center gap-3';
        div.innerHTML = `
            <div class="flex-1 flex items-center gap-3 bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3">
                <span class="text-emerald-500 text-sm">✓</span>
                <input type="text" name="items[]" value="${value}"
                       class="flex-1 bg-transparent text-sm text-white outline-none placeholder:text-zinc-700"
                       placeholder="contoh: Cek Rem">
            </div>
            <button type="button" class="btn-hapus-item text-zinc-600 hover:text-red-500 transition p-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        `;
        return div;
    }

    btnTambah.addEventListener('click', () => {
        const row = buatItemRow();
        container.appendChild(row);
        row.querySelector('input').focus();
        bindHapus(row);
    });

    function bindHapus(row) {
        row.querySelector('.btn-hapus-item').addEventListener('click', () => {
            if (container.querySelectorAll('.item-row').length > 1) {
                row.remove();
            }
        });
    }

    // Bind existing rows
    document.querySelectorAll('.item-row').forEach(bindHapus);
</script>
@endsection


