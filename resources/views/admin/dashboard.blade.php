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
            <button onclick="showAdminSection('stats')" class="admin-nav w-full flex items-center gap-3 px-4 py-3 bg-red-600 text-white rounded-xl font-bold transition">
                STATISTIK
            </button>
            <button onclick="showAdminSection('users')" class="admin-nav w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:bg-zinc-800 rounded-xl font-bold transition">
                KELOLA USER
            </button>
            <button onclick="showAdminSection('orders')" class="admin-nav w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:bg-zinc-800 rounded-xl font-bold transition">
                 E-COMMERCE
            </button>
             <button onclick="showAdminSection('booking')" class="admin-nav w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:bg-zinc-800 rounded-xl font-bold transition">
                ORDER
            </button>
        </nav>

        <div class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="block text-center text-[10px] text-zinc-500 hover:text-white uppercase tracking-widest border border-zinc-800 py-2 rounded-lg">Kembali ke User UI</a>
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-zinc-500 hover:text-white uppercase tracking-widest border border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-10">
        
        <section id="admin-stats" class="admin-section space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800">
                    <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest">Total Mekanik</p>
                    <h3 class="text-4xl font-bengkel text-red-600">{{ $countMekanik }}</h3>
                </div>
                <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800">
                    <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest">Total Pengguna</p>
                    <h3 class="text-4xl font-bengkel text-white">{{ $countPengguna }}</h3>
                </div>
                <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800">
                    <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest">Pendapatan Bln Ini</p>
                    <h3 class="text-4xl font-bengkel text-emerald-500">Rp 12.5M</h3>
                </div>
            </div>

            <div class="bg-zinc-900 p-8 rounded-3xl border border-zinc-800">
                <h3 class="text-xl font-bengkel mb-6 uppercase tracking-widest">Grafik Pesanan & Penjualan</h3>
                <canvas id="salesChart" class="max-h-[300px]"></canvas>
            </div>
        </section>

        <section id="admin-users" class="admin-section hidden italic">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bengkel uppercase tracking-widest">Kelola Users</h3>
                <a href="{{ route('admin.users.create') }}" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2 px-4 rounded-lg uppercase tracking-widest">Tambah User</a>
            </div>
            <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-800 text-zinc-400 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Dibuat pada</th>
                            <th class="px-6 py-4">Diperbarui pada</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse($users as $user)
                        <tr class="hover:bg-zinc-800/30 transition">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-bold">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-zinc-500">{{ $user->email }}</td>
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
        </section>
   <section id="admin-orders" class="admin-section hidden italic">
    <div class="grid grid-cols-1 gap-6">
        
        <div class="flex justify-between items-center bg-zinc-900 p-6 rounded-3xl border border-zinc-800 shadow-xl">
            <div>
                <h3 class="font-bengkel text-xl text-white uppercase tracking-wider">Manajemen Stok</h3>
                <p class="text-[9px] text-zinc-500 uppercase mt-1">Total: {{ $products->count() }} Produk terdaftar</p>
            </div>
            <button onclick="toggleModalProduk(true)" class="bg-red-600 hover:bg-red-700 text-white text-[10px] font-bold px-6 py-3 rounded-xl uppercase tracking-widest transition flex items-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"/></svg>
                Tambah Produk
            </button>
        </div>

        <div class="bg-zinc-900 p-8 rounded-3xl border border-zinc-800 shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] uppercase tracking-tighter">
                    <thead class="bg-zinc-950 text-zinc-500 border-b border-zinc-800">
                        <tr>
                            <th class="px-6 py-4 text-center">Gambar</th>
                            <th class="px-6 py-4">Nama Produk</th>
                            <th class="px-6 py-4">Harga</th>
                            <th class="px-6 py-4 text-center">Stok</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50 text-zinc-300">
                        @forelse ($products as $product)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4 text-center">
                                @if($product->gambar)
                                    <img src="{{ asset('storage/' . $product->gambar) }}" class="w-10 h-10 object-cover rounded-lg border border-zinc-700 mx-auto">
                                @else
                                    <div class="w-10 h-10 bg-zinc-800 rounded-lg border border-zinc-700 mx-auto"></div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-white">{{ $product->nama }}</td>
                            <td class="px-6 py-4 text-emerald-500 font-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">{{ $product->stok }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-white transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-zinc-600">Gudang Kosong.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal-produk" class="fixed inset-0 z-[99] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="toggleModalProduk(false)"></div>
        
        <div class="relative bg-zinc-900 w-full max-w-2xl rounded-3xl border border-zinc-800 shadow-2xl overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bengkel text-xl text-red-600 uppercase tracking-widest">Tambah Item Baru</h3>
                    <button onclick="toggleModalProduk(false)" class="text-zinc-500 hover:text-white transition text-2xl">&times;</button>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-zinc-500 font-bold">Nama Barang</label>
                            <input type="text" name="nama" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase text-zinc-500 font-bold">Stok</label>
                            <input type="number" name="stok" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition">
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase text-zinc-500 font-bold">Harga Jual (Rp)</label>
                        <input type="number" name="harga" required class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:border-red-600 outline-none transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] uppercase text-zinc-500 font-bold">Foto Produk</label>
                        <input type="file" name="gambar" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-xs text-zinc-400 file:bg-red-600 file:border-0 file:text-white file:rounded-lg file:px-3 file:mr-3">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="toggleModalProduk(false)" class="flex-1 bg-zinc-800 hover:bg-zinc-700 text-white font-bold py-3 rounded-xl uppercase text-[10px] transition">Batal</button>
                        <button type="submit" class="flex-[2] bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl uppercase text-[10px] tracking-widest transition shadow-lg shadow-red-900/40">Simpan Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
        <br>   

         <section id="admin-booking" class=" admin-section hidden bg-zinc-900 p-8 rounded-3xl border border-zinc-800 shadow-2xl">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h3 class="font-bengkel text-2xl text-red-600 uppercase tracking-wider">Management Booking</h3>
            <p class="text-[10px] text-zinc-500 italic uppercase mt-1">Total Pesanan: {{ $allBookings->count() }} Entry terdeteksi</p>
        </div>
        
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-[11px] uppercase tracking-tighter">
            <thead class="bg-zinc-950 text-zinc-500 border-b border-zinc-800">
                <tr>
                    <th class="px-6 py-4 font-bold text-white">Customer</th>
                    <th class="px-6 py-4 font-bold text-white">Unit & Layanan</th>
                    <th class="px-6 py-4 font-bold text-white">Metode</th>
                    <th class="px-6 py-4 font-bold text-white">Plat Nomor</th>
                    <th class="px-6 py-4 font-bold text-center text-white">Schedule</th>
                    <th class="px-6 py-4 font-bold text-right text-white">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800/50 text-zinc-300">
                @forelse ($allBookings as $booking)
                    <tr class="hover:bg-zinc-800/30 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-white font-bold">{{ $booking->user->name ?? 'Guest' }}</span>
                                <span class="text-[9px] text-zinc-500 lowercase italic">UID: {{ $booking->user_id }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="block text-red-500 font-bold">{{ $booking->jenis_motor }}</span>
                            <span class="text-zinc-400 italic text-[10px]">{{ $booking->layanan }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-zinc-800 px-2 py-1 rounded border border-zinc-700 text-[9px]">
                                {{ $booking->metode }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-zinc-800 px-2 py-1 rounded border border-zinc-700 text-[9px]">
                                {{ $booking->plat_nomor }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-white">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <!-- Status Badge -->
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold border 
                                    {{ $booking->status == 'pending' ? 'bg-orange-900/20 text-orange-500 border-orange-800' : '' }}
                                    {{ $booking->status == 'proses' ? 'bg-blue-900/20 text-blue-500 border-blue-800' : '' }}
                                    {{ $booking->status == 'selesai' ? 'bg-emerald-900/20 text-emerald-500 border-emerald-800' : '' }}
                                ">
                                    {{ $booking->status }}
                                </span>
                                
                                <!-- Dropdown Edit Status (Simulasi) -->
                                <button class="text-zinc-500 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3 opacity-20">
                                <svg class="w-12 h-12 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <p class="italic tracking-[0.2em] text-sm">Tidak ada antrean servis saat ini</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. FUNGSI NAVIGASI SIDEBAR
    function showAdminSection(id) {
        // Sembunyikan semua section
        document.querySelectorAll('.admin-section').forEach(s => s.classList.add('hidden'));
        // Tampilkan section yang dipilih
        document.getElementById('admin-' + id).classList.remove('hidden');
        
        // AUTO-CLOSE MODAL: Jika admin pindah menu saat modal buka, kita tutup paksa modalnya
        toggleModalProduk(false);
    }

    // 2. FUNGSI TOGGLE MODAL (POP-UP)
    function toggleModalProduk(show) {
        const modal = document.getElementById('modal-produk');
        if (!modal) return; // Guard clause jika elemen tidak ada

        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Pastikan pakai flex untuk centering
            document.body.style.overflow = 'hidden'; // Kunci scroll layar utama
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto'; // Aktifkan kembali scroll
        }
    }

    // 3. INISIALISASI SALES CHART (Line Chart)
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Pesanan Masuk',
                data: [12, 19, 3, 5, 2, 20],
                borderColor: '#dc2626', // Red-600
                backgroundColor: 'rgba(220, 38, 38, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#dc2626',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false } 
            },
            scales: {
                y: { 
                    grid: { color: '#27272a' }, // Zinc-800
                    ticks: { 
                        color: '#71717a', 
                        font: { family: 'Inter', size: 10 } 
                    } 
                },
                x: { 
                    grid: { display: false }, 
                    ticks: { 
                        color: '#71717a', 
                        font: { family: 'Inter', size: 10 } 
                    } 
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            }
        }
    });

    // Close modal jika user tekan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            toggleModalProduk(false);
        }
    });
</script>
@endsection