@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen bg-zinc-950 text-white font-sans">
    
    <aside class="w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-zinc-800/50">
            <div class="h-10 w-10 bg-red-600 rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(220,38,38,0.3)] -rotate-12">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6 text-white">
                    <path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="text-2xl font-bengkel tracking-wider">BENGKEL<span class="text-red-600">IN</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6" id="sidebar-nav">
            <button onclick="showSection('profil')" id="btn-profil" class="nav-link w-full flex items-center gap-3 px-4 py-3 bg-red-600 text-white rounded-xl font-bold transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                PROFIL
            </button>
            <button onclick="showSection('booking')" id="btn-booking" class="nav-link w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:bg-zinc-800 hover:text-white rounded-xl font-bold transition text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                BOOKING
            </button>
            <button onclick="showSection('status')" id="btn-status" class="nav-link w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:bg-zinc-800 hover:text-white rounded-xl font-bold transition text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                STATUS PESANAN
            </button>
            <button onclick="showSection('ecommerce')" id="btn-ecommerce" class="nav-link w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:bg-zinc-800 hover:text-white rounded-xl font-bold transition text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                SPARE PARTS
            </button>
        </nav>

        <div class="p-4 border-t border-zinc-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-500/10 rounded-xl transition font-bold uppercase tracking-widest text-[10px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Sign Out Account
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-10">
        
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-bengkel tracking-wider">USER <span class="text-red-600">DASHBOARD</span></h2>
                <p class="text-zinc-500 text-xs uppercase tracking-[0.2em] mt-1 italic">Sidoarjo High Performance Garage</p>
            </div>
            <div class="flex items-center gap-4 bg-zinc-900 border border-zinc-800 p-2 pr-6 rounded-full shadow-lg">
                <div class="h-10 w-10 bg-red-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg uppercase">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-white text-sm font-bold leading-none">{{ $user->name }}</span>
                    <span class="text-zinc-500 text-[10px] uppercase mt-1 tracking-widest">{{ $user->role }}</span>
                </div>
            </div>
        </header>

        <div id="content-area">
            
            <section id="section-profil" class="dashboard-section space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 italic">
                    <div class="bg-zinc-900 p-8 rounded-3xl border border-zinc-800 shadow-xl flex flex-col items-center text-center">
                        <div class="relative mb-6">
                            <div class="h-32 w-32 bg-zinc-950 rounded-3xl border-2 border-red-600 flex items-center justify-center overflow-hidden">
                                <svg class="w-16 h-16 text-zinc-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                            <div class="absolute -bottom-2 -right-2 h-8 w-8 bg-emerald-500 border-4 border-zinc-900 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                        </div>
                        <h3 class="text-2xl font-bengkel tracking-wide uppercase">{{ $user->name }}</h3>
                        <p class="text-zinc-500 text-[10px] uppercase tracking-[0.3em] mt-1">{{ $user->role }} Member</p>
                        
                        <div class="w-full mt-8 pt-8 border-t border-zinc-800 space-y-3">
                            <div class="flex justify-between text-[10px]">
                                <span class="text-zinc-500 uppercase font-bold tracking-widest">ID Akun</span>
                                <span class="text-white">#00{{ $user->id }}</span>
                            </div>
                            <div class="flex justify-between text-[10px]">
                                <span class="text-zinc-500 uppercase font-bold tracking-widest">Bergabung</span>
                                <span class="text-white italic">{{ $user->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 bg-zinc-900 p-8 rounded-3xl border border-zinc-800 shadow-xl relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 opacity-[0.02] -rotate-12">
                             <svg viewBox="0 0 24 24" fill="white" class="w-64 h-64"><path d="M14.5 11V5a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v6M7 11h10M7 15h10M8 11v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-8"/></svg>
                        </div>

                        <h3 class="text-xl font-bengkel text-red-600 mb-8 uppercase tracking-widest relative z-10">Data Pelanggan Terverifikasi</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                            <div class="space-y-1">
                                <label class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest block">Full Identity</label>
                                <p class="text-white font-medium border-b border-zinc-800 pb-2">{{ $user->name }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest block">Email Contact</label>
                                <p class="text-white font-medium border-b border-zinc-800 pb-2">{{ $user->email }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest block">Gender Type</label>
                                <p class="text-white font-medium border-b border-zinc-800 pb-2">
                                    {{ $user->jenis_kelamin == 'L' ? 'Laki-laki (Male)' : 'Perempuan (Female)' }}
                                </p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest block">Account Role</label>
                                <p class="text-red-500 font-bold border-b border-zinc-800 pb-2 uppercase italic tracking-widest">
                                    {{ $user->role }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 flex flex-col md:flex-row gap-4">
                            <button class="bg-red-600 hover:bg-red-700 text-white text-[10px] font-bold py-3 px-8 rounded-xl transition uppercase tracking-widest shadow-lg shadow-red-900/20">
                                Update Profil
                            </button>
                            <button class="bg-zinc-800 hover:bg-zinc-700 text-white text-[10px] font-bold py-3 px-8 rounded-xl transition uppercase tracking-widest border border-zinc-700">
                                Ganti Password
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-booking" class="dashboard-section hidden italic">
                <div class="bg-zinc-900 p-10 rounded-3xl border border-zinc-800 shadow-xl">
                    <h3 class="text-3xl font-bengkel text-red-600 mb-2 uppercase">Reservasi Servis</h3>
                    <p class="text-zinc-500 text-sm mb-10 uppercase tracking-widest">Tentukan waktu terbaik untuk kendaraan lu.</p>
                    <div class="max-w-xl space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest ml-1">Pilih Tanggal</label>
                            <input type="date" class="w-full bg-zinc-950 border border-zinc-800 rounded-2xl p-4 outline-none focus:ring-2 focus:ring-red-600 transition text-white">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest ml-1">Paket Layanan</label>
                            <select class="w-full bg-zinc-950 border border-zinc-800 rounded-2xl p-4 outline-none focus:ring-2 focus:ring-red-600 transition text-white appearance-none">
                                <option>Ganti Oli (Fast Track)</option>
                                <option>Service Rutin 10rb KM</option>
                                <option>Tune Up Racing</option>
                                <option>Cek Kelistrikan</option>
                            </select>
                        </div>
                        <button class="w-full bg-red-600 py-5 rounded-2xl font-bold font-bengkel tracking-[0.2em] text-2xl shadow-xl shadow-red-900/40 hover:bg-red-700 transition">KIRIM PERMINTAAN BOOKING</button>
                    </div>
                </div>
            </section>

            <section id="section-status" class="dashboard-section hidden italic">
                <div class="bg-zinc-900 p-10 rounded-3xl border border-zinc-800">
                    <h3 class="text-3xl font-bengkel text-red-600 mb-8 uppercase">Service Progress</h3>
                    <div class="space-y-8">
                        <div class="flex items-start gap-6 relative">
                            <div class="h-8 w-8 bg-emerald-500 rounded-full flex items-center justify-center shrink-0 shadow-[0_0_15px_rgba(16,185,129,0.4)]">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white uppercase text-sm tracking-widest">Booking Terkonfirmasi</h4>
                                <p class="text-[10px] text-zinc-500 mt-1 uppercase">12 April 2026 - 09:00 WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-6 relative">
                            <div class="h-8 w-8 bg-red-600 rounded-full flex items-center justify-center shrink-0 animate-pulse">
                                <div class="h-3 w-3 bg-white rounded-full"></div>
                            </div>
                            <div>
                                <h4 class="font-bold text-red-500 uppercase text-sm tracking-widest">Dalam Pengerjaan</h4>
                                <p class="text-[10px] text-zinc-500 mt-1 uppercase italic">Estimasi Selesai: 45 Menit Lagi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-ecommerce" class="dashboard-section hidden italic">
                <div class="flex justify-between items-end mb-8">
                    <h3 class="text-3xl font-bengkel text-red-600 uppercase">Original Parts</h3>
                    <span class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest">Tersedia di Bengkel Sidoarjo</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="bg-zinc-900 p-5 rounded-[2rem] border border-zinc-800 group hover:border-red-600 transition duration-500">
                        <div class="aspect-square bg-zinc-950 rounded-2xl mb-5 flex items-center justify-center relative overflow-hidden">
                            <svg class="w-16 h-16 text-zinc-900 group-hover:text-red-600/20 transition duration-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71L12 2z"/></svg>
                            <span class="absolute top-3 left-3 bg-red-600 text-[8px] font-bold px-2 py-1 rounded">HOT ITEM</span>
                        </div>
                        <h4 class="font-bengkel text-xl text-white tracking-widest">Piston Pro X</h4>
                        <p class="text-red-600 font-bold mt-1 text-sm tracking-tighter">Rp 850.000</p>
                    </div>
                </div>
            </section>

        </div>
    </main>
</div>

<script>
    function showSection(sectionId) {
        // Sembunyikan semua section dengan transisi halus (opsional)
        document.querySelectorAll('.dashboard-section').forEach(section => {
            section.classList.add('hidden');
        });
        
        // Tampilkan section target
        document.getElementById('section-' + sectionId).classList.remove('hidden');

        // Reset semua tombol navigasi ke state default
        document.querySelectorAll('.nav-link').forEach(btn => {
            btn.classList.remove('bg-red-600', 'text-white');
            btn.classList.add('text-zinc-400', 'hover:bg-zinc-800', 'hover:text-white');
        });

        // Set tombol yang diklik menjadi aktif
        const activeBtn = document.getElementById('btn-' + sectionId);
        activeBtn.classList.add('bg-red-600', 'text-white');
        activeBtn.classList.remove('text-zinc-400', 'hover:bg-zinc-800');
    }
</script>
@endsection