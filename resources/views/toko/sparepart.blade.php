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
                background: #ef4444;
                border: 2px solid #ffffff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
                cursor: pointer;
            }
            .range-input::-moz-range-thumb {
                height: 18px;
                width: 18px;
                border-radius: 9999px;
                background: #ef4444;
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
                    <a href="{{ route('toko.oli') }}" class="hover:text-zinc-900 dark:hover:text-white transition">Oli Motor</a>
                    <a href="{{ route('toko.sparepart') }}" class="text-red-600 dark:text-white transition">Sparepart</a>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Cari">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 dark:text-zinc-300">
                            <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <a href="{{ route('toko.index') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Keranjang">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 dark:text-zinc-300">
                            <path d="M6 6h15l-1.5 9h-12z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 6l-2-3H2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                    </a>
                    <!-- Theme Toggle Button -->
                    <button type="button" class="theme-toggle-btn inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 text-zinc-700 dark:text-zinc-300 transition" aria-label="Ganti Tema">
                        <!-- Moon icon -->
                        <svg class="theme-toggle-dark-icon hidden w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                        <!-- Sun icon -->
                        <svg class="theme-toggle-light-icon hidden w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                    </button>
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
                                    <a href="{{ route('login') }}" class="block w-full text-center bg-[#004aad] hover:bg-blue-800 text-white font-semibold py-2.5 rounded-full transition">Login</a>
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
                        <img src="{{ asset('img/image.png') }}" alt="Sparepart" class="w-full h-full object-cover rounded-[1.5rem] aspect-[4/3]">
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-center lg:text-left space-y-6">
                <p class="text-xl font-bold italic tracking-wide fade-up flex gap-4 text-white"><span class="text-yellow-400">X-TEN</span> <span class="text-yellow-400">X-GRADE</span> <span class="text-white">X-SMART</span></p>
                <h1 class="text-4xl md:text-5xl lg:text-5xl tracking-wide fade-up fade-up-delay font-light">Sparepart Xgrade Ahlinya <span class="font-bold">Naikin<br>Performance Mesin Motormu</span></h1>
                <p class="text-lg text-blue-100 max-w-xl leading-relaxed fade-up fade-up-delay">Berkualitas seperti spare-part motor baru</p>
            </div>
        </div>
    </section>

    <section class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <form action="{{ route('toko.sparepart') }}" method="GET" id="filter-form">
                <input type="hidden" name="sort" id="sort-input" value="{{ request('sort') }}">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="w-full lg:flex-1">
                        <div class="relative max-w-xl">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                    <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari sparepart buat motormu disini" class="w-full pl-11 pr-4 py-3 rounded-full border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition placeholder:text-zinc-400 dark:placeholder:text-zinc-555">
                        </div>
                    </div>
                    <div class="text-sm text-zinc-500">
                        Menampilkan {{ $spareparts->firstItem() ?: 0 }} - {{ $spareparts->lastItem() ?: 0 }} dari {{ $spareparts->total() }} Data
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-zinc-500">Urutkan</span>
                        <div class="relative">
                            <button type="button" id="sort-toggle" aria-expanded="false" aria-haspopup="true" class="min-w-[200px] inline-flex items-center justify-between gap-3 px-4 py-3 rounded-full border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-sm text-zinc-700 dark:text-zinc-300 transition">
                                <span id="sort-label" class="text-zinc-500">{{ request('sort') ?: 'Pilih' }}</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-550">
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
                                            <span class="text-zinc-900 dark:text-white">Sparepart</span>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 transition-transform group-open:rotate-180">
                                                <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </summary>
                                        <div class="mt-3 space-y-2 text-sm text-zinc-650 dark:text-zinc-400 pl-2">
                                            <label class="flex items-center gap-2 cursor-pointer hover:text-zinc-800 dark:hover:text-zinc-300 transition">
                                                <input type="checkbox" name="jenis_sparepart[]" value="aki motor" {{ in_array('aki motor', request('jenis_sparepart', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                Aki Motor
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer hover:text-zinc-800 dark:hover:text-zinc-300 transition">
                                                <input type="checkbox" name="jenis_sparepart[]" value="filter udara motor" {{ in_array('filter udara motor', request('jenis_sparepart', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                Filter Udara Motor
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer hover:text-zinc-800 dark:hover:text-zinc-300 transition">
                                                <input type="checkbox" name="jenis_sparepart[]" value="kampas rem" {{ in_array('kampas rem', request('jenis_sparepart', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                Kampas Rem
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer hover:text-zinc-800 dark:hover:text-zinc-300 transition">
                                                <input type="checkbox" name="jenis_sparepart[]" value="cairan anti bocor" {{ in_array('cairan anti bocor', request('jenis_sparepart', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                Cairan Anti Bocor
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
                                        <div id="harga-track" class="absolute h-2 bg-red-600 rounded-full"></div>
                                        <input id="harga-min" name="harga_min" type="range" min="0" max="500000" step="5000" value="{{ request('harga_min', 0) }}" class="range-input absolute inset-0 w-full h-2 bg-transparent appearance-none z-20">
                                        <input id="harga-max" name="harga_max" type="range" min="0" max="500000" step="5000" value="{{ request('harga_max', 500000) }}" class="range-input absolute inset-0 w-full h-2 bg-transparent appearance-none z-30">
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input id="harga-min-input" type="text" value="Rp {{ number_format(request('harga_min', 0), 0, ',', '.') }}" readonly class="w-full border border-zinc-200 dark:border-zinc-800 rounded-xl px-3 py-2 text-sm text-zinc-650 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-950 transition">
                                        <input id="harga-max-input" type="text" value="Rp {{ number_format(request('harga_max', 500000), 0, ',', '.') }}" readonly class="w-full border border-zinc-200 dark:border-zinc-800 rounded-xl px-3 py-2 text-sm text-zinc-650 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-950 transition">
                                    </div>
                                </div>

                                <details open class="group border-t border-zinc-200 dark:border-zinc-800 pt-6">
                                    <summary class="flex items-center justify-between text-sm font-semibold cursor-pointer mb-4">
                                        <span class="text-zinc-900 dark:text-white">Merek</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-550 transition-transform group-open:rotate-180">
                                            <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </summary>
                                    <div class="mt-3 space-y-2 text-sm text-zinc-650 dark:text-zinc-400">
                                        @foreach(['X-Grade', 'X-Ten', 'MK', 'Denso', 'Jossz', 'X-Guard', 'X-Smart'] as $mr)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" name="merek[]" value="{{ $mr }}" {{ in_array($mr, request('merek', [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                                                {{ $mr }}
                                            </label>
                                        @endforeach
                                    </div>
                                </details>

                                <button type="submit" class="w-full bg-[#004aad] hover:bg-blue-800 text-white font-semibold py-3 rounded-full transition uppercase tracking-widest text-[11px]">Tampilkan</button>
                            </div>
                        </div>
                    </aside>
                    <div class="lg:col-span-9">
                        @if ($spareparts->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($spareparts as $sparepart)
                                    <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                                        <a href="{{ route('toko.sparepart.show', $sparepart->id) }}" class="flex-1 flex flex-col">
                                            <div class="aspect-square bg-zinc-100 dark:bg-zinc-800/30 flex items-center justify-center relative p-6">
                                                @if($sparepart->gambar)
                                                    <img src="{{ asset('storage/' . $sparepart->gambar) }}" alt="{{ $sparepart->nama }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition duration-500">
                                                @else
                                                    <div class="w-full h-full border border-dashed border-zinc-300 dark:border-zinc-700/60 rounded-2xl flex flex-col items-center justify-center text-zinc-400 dark:text-zinc-500 gap-2">
                                                        <svg class="w-10 h-10 stroke-[1.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        <span class="text-[9px] uppercase tracking-widest font-bold">Gambar Kosong</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                                                <h4 class="font-bold text-sm uppercase tracking-wide text-zinc-800 dark:text-zinc-200 line-clamp-2 min-h-[2.5rem] group-hover:text-blue-600 transition">
                                                    {{ $sparepart->nama }}
                                                </h4>
                                                <div class="flex items-baseline gap-0.5 text-zinc-950 dark:text-white">
                                                    <span class="text-[10px] font-bold">Rp</span>
                                                    <span class="text-2xl font-bengkel tracking-wider">{{ number_format($sparepart->harga, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Custom Pagination -->
                            <div class="mt-12 flex justify-center">
                                {{ $spareparts->links() }}
                            </div>
                        @else
                            <div class="min-h-[400px] rounded-3xl border border-dashed border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900/40 flex flex-col items-center justify-center text-center p-8 transition duration-300">
                                <svg class="w-16 h-16 text-zinc-300 dark:text-zinc-700 stroke-[1.2] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <h3 class="text-lg font-bold uppercase tracking-wider text-zinc-800 dark:text-zinc-200">Sparepart Tidak Ditemukan</h3>
                                <p class="text-xs text-zinc-400 dark:text-zinc-500 mt-2 max-w-sm">Coba sesuaikan filter pencarian Anda untuk menemukan sparepart yang cocok.</p>
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
