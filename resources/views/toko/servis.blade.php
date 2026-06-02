@extends('layouts.guest')

@section('content')
<div class="bg-zinc-950 text-white">
    <section class="relative overflow-hidden bg-gradient-to-br from-[#ea0d2b] via-[#d90d2a] to-[#b40b23]">
        <style>
            @keyframes float-soft {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            @keyframes fade-up {
                0% { opacity: 0; transform: translateY(12px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .float-soft { animation: float-soft 8s ease-in-out infinite; }
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

        <nav class="w-full border-b border-zinc-900/60 bg-zinc-950/90 backdrop-blur relative z-30">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-10 h-10 object-contain">
                    <span class="text-xl font-bengkel tracking-wider">Bengkel<span class="text-red-600">in</span></span>
                </a>
                <div class="hidden lg:flex items-center gap-10 text-xs font-semibold uppercase tracking-widest text-zinc-400">
                    <a href="{{ route('servis') }}" class="hover:text-white transition">Servis</a>
                    <a href="{{ route('toko.banmotor') }}" class="hover:text-white transition">Ban Motor</a>
                    <a href="{{ route('toko.oli') }}" class="hover:text-white transition">Oli Motor</a>
                    <a href="{{ route('toko.sparepart') }}" class="hover:text-white transition">Sparepart</a>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Cari">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                            <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <a href="{{ route('toko.index') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Keranjang">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                            <path d="M6 6h15l-1.5 9h-12z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 6l-2-3H2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                    </a>
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Dashboard">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @elseif (Auth::user()->role === 'mekanik')
                            <a href="{{ route('mekanik.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Dashboard">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('pengguna.dashboard') }}" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Dashboard">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                    @guest
                        <div class="relative group">
                            <button type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-full border border-zinc-800 hover:bg-zinc-900 transition" aria-label="Akun">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-300">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="absolute right-0 top-full pt-2 w-72 z-50 opacity-0 translate-y-1 pointer-events-none transition group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:translate-y-0 group-focus-within:pointer-events-auto">
                                <div class="bg-white text-zinc-900 border border-zinc-200 rounded-2xl shadow-2xl p-4 space-y-3">
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
            <div class="absolute right-[-10%] top-[-10%] h-[140%] w-[60%] opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(135deg, rgba(255,255,255,0.25) 0, rgba(255,255,255,0.25) 6px, transparent 6px, transparent 26px);"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-10 lg:py-14 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div class="relative w-full max-w-lg mx-auto lg:mx-0">
                    <div class="absolute -top-6 -left-6 h-24 w-24 bg-white/15 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -right-12 h-32 w-32 bg-black/20 rounded-full blur-2xl"></div>
                    <div class="relative rounded-[2rem] bg-[#b90b24] p-4 shadow-[0_30px_80px_rgba(0,0,0,0.35)]">
                        <img src="{{ asset('img/Gemini_Generated_Image_m0vuzjm0vuzjm0vu.png') }}" alt="Workshop Bengkelin" class="w-full h-full object-cover rounded-[1.5rem] aspect-[4/3]">
                    </div>
                    <img src="{{ asset('img/Gemini_Generated_Image_rlwfwprlwfwprlwf.png') }}" alt="Motor" class="hidden md:block absolute -bottom-10 -left-4 w-52 drop-shadow-[0_25px_35px_rgba(0,0,0,0.45)] float-soft">
                    <img src="{{ asset('img/Gemini_Generated_Image_rlwfwprlwfwprlwf.png') }}" alt="Motor" class="md:hidden mt-6 w-52 mx-auto drop-shadow-[0_20px_30px_rgba(0,0,0,0.35)]">
                </div>
            </div>

            <div class="relative z-10 text-center lg:text-left space-y-6">
                <p class="text-2xl md:text-3xl font-light tracking-wide fade-up">Mau Tarikan Motormu Enteng</p>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bengkel uppercase tracking-wide fade-up fade-up-delay">Rasa Mesin Baru?</h1>
                <p class="text-lg md:text-xl text-red-100 max-w-xl leading-relaxed fade-up fade-up-delay">
                    Servis sepeda motormu di Bengkelin. Pengalaman rasa mesin baru jadi nyata dengan layanan servis yang rapi, cepat, dan terpercaya.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white text-zinc-900">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="w-full lg:flex-1">
                    <div class="relative max-w-xl">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Cari servis motor buat motormu disini" class="w-full pl-11 pr-4 py-3 rounded-full border border-zinc-200 text-sm focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none">
                    </div>
                </div>
                <div class="text-sm text-zinc-500">Menampilkan 0 dari 0 Data</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-zinc-500">Urutkan</span>
                    <div class="relative">
                        <button type="button" id="sort-toggle" aria-expanded="false" aria-haspopup="true" class="min-w-[200px] inline-flex items-center justify-between gap-3 px-4 py-3 rounded-full border border-zinc-200 text-sm">
                            <span id="sort-label" class="text-zinc-500">Pilih</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500">
                                <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div id="sort-menu" class="absolute right-0 mt-2 w-56 bg-white border border-zinc-200 rounded-2xl shadow-lg py-2 hidden">
                            <button type="button" data-sort="Harga Tertinggi" class="w-full text-left px-4 py-2 text-sm hover:bg-zinc-100">Harga Tertinggi</button>
                            <button type="button" data-sort="Harga Paling Murah" class="w-full text-left px-4 py-2 text-sm hover:bg-zinc-100">Harga Paling Murah</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-12 gap-10">
                <aside class="lg:col-span-3">
                    <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold mb-6">Filter</h3>
                        <div class="space-y-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="font-semibold">Harga</span>
                                    <span class="text-zinc-500">Rp <span id="harga-min-label">0</span> - Rp <span id="harga-max-label">100.000</span></span>
                                </div>
                                <div class="relative h-2">
                                    <div class="absolute inset-0 bg-zinc-200 rounded-full"></div>
                                    <div id="harga-track" class="absolute h-2 bg-red-600 rounded-full"></div>
                                    <input id="harga-min" type="range" min="0" max="100000" step="1000" value="0" class="range-input absolute inset-0 w-full h-2 bg-transparent appearance-none z-20">
                                    <input id="harga-max" type="range" min="0" max="100000" step="1000" value="100000" class="range-input absolute inset-0 w-full h-2 bg-transparent appearance-none z-30">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <input id="harga-min-input" type="text" value="Rp 0" readonly class="w-full border border-zinc-200 rounded-xl px-3 py-2 text-sm text-zinc-600 bg-zinc-50">
                                    <input id="harga-max-input" type="text" value="Rp 100.000" readonly class="w-full border border-zinc-200 rounded-xl px-3 py-2 text-sm text-zinc-600 bg-zinc-50">
                                </div>
                            </div>
                            <button type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-full">Tampilkan</button>
                        </div>
                    </div>
                </aside>
                <div class="lg:col-span-9">
                    <div class="min-h-[360px] rounded-2xl border border-dashed border-zinc-200 bg-white"></div>
                </div>
            </div>
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
                    closeSortMenu();
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
        const maxValue = 100000;
        const gap = 1000;

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
