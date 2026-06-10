@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans bg-zinc-950 text-white">
    
    <!-- Sidebar Admin -->
    <aside class="w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-zinc-800">
            <span class="text-3xl font-bengkel tracking-wider">ADMIN<span class="text-red-600">PANEL</span></span>
        </div>

        {{-- Profile section in sidebar --}}
        <div class="p-5 border-b border-zinc-850 flex items-center gap-3 bg-zinc-950/20">
            <div class="h-10 w-10 bg-red-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg uppercase shrink-0">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex flex-col min-w-0 text-left">
                <span class="text-zinc-200 text-sm font-bold truncate leading-none mb-1.5">{{ Auth::user()->name }}</span>
                <span class="text-zinc-500 text-[10px] uppercase tracking-widest font-semibold leading-none">Admin Bengkelin</span>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}?section=profile" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                PROFIL
            </a>
            <a href="{{ route('admin.dashboard') }}?section=stats" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                STATISTIK
            </a>
            <a href="{{ route('admin.dashboard') }}?section=users" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                KELOLA USER
            </a>
            <a href="{{ route('admin.dashboard') }}?section=services" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                KELOLA SERVIS
            </a>
            <a href="{{ route('admin.dashboard') }}?section=tires" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                KELOLA BAN MOTOR
            </a>
            <a href="{{ route('admin.dashboard') }}?section=oils" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                KELOLA OLI MOTOR
            </a>
            <a href="{{ route('admin.dashboard') }}?section=spareparts" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                KELOLA SPAREPART
            </a>
            <a href="{{ route('admin.payments.index') }}" class="w-full flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.payments.*') ? 'text-red-500 bg-red-950/20' : 'text-zinc-400 hover:text-red-500' }} rounded-xl font-bold transition">
                 RIWAYAT PEMBAYARAN
            </a>
        </nav>

        <div class="p-4 border-t border-zinc-800 space-y-2">
            <a href="{{ route('home') }}" class="group relative flex items-center justify-center gap-2 w-full text-center text-[10px] font-bold text-zinc-500 dark:text-zinc-400 hover:text-white uppercase tracking-widest border border-zinc-300 dark:border-zinc-850 hover:border-red-600 bg-white dark:bg-zinc-900/50 hover:bg-red-600/10 py-2.5 rounded-xl transition-all duration-300 overflow-hidden shadow-sm hover:shadow-red-650/10">
                <svg class="w-3.5 h-3.5 transform transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" onsubmit="localStorage.removeItem('bengkelin_cart'); return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-red-500 hover:bg-red-500/10 rounded-xl transition font-bold uppercase tracking-widest text-[10px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    <span>Sign Out Account</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-10 min-h-screen text-zinc-200">
        {{-- Header / Navbar --}}
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-bengkel tracking-wider text-zinc-800 dark:text-white">ADMIN <span class="text-red-600">DASHBOARD</span></h2>
                <p class="text-zinc-500 text-xs uppercase tracking-[0.2em] mt-1 italic">Sidoarjo High Performance Garage</p>
            </div>
            <div class="flex items-center gap-4 bg-gray-50 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 p-2 pr-6 rounded-full shadow-lg">
                <div class="h-10 w-10 bg-red-650 rounded-full flex items-center justify-center font-bold text-white shadow-lg uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex flex-col text-left">
                    <span class="text-zinc-800 dark:text-white text-sm font-bold leading-none">{{ Auth::user()->name }}</span>
                    <span class="text-zinc-500 text-[10px] uppercase mt-1 tracking-widest">Admin Bengkelin</span>
                </div>
            </div>
        </header>
        
        {{-- Back Navigation --}}
        <div class="mb-6">
            <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center gap-2 text-xs text-zinc-550 uppercase tracking-widest hover:text-red-500 transition">
                ← Kembali ke Daftar Pembayaran
            </a>
        </div>

        <div class="mb-8">
            <h1 class="text-2xl font-bengkel uppercase tracking-widest text-white">Detail Transaksi Pembayaran</h1>
            <p class="text-zinc-550 text-xs mt-1 uppercase tracking-widest">Detail rincian pembayaran lokal BENGKELIN</p>
        </div>



        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- Left Column: Details --}}
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 md:p-8 space-y-6">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-zinc-400 border-b border-zinc-800 pb-3">Informasi Pembayaran</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">No. Invoice</span>
                            <span class="font-mono text-sm font-bold text-white uppercase tracking-wider">#{{ $payment->invoice_number }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">Total Tagihan</span>
                            <span class="text-sm font-bold text-red-500">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">Metode Pembayaran</span>
                            <span class="font-bold text-white uppercase">{{ $payment->payment_method ?: 'Belum Memilih' }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">Kode Bayar / VA</span>
                            <span class="font-mono font-bold text-white tracking-widest">{{ $payment->payment_code ?: '-' }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">Status Pembayaran</span>
                            @php
                                $badgeColor = match($payment->status) {
                                    'pending' => 'bg-orange-950/40 text-orange-400 border-orange-900/60',
                                    'paid' => 'bg-emerald-950/40 text-emerald-400 border-emerald-900/60',
                                    'expired' => 'bg-zinc-950/40 text-zinc-500 border-zinc-800',
                                    'failed' => 'bg-red-950/40 text-red-400 border-red-900/60',
                                    default => 'bg-zinc-850 text-zinc-400 border-zinc-800',
                                };
                            @endphp
                            <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold border uppercase tracking-wider inline-block {{ $badgeColor }}">
                                {{ $payment->status }}
                            </span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">Batas Waktu</span>
                            <span class="text-zinc-300">{{ $payment->expired_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">Tanggal Dibuat</span>
                            <span class="text-zinc-300">{{ $payment->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-zinc-500 uppercase tracking-wider font-bold block">Tanggal Dibayar</span>
                            <span class="text-zinc-300">{{ $payment->paid_at ? $payment->paid_at->format('d M Y, H:i') . ' WIB' : '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Simulation Callback Actions (Only if payment is pending) --}}
                @if($payment->status === 'pending')
                    <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 md:p-8 space-y-6">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-zinc-400 border-b border-zinc-800 pb-3">Konfirmasi Transaksi Gateway</h3>
                            <p class="text-zinc-500 text-xs mt-2 leading-relaxed">
                                Silakan konfirmasikan respons pembayaran dari sistem Payment Gateway untuk memproses status transaksi ini secara manual.
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4 pt-2">
                            <form action="{{ route('admin.payments.simulate', $payment->id) }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="action" value="success">
                                <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold uppercase text-xs tracking-wider rounded-xl transition shadow-lg shadow-emerald-950/20">
                                    Konfirmasi Sukses
                                </button>
                            </form>
                            <form action="{{ route('admin.payments.simulate', $payment->id) }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="action" value="failed">
                                <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold uppercase text-xs tracking-wider rounded-xl transition shadow-lg shadow-red-950/20">
                                    Konfirmasi Gagal
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Column: Items and Customer Info --}}
            <div class="lg:col-span-5 space-y-6">
                
                {{-- Customer Info --}}
                @if($purchases->first() && $purchases->first()->user)
                    <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 md:p-8 space-y-4">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-zinc-400 border-b border-zinc-800 pb-3">Informasi Pelanggan</h3>
                        <div class="space-y-3 text-xs text-zinc-300">
                            <div>
                                <span class="text-zinc-500 uppercase tracking-wider font-bold block mb-1">Nama</span>
                                <span class="font-bold text-white uppercase text-xs">{{ $purchases->first()->user->name }}</span>
                            </div>
                            <div>
                                <span class="text-zinc-500 uppercase tracking-wider font-bold block mb-1">Kontak Telepon / WA</span>
                                <span class="font-mono">{{ $purchases->first()->telepon }}</span>
                            </div>
                            <div>
                                <span class="text-zinc-500 uppercase tracking-wider font-bold block mb-1">Alamat Pengiriman</span>
                                <p class="leading-relaxed text-zinc-400">{{ $purchases->first()->alamat }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Order Items --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 md:p-8 space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-zinc-400 border-b border-zinc-800 pb-3">Rincian Barang Dipesan</h3>
                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($purchases as $purchase)
                            <div class="flex items-start gap-4 py-2 border-b border-zinc-850 last:border-b-0 text-xs">
                                <div class="flex-1 min-w-0">
                                    <span class="block font-bold text-white uppercase truncate">{{ $purchase->barang_nama }}</span>
                                    <span class="text-[10px] text-zinc-500">Rp {{ number_format($purchase->harga, 0, ',', '.') }} × {{ $purchase->jumlah }} unit</span>
                                    <span class="block text-[9px] text-zinc-500 font-mono mt-1">Order Ref: #INV/{{ $purchase->created_at->format('Ymd') }}/{{ $purchase->id }}</span>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="block font-bold text-white">Rp {{ number_format($purchase->total_harga, 0, ',', '.') }}</span>
                                    @php
                                        $orderBadge = match($purchase->status) {
                                            'menunggu_pembayaran' => 'text-orange-400 bg-orange-950/20 border-orange-900/40',
                                            'diproses' => 'text-yellow-500 bg-yellow-950/20 border-yellow-900/40',
                                            'dikirim' => 'text-blue-400 bg-blue-950/20 border-blue-900/40',
                                            'siap_diambil' => 'text-purple-400 bg-purple-950/20 border-purple-900/40',
                                            'selesai' => 'text-emerald-400 bg-emerald-950/20 border-emerald-900/40',
                                            'dibatalkan' => 'text-red-400 bg-red-950/20 border-red-900/40',
                                            default => 'text-zinc-400 bg-zinc-850 border-zinc-800',
                                        };
                                    @endphp
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded border text-[8px] font-bold uppercase tracking-wider {{ $orderBadge }}">
                                        {{ str_replace('_', ' ', $purchase->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

    </main>
</div>
@endsection
