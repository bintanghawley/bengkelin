@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">
    <section class="relative overflow-hidden bg-gradient-to-br from-[#0b3aa6] via-[#0f4fd9] to-[#0c3fbc]">
        <style>
            @keyframes fade-up {
                0% { opacity: 0; transform: translateY(12px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .fade-up { animation: fade-up 0.8s ease-out both; }
            .fade-up-delay { animation-delay: 0.15s; }
            .range-input {
                -webkit-appearance: none;
                appearance: none;
            }
            .range-input::-webkit-slider-runnable-track {
                height: 8px;
                background: transparent;
            }
            .range-input::-moz-range-track {
                height: 8px;
                background: transparent;
            }
            .range-input::-webkit-slider-thumb {
                -webkit-appearance: none;
                height: 18px;
                width: 18px;
                border-radius: 9999px;
                background: #2563eb;
                border: 2px solid #ffffff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
                cursor: pointer;
            }
            .range-input::-moz-range-thumb {
                height: 18px;
                width: 18px;
                border-radius: 9999px;
                background: #2563eb;
                border: 2px solid #ffffff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
                cursor: pointer;
            }
        </style>

        <nav class="w-full border-b border-zinc-200/50 dark:border-zinc-900/60 bg-white/90 dark:bg-zinc-950/90 backdrop-blur relative z-30 text-zinc-900 dark:text-white transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-10 h-10 object-contain">
                    <span class="text-xl font-bengkel tracking-wider text-zinc-900 dark:text-white">Bengkel<span class="text-red-600">in</span></span>
                </a>
                <div class="hidden lg:flex items-center gap-10 text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                    <a href="{{ route('servis') }}" class="hover:text-zinc-900 dark:hover:text-white transition">Servis</a>
                    <a href="{{ route('toko.banmotor') }}" class="hover:text-zinc-900 dark:hover:text-white transition">Ban Motor</a>
                    <a href="{{ route('toko.oli') }}" class="text-red-600 dark:text-white transition">Oli Motor</a>
                    <a href="{{ route('toko.sparepart') }}" class="hover:text-zinc-900 dark:hover:text-white transition">Sparepart</a>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Cari">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-550 dark:text-zinc-300">
                            <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    @include('partials.cart-widget')


                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Dashboard">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-550 dark:text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @elseif (Auth::user()->role === 'mekanik')
                            <a href="{{ route('mekanik.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Dashboard">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-550 dark:text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('pengguna.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Dashboard">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-550 dark:text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                    @guest
                        <div class="relative group">
                            <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Akun">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-550 dark:text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="absolute right-0 top-full pt-2 w-72 z-50 opacity-0 translate-y-1 pointer-events-none transition group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:translate-y-0 group-focus-within:pointer-events-auto">
                                <div class="bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white border border-zinc-200 dark:border-zinc-800 rounded-2xl shadow-2xl p-4 space-y-3">
                                    <p class="text-sm font-semibold">Akun</p>
                                    <a href="{{ route('login') }}" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-full transition">Login</a>
                                    <a href="{{ route('register') }}" class="block w-full text-center border border-red-600 text-red-600 hover:bg-red-50 font-semibold py-2.5 rounded-full transition">Daftar Akun</a>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <div class="absolute inset-0">
            <div class="absolute right-[-10%] top-[-10%] h-[140%] w-[60%] opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(135deg, rgba(255,255,255,0.18) 0, rgba(255,255,255,0.18) 6px, transparent 6px, transparent 26px);"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-10 lg:py-14 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="relative">
                <div class="relative w-full max-w-lg mx-auto lg:mx-0">
                    <div class="absolute -top-6 -left-6 h-24 w-24 bg-white/15 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -right-12 h-32 w-32 bg-black/25 rounded-full blur-2xl"></div>
                    <div class="relative rounded-[2rem] bg-[#0a2f86] p-4 shadow-[0_30px_80px_rgba(0,0,0,0.35)]">
                        <img src="{{ asset('img/image.png') }}" alt="Oli Motor" class="w-full h-full object-cover rounded-[1.5rem] aspect-[4/3]">
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-center lg:text-left space-y-6">
                <p class="text-2xl md:text-3xl font-light tracking-wide fade-up">Menjaga Suhu Mesin Tetap Stabil,</p>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bengkel uppercase tracking-wide fade-up fade-up-delay">Dijamin Tahan Lama Hingga 5000 KM</h1>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <div class="inline-flex items-center gap-3 rounded-full bg-blue-900/40 border border-blue-200/10 px-4 py-2 text-sm text-blue-100">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-200/10 text-blue-100">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                <path d="M9 12l2 2 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 3l7 4v5c0 4.418-3.134 7.418-7 9-3.866-1.582-7-4.582-7-9V7l7-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        Bersertifikasi SNI &amp; JASO (JAPAN)
                    </div>
                    <div class="inline-flex items-center gap-3 rounded-full bg-blue-900/40 border border-blue-200/10 px-4 py-2 text-sm text-blue-100">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-200/10 text-blue-100">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                <path d="M6 3h12v18H6z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 7h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 11h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        Teknologi Full Synthetic-Ester
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <form action="{{ route('toko.oli') }}" method="GET" id="filter-form">
                <input type="hidden" name="sort" id="sort-input" value="{{ request('sort') }}">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="w-full lg:flex-1">
                        <div class="relative max-w-xl">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                    <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari oli buat motormu disini" class="w-full pl-11 pr-4 py-3 rounded-full border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition placeholder:text-zinc-400 dark:placeholder:text-zinc-555">
                        </div>
                    </div>
                    <div class="text-sm text-zinc-500">
                        Menampilkan {{ $oils->firstItem() ?: 0 }} - {{ $oils->lastItem() ?: 0 }} dari {{ $oils->total() }} Data
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-zinc-500">Urutkan</span>
                        <div class="relative">
                            <button type="button" id="sort-toggle" aria-expanded="false" aria-haspopup="true" class="min-w-[200px] inline-flex items-center justify-between gap-3 px-4 py-3 rounded-full border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-sm text-zinc-700 dark:text-zinc-300 transition">
                                <span id="sort-label" class="text-zinc-500">{{ request('sort') ?: 'Pilih' }}</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500">
                                    <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div id="sort-menu" class="absolute right-0 mt-2 w-56 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl shadow-lg py-2 hidden z-40">
                                <button type="button" data-sort="Harga Tertinggi" class="w-full text-left px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">Harga Tertinggi</button>
                                <button type="button" data-sort="Harga Paling Murah" class="w-full text-left px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">Harga Paling Murah</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 lg:grid-cols-12 gap-10">
                    <aside class="lg:col-span-3">
                        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6 shadow-sm transition">
                            <h3 class="text-lg font-semibold mb-6">Filter</h3>
                            <div class="space-y-6">
                                <div>
                                    <p class="text-sm font-semibold mb-4">Kategori</p>
                                    <details open class="group">
                                        <summary class="flex items-center justify-between text-sm font-semibold cursor-pointer">
                                            <span class="text-zinc-900 dark:text-white">Oli</span>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 transition-transform group-open:rotate-180">
                                                <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </summary>
                                        <div class="mt-3 space-y-2 text-sm text-zinc-650 dark:text-zinc-400 pl-2">
                                            <label class="flex items-center gap-2 cursor-pointer hover:text-zinc-800 dark:hover:text-zinc-300 transition">
                                                <input type="checkbox" name="jenis_oli[]" value="oli motor matic" {{ in_array('oli motor matic', request('jenis_oli', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                Oli Motor Matic
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer hover:text-zinc-800 dark:hover:text-zinc-300 transition">
                                                <input type="checkbox" name="jenis_oli[]" value="oli motor bebek" {{ in_array('oli motor bebek', request('jenis_oli', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                Oli Motor Bebek
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer hover:text-zinc-800 dark:hover:text-zinc-300 transition">
                                                <input type="checkbox" name="jenis_oli[]" value="oli motor sport" {{ in_array('oli motor sport', request('jenis_oli', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                Oli Motor Sport
                                            </label>
                                        </div>
                                    </details>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-semibold">Harga</span>
                                        <span class="text-zinc-500">Rp <span id="harga-min-label">{{ number_format(request('harga_min', 0), 0, ',', '.') }}</span> - Rp <span id="harga-max-label">{{ number_format(request('harga_max', 500000), 0, ',', '.') }}</span></span>
                                    </div>
                                    <div class="relative h-2">
                                        <div class="absolute inset-0 bg-zinc-200 dark:bg-zinc-800 rounded-full"></div>
                                        <div id="harga-track" class="absolute h-2 bg-blue-600 rounded-full"></div>
                                        <input id="harga-min" name="harga_min" type="range" min="0" max="500000" step="5000" value="{{ request('harga_min', 0) }}" class="range-input absolute inset-0 w-full h-2 bg-transparent appearance-none z-20">
                                        <input id="harga-max" name="harga_max" type="range" min="0" max="500000" step="5000" value="{{ request('harga_max', 500000) }}" class="range-input absolute inset-0 w-full h-2 bg-transparent appearance-none z-30">
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input id="harga-min-input" type="text" value="Rp {{ number_format(request('harga_min', 0), 0, ',', '.') }}" readonly class="w-full border border-zinc-200 dark:border-zinc-800 rounded-xl px-3 py-2 text-sm text-zinc-600 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-950 transition">
                                        <input id="harga-max-input" type="text" value="Rp {{ number_format(request('harga_max', 500000), 0, ',', '.') }}" readonly class="w-full border border-zinc-200 dark:border-zinc-800 rounded-xl px-3 py-2 text-sm text-zinc-600 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-950 transition">
                                    </div>
                                </div>

                                <details open class="group border-t border-zinc-200 dark:border-zinc-800 pt-6">
                                    <summary class="flex items-center justify-between text-sm font-semibold cursor-pointer mb-4">
                                        <span class="text-zinc-900 dark:text-white">Kekentalan</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 transition-transform group-open:rotate-180">
                                            <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </summary>
                                    <div class="mt-3 space-y-2 text-sm text-zinc-650 dark:text-zinc-400">
                                        @foreach(['10W30', '10W40', '20W50'] as $kk)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" name="kekentalan[]" value="{{ $kk }}" {{ in_array($kk, request('kekentalan', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                {{ $kk }}
                                            </label>
                                        @endforeach
                                    </div>
                                </details>

                                <details open class="group border-t border-zinc-200 dark:border-zinc-800 pt-6">
                                    <summary class="flex items-center justify-between text-sm font-semibold cursor-pointer mb-4">
                                        <span class="text-zinc-900 dark:text-white">Ukuran</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 transition-transform group-open:rotate-180">
                                            <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </summary>
                                    <div class="mt-3 space-y-2 text-sm text-zinc-655 dark:text-zinc-400">
                                        @foreach(['1 L', '30ML', '40ML', '120ML', '200 ml', '200ML', '500ML', '800 mL', '800 ml', '900 ml', '900 mL'] as $uk)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" name="ukuran[]" value="{{ $uk }}" {{ in_array($uk, request('ukuran', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                {{ $uk }}
                                            </label>
                                        @endforeach
                                    </div>
                                </details>

                                <details open class="group border-t border-zinc-200 dark:border-zinc-800 pt-6">
                                    <summary class="flex items-center justify-between text-sm font-semibold cursor-pointer mb-4">
                                        <span class="text-zinc-900 dark:text-white">Tipe Oli</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 transition-transform group-open:rotate-180">
                                            <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </summary>
                                    <div class="mt-3 space-y-2 text-sm text-zinc-650 dark:text-zinc-400">
                                        @foreach(['Oli Double Ester', 'Oli Ester', 'Oli Gear', 'Oli Semi Sintetik'] as $to)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" name="tipe_oli[]" value="{{ $to }}" {{ in_array($to, request('tipe_oli', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                {{ $to }}
                                            </label>
                                        @endforeach
                                    </div>
                                </details>

                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-full transition uppercase tracking-widest text-[11px]">Tampilkan</button>
                            </div>
                        </div>
                    </aside>
                    <div class="lg:col-span-9">
                        @if ($oils->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($oils as $oil)
                                    <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                                        <a href="{{ route('toko.oli.show', $oil->id) }}" class="flex-1 flex flex-col">
                                            <div class="aspect-square bg-zinc-100 dark:bg-zinc-800/30 flex items-center justify-center relative overflow-hidden">
                                                @if($oil->gambar)
                                                    <img src="{{ str_starts_with($oil->gambar, 'img/') || str_starts_with($oil->gambar, 'http') ? asset($oil->gambar) : asset('storage/' . $oil->gambar) }}" alt="{{ $oil->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                                @else
                                                    <div class="absolute inset-0 p-6">
                                                        <div class="w-full h-full border border-dashed border-zinc-300 dark:border-zinc-700/60 rounded-2xl flex flex-col items-center justify-center text-zinc-400 dark:text-zinc-500 gap-2">
                                                            <svg class="w-10 h-10 stroke-[1.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                            <span class="text-[9px] uppercase tracking-widest font-bold">Gambar Oli Kosong</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                                                <h4 class="font-bold text-sm uppercase tracking-wide text-zinc-800 dark:text-zinc-200 line-clamp-2 min-h-[2.5rem] group-hover:text-blue-600 transition">
                                                    {{ $oil->nama }}
                                                </h4>
                                                <div class="flex items-baseline gap-0.5 text-zinc-950 dark:text-white">
                                                    <span class="text-[10px] font-bold">Rp</span>
                                                    <span class="text-2xl font-bengkel tracking-wider">{{ number_format($oil->harga, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Custom Pagination -->
                            <div class="mt-12 flex justify-center">
                                {{ $oils->links() }}
                            </div>
                        @else
                            <div class="min-h-[400px] rounded-3xl border border-dashed border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900/40 flex flex-col items-center justify-center text-center p-8 transition duration-300">
                                <svg class="w-16 h-16 text-zinc-300 dark:text-zinc-700 stroke-[1.2] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <h3 class="text-lg font-bold uppercase tracking-wider text-zinc-800 dark:text-zinc-200">Oli Tidak Ditemukan</h3>
                                <p class="text-xs text-zinc-400 dark:text-zinc-500 mt-2 max-w-sm">Coba sesuaikan filter pencarian Anda untuk menemukan oli motor yang cocok.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        const sortToggle = document.getElementById('sort-toggle');
        const sortMenu = document.getElementById('sort-menu');
        const sortLabel = document.getElementById('sort-label');

        const closeSortMenu = () => {
            if (!sortMenu) {
                return;
            }
            sortMenu.classList.add('hidden');
            sortToggle?.setAttribute('aria-expanded', 'false');
        };

        const openSortMenu = () => {
            if (!sortMenu) {
                return;
            }
            sortMenu.classList.remove('hidden');
            sortToggle?.setAttribute('aria-expanded', 'true');
        };

        if (sortToggle) {
            sortToggle.addEventListener('click', (event) => {
                event.stopPropagation();
                const isOpen = !sortMenu.classList.contains('hidden');
                if (isOpen) {
                    closeSortMenu();
                    return;
                }
                openSortMenu();
            });
        }

        if (sortMenu) {
            sortMenu.querySelectorAll('button[data-sort]').forEach((button) => {
                button.addEventListener('click', () => {
                    sortLabel.textContent = button.dataset.sort;
                    document.getElementById('sort-input').value = button.dataset.sort;
                    closeSortMenu();
                    document.getElementById('filter-form').submit();
                });
            });
        }

        document.addEventListener('click', () => {
            closeSortMenu();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeSortMenu();
            }
        });

        const minRange = document.getElementById('harga-min');
        const maxRange = document.getElementById('harga-max');
        const minLabel = document.getElementById('harga-min-label');
        const maxLabel = document.getElementById('harga-max-label');
        const minInput = document.getElementById('harga-min-input');
        const maxInput = document.getElementById('harga-max-input');
        const track = document.getElementById('harga-track');
        const maxValue = 500000;
        const gap = 5000;

        const formatRupiah = (value) => {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        const updateRange = (source) => {
            if (!minRange || !maxRange || !track) {
                return;
            }
            let minVal = parseInt(minRange.value, 10);
            let maxVal = parseInt(maxRange.value, 10);
            if (maxVal - minVal < gap) {
                if (source === minRange) {
                    minVal = maxVal - gap;
                    minRange.value = minVal;
                } else if (source === maxRange) {
                    maxVal = minVal + gap;
                    maxRange.value = maxVal;
                }
            }
            minLabel.textContent = formatRupiah(minVal);
            maxLabel.textContent = formatRupiah(maxVal);
            minInput.value = `Rp ${formatRupiah(minVal)}`;
            maxInput.value = `Rp ${formatRupiah(maxVal)}`;
            const minPercent = (minVal / maxValue) * 100;
            const maxPercent = (maxVal / maxValue) * 100;
            track.style.left = `${minPercent}%`;
            track.style.right = `${100 - maxPercent}%`;
        };

        if (minRange && maxRange) {
            minRange.addEventListener('input', (event) => updateRange(event.target));
            maxRange.addEventListener('input', (event) => updateRange(event.target));
            updateRange();
        }
    </script>
</div>
@endsection
