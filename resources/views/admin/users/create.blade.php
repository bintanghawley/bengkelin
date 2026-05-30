@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen bg-zinc-950 text-white font-sans">
    <aside class="w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-zinc-800/50">
            <div class="h-10 w-10 bg-red-600 rounded-xl flex items-center justify-center shadow-lg -rotate-12">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="w-6 h-6 text-white">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="text-xl font-bengkel tracking-wider">ADMIN<span class="text-red-600">PANEL</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:bg-zinc-800 rounded-xl font-bold transition">
                DASHBOARD
            </a>
            <a href="{{ route('admin.users.index') }}" class="admin-nav w-full flex items-center gap-3 px-4 py-3 bg-red-600 text-white rounded-xl font-bold transition">
                KELOLA USER
            </a>
        </nav>

        <div class="p-4 space-y-2">
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-zinc-500 hover:text-white uppercase tracking-widest border border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bengkel uppercase tracking-widest">Tambah User</h1>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-zinc-800 rounded-md text-sm">Kembali</a>
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

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4 max-w-xl">
            @csrf
            <div>
                <label class="block text-sm mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Nomor Telepon</label>
                <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" inputmode="numeric" autocomplete="tel" maxlength="16" data-phone-input class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
                <p class="text-[10px] text-zinc-500 mt-2">Gunakan format 08xxxxxxxxxx (tanpa +62).</p>
            </div>
            <div>
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Role</label>
                <select name="role" class="w-full bg-zinc-900 border border-zinc-700 rounded px-3 py-2">
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="mekanik" {{ old('role') == 'mekanik' ? 'selected' : '' }}>Mekanik</option>
                    <option value="pengguna" {{ old('role') == 'pengguna' ? 'selected' : '' }}>Pengguna</option>
                </select>
            </div>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2 px-4 rounded-lg uppercase tracking-widest">Simpan</button>
        </form>
    </main>
</div>
@endsection
