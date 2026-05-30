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
            <h1 class="text-2xl font-bengkel uppercase tracking-widest">Data Users</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2 px-4 rounded-lg uppercase tracking-widest">Tambah User</a>
        </div>

        @if (session('success'))
            <div class="bg-emerald-900/30 border border-emerald-700 text-emerald-300 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-900/30 border border-red-700 text-red-300 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-800 text-zinc-400 uppercase text-[10px] tracking-widest">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">No. Telepon</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Dibuat pada</th>
                        <th class="px-6 py-4">Diperbarui pada</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse ($users as $user)
                        <tr class="hover:bg-zinc-800/30 transition">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-bold">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-zinc-500">{{ $user->nomor_telepon ? implode('-', str_split($user->nomor_telepon, 4)) : '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold {{ $user->role == 'mekanik' ? 'bg-blue-500/20 text-blue-400' : 'bg-zinc-700 text-zinc-300' }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-zinc-400">{{ $user->created_at }}</td>
                            <td class="px-6 py-4 text-zinc-400">{{ $user->updated_at }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-400 hover:text-yellow-300 text-[10px] font-bold uppercase tracking-tighter mr-3">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-400 font-bold uppercase text-[10px] tracking-tighter">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-zinc-400">Data user belum ada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
