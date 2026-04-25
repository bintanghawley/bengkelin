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
                PESANAN & E-COM
            </button>
        </nav>

        <div class="p-4">
            <a href="{{ route('dashboard') }}" class="block text-center text-[10px] text-zinc-500 hover:text-white uppercase tracking-widest border border-zinc-800 py-2 rounded-lg">Kembali ke User UI</a>
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
            <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-800 text-zinc-400 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @foreach($allUsers as $u)
                        <tr class="hover:bg-zinc-800/30 transition">
                            <td class="px-6 py-4 font-bold">{{ $u->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold {{ $u->role == 'mekanik' ? 'bg-blue-500/20 text-blue-400' : 'bg-zinc-700 text-zinc-300' }}">
                                    {{ strtoupper($u->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-zinc-500">{{ $u->email }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.user.delete', $u->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-400 font-bold uppercase text-[10px] tracking-tighter">Hapus User</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section id="admin-orders" class="admin-section hidden italic">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800">
                    <h3 class="font-bengkel text-red-600 mb-4 uppercase">Stok E-Commerce</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between p-3 bg-zinc-950 rounded-xl border border-zinc-800">
                            <span>Oli Shell Advance</span>
                            <span class="text-emerald-500 font-bold">42 Pcs</span>
                        </div>
                        <div class="flex justify-between p-3 bg-zinc-950 rounded-xl border border-zinc-800">
                            <span>Busi NGK Iridium</span>
                            <span class="text-emerald-500 font-bold">12 Pcs</span>
                        </div>
                    </div>
                </div>
                <div class="bg-zinc-900 p-6 rounded-3xl border border-zinc-800">
                    <h3 class="font-bengkel text-red-600 mb-4 uppercase">Pesanan Terbaru</h3>
                    <div class="text-[10px] space-y-4">
                        <div class="border-l-2 border-red-600 pl-4">
                            <p class="text-white font-bold uppercase">Darul - Service Rutin</p>
                            <p class="text-zinc-500 italic">Vario 160 | Status: Menunggu</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Tab Logic
    function showAdminSection(id) {
        document.querySelectorAll('.admin-section').forEach(s => s.classList.add('hidden'));
        document.getElementById('admin-' + id).classList.remove('hidden');
    }

    // Grafik Penjualan
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Pesanan Masuk',
                data: [12, 19, 3, 5, 2, 20],
                borderColor: '#dc2626',
                backgroundColor: 'rgba(220, 38, 38, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { color: '#27272a' }, ticks: { color: '#71717a' } },
                x: { grid: { display: false }, ticks: { color: '#71717a' } }
            }
        }
    });
</script>
@endsection