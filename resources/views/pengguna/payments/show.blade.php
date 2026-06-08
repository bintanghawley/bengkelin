@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Countdown Header --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 md:p-8 flex flex-col md:flex-row justify-between items-center gap-6 mb-8">
            <div class="space-y-1 text-center md:text-left">
                <span class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold block">Batas Waktu Pembayaran</span>
                <h2 id="countdown-timer" class="text-xl md:text-2xl font-bengkel tracking-widest text-red-500 uppercase">
                    Memuat waktu...
                </h2>
            </div>
            <div class="bg-zinc-950 px-6 py-3 rounded-2xl border border-zinc-800 text-center md:text-right shrink-0">
                <span class="text-[9px] text-zinc-500 uppercase tracking-widest font-bold block">No. Tagihan (Invoice)</span>
                <span class="font-mono text-sm font-bold text-white uppercase tracking-wider">#{{ $payment->invoice_number }}</span>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-emerald-950/30 border border-emerald-800 text-emerald-400 p-4 rounded-2xl text-xs uppercase tracking-wider font-bold">
            ✓ {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 bg-red-950/30 border border-red-800 text-red-400 p-4 rounded-2xl text-xs uppercase tracking-wider font-bold">
            ✗ {{ session('error') }}
        </div>
        @endif

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- Left Column: Payment Methods Accordion --}}
            <div class="lg:col-span-7 space-y-4">
                <h3 class="text-xs uppercase tracking-widest text-zinc-550 font-bold mb-2">Metode Pembayaran</h3>

                @php
                    $isBank = str_contains($payment->payment_method ?? '', 'Virtual Account');
                    $isQris = $payment->payment_method === 'QRIS';
                    $isEwallet = in_array($payment->payment_method ?? '', ['DANA', 'OVO', 'GoPay', 'ShopeePay']);
                    $isStore = in_array($payment->payment_method ?? '', ['Alfamart', 'Indomaret']);
                @endphp

                {{-- Accordion 1: Bank Transfer --}}
                <div class="border border-zinc-800 rounded-3xl overflow-hidden bg-zinc-900/40">
                    <button type="button" onclick="toggleAccordion('bank-transfer-panel')" class="w-full flex items-center justify-between p-6 text-sm font-bold uppercase tracking-wide text-zinc-300 hover:text-white transition">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            Bank Transfer (Virtual Account)
                        </span>
                        <svg id="bank-transfer-panel-icon" class="w-4 h-4 transform transition-transform {{ $isBank ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="bank-transfer-panel" class="p-6 border-t border-zinc-800/80 space-y-4 {{ $isBank ? '' : 'hidden' }}">
                        <p class="text-zinc-500 text-xs">Pilih salah satu Virtual Account bank berikut:</p>
                        <form action="{{ route('pengguna.payments.select-method', $payment->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @csrf
                            @foreach(['BCA Virtual Account', 'BRI Virtual Account', 'BNI Virtual Account', 'Mandiri Virtual Account', 'Permata Virtual Account'] as $bank)
                                <button type="submit" name="payment_method" value="{{ $bank }}" class="px-4 py-3 bg-zinc-950/60 border {{ $payment->payment_method === $bank ? 'border-red-600 bg-red-950/10' : 'border-zinc-800 hover:border-zinc-700' }} rounded-2xl text-left text-xs font-bold uppercase tracking-wider flex items-center justify-between transition">
                                    <span>{{ $bank }}</span>
                                    @if($payment->payment_method === $bank)
                                        <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                    @endif
                                </button>
                            @endforeach
                        </form>
                    </div>
                </div>

                {{-- Accordion 2: QRIS --}}
                <div class="border border-zinc-800 rounded-3xl overflow-hidden bg-zinc-900/40">
                    <button type="button" onclick="toggleAccordion('qris-panel')" class="w-full flex items-center justify-between p-6 text-sm font-bold uppercase tracking-wide text-zinc-300 hover:text-white transition">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                            QRIS (Scan & Pay)
                        </span>
                        <svg id="qris-panel-icon" class="w-4 h-4 transform transition-transform {{ $isQris ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="qris-panel" class="p-6 border-t border-zinc-800/80 space-y-4 {{ $isQris ? '' : 'hidden' }}">
                        <p class="text-zinc-500 text-xs">Pindai kode QRIS menggunakan e-wallet atau aplikasi mobile banking Anda.</p>
                        <form action="{{ route('pengguna.payments.select-method', $payment->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="payment_method" value="QRIS" class="w-full sm:w-auto px-6 py-3.5 bg-zinc-950/60 border {{ $isQris ? 'border-red-600 bg-red-950/10' : 'border-zinc-800 hover:border-zinc-700' }} rounded-2xl text-xs font-bold uppercase tracking-wider flex items-center justify-between transition">
                                <span>Pilih QRIS</span>
                                @if($isQris)
                                    <span class="ml-4 w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                @endif
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Accordion 3: E-Wallet --}}
                <div class="border border-zinc-800 rounded-3xl overflow-hidden bg-zinc-900/40">
                    <button type="button" onclick="toggleAccordion('ewallet-panel')" class="w-full flex items-center justify-between p-6 text-sm font-bold uppercase tracking-wide text-zinc-300 hover:text-white transition">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            E-Wallet
                        </span>
                        <svg id="ewallet-panel-icon" class="w-4 h-4 transform transition-transform {{ $isEwallet ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="ewallet-panel" class="p-6 border-t border-zinc-800/80 space-y-4 {{ $isEwallet ? '' : 'hidden' }}">
                        <p class="text-zinc-500 text-xs">Pilih salah satu e-wallet berikut:</p>
                        <form action="{{ route('pengguna.payments.select-method', $payment->id) }}" method="POST" class="grid grid-cols-2 gap-3">
                            @csrf
                            @foreach(['DANA', 'OVO', 'GoPay', 'ShopeePay'] as $ewallet)
                                <button type="submit" name="payment_method" value="{{ $ewallet }}" class="px-4 py-3 bg-zinc-950/60 border {{ $payment->payment_method === $ewallet ? 'border-red-600 bg-red-950/10' : 'border-zinc-800 hover:border-zinc-700' }} rounded-2xl text-left text-xs font-bold uppercase tracking-wider flex items-center justify-between transition">
                                    <span>{{ $ewallet }}</span>
                                    @if($payment->payment_method === $ewallet)
                                        <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                    @endif
                                </button>
                            @endforeach
                        </form>
                    </div>
                </div>

                {{-- Accordion 4: Convenience Store --}}
                <div class="border border-zinc-800 rounded-3xl overflow-hidden bg-zinc-900/40">
                    <button type="button" onclick="toggleAccordion('store-panel')" class="w-full flex items-center justify-between p-6 text-sm font-bold uppercase tracking-wide text-zinc-300 hover:text-white transition">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Convenience Store
                        </span>
                        <svg id="store-panel-icon" class="w-4 h-4 transform transition-transform {{ $isStore ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="store-panel" class="p-6 border-t border-zinc-800/80 space-y-4 {{ $isStore ? '' : 'hidden' }}">
                        <p class="text-zinc-500 text-xs">Pilih salah satu gerai retail berikut:</p>
                        <form action="{{ route('pengguna.payments.select-method', $payment->id) }}" method="POST" class="grid grid-cols-2 gap-3">
                            @csrf
                            @foreach(['Alfamart', 'Indomaret'] as $store)
                                <button type="submit" name="payment_method" value="{{ $store }}" class="px-4 py-3 bg-zinc-950/60 border {{ $payment->payment_method === $store ? 'border-red-600 bg-red-950/10' : 'border-zinc-800 hover:border-zinc-700' }} rounded-2xl text-left text-xs font-bold uppercase tracking-wider flex items-center justify-between transition">
                                    <span>{{ $store }}</span>
                                    @if($payment->payment_method === $store)
                                        <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                    @endif
                                </button>
                            @endforeach
                        </form>
                    </div>
                </div>

                {{-- Payment Instructions Box (Only visible if a method is selected) --}}
                @if($payment->payment_method)
                    <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-6 md:p-8 space-y-6">
                        <div>
                            <h4 class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Rincian Pembayaran</h4>
                            <p class="text-sm font-bold text-white uppercase tracking-wider mt-1">{{ $payment->payment_method }}</p>
                        </div>

                        @if($isQris)
                            <div class="flex flex-col items-center justify-center space-y-4 bg-zinc-950 p-6 rounded-2xl border border-zinc-850">
                                <span class="text-[10px] text-zinc-550 uppercase tracking-widest font-bold">Scan QRIS CODE</span>
                                
                                <div class="bg-white p-4 rounded-3xl inline-block shadow-lg border border-zinc-200">
                                    @if (class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode'))
                                        {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate($payment->payment_code ?? 'PAY-INV') !!}
                                    @else
                                        <!-- Fallback client side QR Code generator -->
                                        <div id="qrcode-fallback"></div>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                new QRCode(document.getElementById("qrcode-fallback"), {
                                                    text: "{{ $payment->payment_code }}",
                                                    width: 200,
                                                    height: 200
                                                });
                                            });
                                        </script>
                                    @endif
                                </div>
                                <span class="font-mono text-xs text-zinc-400 font-bold bg-zinc-900 px-4 py-2 rounded-xl border border-zinc-800 mt-2">
                                    {{ $payment->payment_code }}
                                </span>
                            </div>
                        @else
                            <div class="bg-zinc-950 p-6 rounded-2xl border border-zinc-850 flex items-center justify-between gap-4">
                                <div>
                                    <span class="text-[10px] text-zinc-550 uppercase tracking-widest font-bold block">Kode Bayar / VA Number</span>
                                    <span class="font-mono text-base md:text-lg font-bold text-white tracking-widest mt-1 block" id="payment-code-text">{{ $payment->payment_code }}</span>
                                </div>
                                <button type="button" onclick="copyToClipboard('{{ $payment->payment_code }}')" class="px-4 py-2.5 bg-zinc-900 hover:bg-zinc-850 text-zinc-300 font-bold uppercase text-[10px] tracking-wider rounded-xl border border-zinc-800 transition">
                                    Salin
                                </button>
                            </div>
                        @endif

                        <div class="text-xs text-zinc-400 space-y-2 leading-relaxed">
                            <span class="text-[10px] uppercase text-zinc-550 tracking-wider font-bold block mb-1">Petunjuk Pembayaran:</span>
                            @if($isBank)
                                <p>1. Salin kode Virtual Account di atas.</p>
                                <p>2. Buka aplikasi M-Banking Anda atau pergi ke ATM terdekat.</p>
                                <p>3. Pilih menu Transfer → Virtual Account / Virtual Billing.</p>
                                <p>4. Masukkan kode Virtual Account yang telah disalin.</p>
                                <p>5. Konfirmasi nominal pembayaran dan selesaikan transaksi.</p>
                            @elseif($isEwallet)
                                <p>1. Silakan masukkan nomor telepon e-wallet Anda.</p>
                                <p>2. Buka notifikasi pada aplikasi {{ $payment->payment_method }} Anda.</p>
                                <p>3. Konfirmasi pembayaran dan masukkan PIN Anda.</p>
                            @elseif($isStore)
                                <p>1. Kunjungi gerai {{ $payment->payment_method }} terdekat.</p>
                                <p>2. Beritahukan ke kasir untuk melakukan pembayaran BENGKELIN.</p>
                                <p>3. Tunjukkan Kode Bayar di atas ke kasir.</p>
                                <p>4. Bayar sesuai nominal transaksi dan simpan struk pembayaran.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Column: Order Summary --}}
            <div class="lg:col-span-5">
                <div class="sticky top-6 bg-zinc-900 border border-zinc-800 rounded-3xl p-6 md:p-8 shadow-xl space-y-6">
                    <h3 class="text-lg font-bengkel tracking-wider uppercase border-b border-zinc-800 pb-4">Ringkasan Pesanan</h3>

                    {{-- Products List --}}
                    <div class="space-y-4 max-h-[250px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($purchases as $purchase)
                            <div class="flex items-center gap-4 py-2 border-b border-zinc-850 last:border-b-0">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-white uppercase truncate">{{ $purchase->barang_nama }}</p>
                                    <p class="text-[10px] text-zinc-500 mt-0.5">Rp {{ number_format($purchase->harga, 0, ',', '.') }} × {{ $purchase->jumlah }} unit</p>
                                </div>
                                <span class="text-xs font-bold text-zinc-300">
                                    Rp {{ number_format($purchase->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <hr class="border-zinc-800">

                    {{-- Invoice & Cost Summary --}}
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between text-zinc-450">
                            <span>Subtotal</span>
                            <span class="font-bold text-zinc-300">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-450">
                            <span>Biaya Pengiriman</span>
                            <span class="font-bold text-emerald-400 uppercase tracking-widest text-[9px]">Gratis Ongkir</span>
                        </div>
                        <div class="pt-4 border-t border-zinc-800 flex justify-between items-baseline">
                            <span class="font-bold text-white uppercase tracking-wider text-xs">Grand Total</span>
                            <span class="text-xl font-bengkel tracking-wider text-red-500">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Checkout Button --}}
                    @if($payment->payment_method)
                        <button type="button" onclick="openModal()" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl uppercase text-xs tracking-widest transition shadow-xl shadow-red-900/30">
                            Bayar Sekarang (Simulasi)
                        </button>
                    @else
                        <button type="button" disabled class="w-full py-4 bg-zinc-800 text-zinc-500 font-bold rounded-2xl uppercase text-xs tracking-widest cursor-not-allowed opacity-50">
                            Pilih Metode Pembayaran
                        </button>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div id="confirm-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-black/85 backdrop-blur-sm transition-all duration-300">
    <div class="bg-zinc-900 border border-zinc-800 w-full max-w-md rounded-3xl p-8 shadow-2xl text-center space-y-6">
        <div class="w-16 h-16 bg-red-600/10 border border-red-600/30 text-red-500 rounded-full flex items-center justify-center mx-auto shadow-lg shadow-red-900/20">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="space-y-2">
            <h3 class="text-lg font-bengkel uppercase tracking-wider text-white">Konfirmasi Pembayaran</h3>
            <p class="text-zinc-400 text-xs leading-relaxed">
                Pembayaran Anda akan disimulasikan berhasil secara lokal di database kami. Apakah Anda yakin ingin melanjutkan?
            </p>
        </div>
        <div class="flex gap-4">
            <button type="button" onclick="closeModal()" class="flex-1 py-3.5 bg-zinc-850 hover:bg-zinc-800 text-zinc-300 font-bold uppercase text-[10px] tracking-widest border border-zinc-800 rounded-xl transition duration-200">Batal</button>
            <form action="{{ route('pengguna.payments.pay', $payment->id) }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold uppercase text-[10px] tracking-widest rounded-xl transition duration-200 shadow-lg shadow-red-900/20">Bayar</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Accordion Toggle
    function toggleAccordion(id) {
        const panels = ['bank-transfer-panel', 'qris-panel', 'ewallet-panel', 'store-panel'];
        panels.forEach(panelId => {
            const panel = document.getElementById(panelId);
            const icon = document.getElementById(panelId + '-icon');
            if (panelId === id) {
                panel.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            } else {
                panel.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    }

    // Modal Operations
    function openModal() {
        document.getElementById('confirm-modal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
    }

    // Copy to Clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert("Kode pembayaran berhasil disalin!");
        }, function(err) {
            console.error("Gagal menyalin kode: ", err);
        });
    }

    // Realtime JS Countdown
    document.addEventListener('DOMContentLoaded', function() {
        const expiredAt = new Date("{{ $payment->expired_at->toIso8601String() }}").getTime();
        const countdownEl = document.getElementById('countdown-timer');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiredAt - now;

            if (distance < 0) {
                clearInterval(interval);
                countdownEl.innerHTML = "KADALUARSA";
                countdownEl.classList.remove('text-red-500');
                countdownEl.classList.add('text-zinc-500');
                window.location.reload(); // Re-trigger route logic to mark as expired and redirect
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Format double digits
            const formattedMin = String(minutes).padStart(2, '0');
            const formattedSec = String(seconds).padStart(2, '0');

            countdownEl.innerHTML = `Complete Payment In ${formattedMin} Minutes ${formattedSec} Seconds`;
        }

        updateCountdown();
        const interval = setInterval(updateCountdown, 1000);
    });
</script>
@endsection
