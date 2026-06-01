<div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
    <div class="px-4 py-3 border-b border-zinc-800">
        <h2 class="text-lg font-semibold">Data Booking</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-zinc-800 text-zinc-300">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Jenis Motor</th>
                    <th class="px-4 py-3">Layanan</th>
                    <th class="px-4 py-3">Metode</th>
                    <th class="px-4 py-3">Plat Nomor</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800">
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="px-4 py-3">{{ $booking->id }}</td>
                        <td class="px-4 py-3">{{ $booking->user->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $booking->jenis_motor }}</td>
                        <td class="px-4 py-3">{{ $booking->layanan }}</td>
                        <td class="px-4 py-3">{{ $booking->metode }}</td>
                        <td class="px-4 py-3">{{ $booking->plat_nomor }}</td>
                        <td class="px-4 py-3">{{ $booking->alamat }}</td>
                        <td class="px-4 py-3">{{ $booking->tanggal }}</td>
                        <td class="px-4 py-3">{{ $booking->status }}</td>
                        <td class="px-4 py-3">
                          <form action="{{ route('mekanik.booking.update', $booking->id) }}" method="POST" class="flex items-center gap-2">
    @csrf
    <select name="status" class="text-sm font-bold rounded px-3 py-1 outline-none border transition-colors
        {{ $booking->status == 'pending' ? 'bg-orange-950/40 border-orange-500 text-orange-400' : '' }}
        {{ $booking->status == 'diterima' ? 'bg-green-950/40 border-green-500 text-green-400' : '' }}
        {{ $booking->status == 'diproses' ? 'bg-yellow-950/40 border-yellow-500 text-yellow-400' : '' }}
        {{ $booking->status == 'selesai' ? 'bg-green-950/40 border-green-500 text-green-400' : '' }}">
        
        <option value="pending" class="text-zinc-200 bg-zinc-900" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="diterima" class="text-zinc-200 bg-zinc-900" {{ $booking->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="diproses" class="text-zinc-200 bg-zinc-900" {{ $booking->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" class="text-zinc-200 bg-zinc-900" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
    
    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded text-xs transition">Update</button>
</form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-6 text-center text-zinc-400">Belum ada booking</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
