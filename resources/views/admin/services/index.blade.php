<div class="flex items-center justify-between mb-4">
    <h3 class="text-lg font-bengkel uppercase tracking-widest">Kelola Layanan Servis</h3>
    <button onclick="toggleModalService(true)" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2 px-4 rounded-lg uppercase tracking-widest">Tambah Layanan</button>
</div>
<div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden">
    <table class="w-full text-left text-sm">
        <thead class="bg-zinc-800 text-zinc-400 uppercase text-[10px] tracking-widest">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Nama Servis</th>
                <th class="px-6 py-4">Harga Mulai</th>
                <th class="px-6 py-4">Estimasi</th>
                <th class="px-6 py-4">Jml Pekerjaan</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-800">
            @forelse($services as $service)
            <tr class="hover:bg-zinc-800/30 transition">
                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-bold">{{ strtoupper($service->nama) }}</td>
                <td class="px-6 py-4 text-emerald-500 font-bold">Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-zinc-400">{{ $service->estimasi_waktu }}</td>
                <td class="px-6 py-4 text-zinc-400">{{ $service->items_count }} Item</td>
                <td class="px-6 py-4 text-right">
                    <button type="button" onclick="openModalDetailService('{{ htmlspecialchars($service->nama, ENT_QUOTES) }}', '{{ htmlspecialchars($service->deskripsi, ENT_QUOTES) }}', 'Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}', '{{ htmlspecialchars($service->estimasi_waktu, ENT_QUOTES) }}', '{{ $service->gambar ? asset('storage/' . $service->gambar) : '' }}', {{ json_encode($service->items->pluck('nama_pekerjaan')->toArray()) }})" class="text-blue-400 hover:text-blue-300 text-[10px] font-bold uppercase tracking-tighter mr-3">Detail</button>
                    <button onclick="openModalEditService('{{ $service->id }}', '{{ htmlspecialchars($service->nama, ENT_QUOTES) }}', '{{ htmlspecialchars($service->deskripsi, ENT_QUOTES) }}', '{{ $service->harga_mulai }}', '{{ htmlspecialchars($service->estimasi_waktu, ENT_QUOTES) }}', {{ json_encode($service->items->pluck('nama_pekerjaan')->toArray()) }})" class="text-yellow-400 hover:text-yellow-300 text-[10px] font-bold uppercase tracking-tighter mr-3">Edit</button>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus servis ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:text-red-400 font-bold uppercase text-[10px] tracking-tighter">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-6 text-center text-zinc-400">Data servis belum ada</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
