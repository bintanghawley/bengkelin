@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen font-sans bg-zinc-950 text-white">
    
    <!-- Sidebar Admin -->
    <aside class="w-64 bg-zinc-900 border-r border-zinc-800 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3 border-b border-zinc-800">
            <span class="text-3xl font-bengkel tracking-wider">ADMIN<span class="text-red-600">PANEL</span></span>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-6">
            <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                DASHBOARD
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-500 rounded-xl font-bold transition">
                BOOKING MASUK
            </a>
            <a href="{{ route('admin.payments.index') }}" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 bg-red-950/20 rounded-xl font-bold transition">
                RIWAYAT PEMBAYARAN
            </a>
        </nav>

        <div class="p-4 border-t border-zinc-800">
            <a href="{{ route('home') }}" class="block text-center text-[10px] text-zinc-500 hover:text-white uppercase tracking-widest border border-zinc-800 py-2 rounded-lg">Kembali ke Beranda</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-10 min-h-screen text-zinc-200">
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bengkel uppercase tracking-widest text-white">Kelola Pembayaran</h1>
                <p class="text-zinc-550 text-xs mt-1 uppercase tracking-widest">Total: {{ $payments->total() }} transaksi tercatat</p>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-emerald-950/30 border border-emerald-800 text-emerald-400 p-4 rounded-2xl text-xs uppercase tracking-wider font-bold">
            ✓ {{ session('success') }}
        </div>
        @endif

        {{-- Table Container --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-950/50 text-zinc-400 font-bold uppercase tracking-wider">
                            <th class="px-6 py-4">Invoice</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Metode</th>
                            <th class="px-6 py-4">Nominal</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4">Tgl Dibuat</th>
                            <th class="px-6 py-4">Tgl Dibayar</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-850">
                        @forelse($payments as $payment)
                            <tr class="hover:bg-zinc-850/35 transition">
                                <td class="px-6 py-4 font-mono font-bold text-white uppercase tracking-wider">
                                    #{{ $payment->invoice_number }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($payment->purchases->first() && $payment->purchases->first()->user)
                                        <span class="block font-bold text-white">{{ $payment->purchases->first()->user->name }}</span>
                                        <span class="text-[10px] text-zinc-500">{{ $payment->purchases->first()->user->email }}</span>
                                    @else
                                        <span class="text-zinc-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 uppercase font-bold text-zinc-300">
                                    {{ $payment->payment_method ?: 'Belum Memilih' }}
                                </td>
                                <td class="px-6 py-4 font-bold text-white">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $badgeColor = match($payment->status) {
                                            'pending' => 'bg-orange-950/40 text-orange-400 border-orange-900/60',
                                            'paid' => 'bg-emerald-950/40 text-emerald-400 border-emerald-900/60',
                                            'expired' => 'bg-zinc-950/40 text-zinc-500 border-zinc-800',
                                            'failed' => 'bg-red-950/40 text-red-400 border-red-900/60',
                                            default => 'bg-zinc-850 text-zinc-400 border-zinc-800',
                                        };
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold border uppercase tracking-wider {{ $badgeColor }}">
                                        {{ $payment->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-zinc-400">
                                    {{ $payment->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-zinc-400">
                                    {{ $payment->paid_at ? $payment->paid_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.payments.show', $payment->id) }}" class="inline-block px-3 py-1.5 bg-zinc-800 hover:bg-zinc-750 border border-zinc-700 text-zinc-200 hover:text-white rounded-lg font-bold transition">
                                        Detail →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-zinc-500 uppercase tracking-widest">
                                    Tidak ada data pembayaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($payments->hasPages())
                <div class="px-6 py-4 bg-zinc-950/30 border-t border-zinc-800">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
