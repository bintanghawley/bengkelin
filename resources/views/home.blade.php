@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white transition-colors duration-300">
    <style>
        .sidebar-scrollbar-hide {
            scrollbar-width: none;
        }
        .sidebar-scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        /* Filter Google Maps Dinamis */
        .map-iframe {
            filter: grayscale(10%) contrast(100%);
            transition: all 0.7s ease;
        }
        .dark .map-iframe {
            filter: grayscale(20%) invert(90%) contrast(110%);
        }
    </style>
    <nav class="relative z-30 flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
       <div class="flex items-center gap-2">
            <div>
                <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-20 h-20 object-contain">
            </div>
            <span class="text-2xl font-bengkel tracking-wider text-zinc-900 dark:text-white">Bengkel<span class="text-red-600">in</span></span>
        </div>
        <div class="hidden md:flex gap-8 text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
            <a href="#" class="hover:text-zinc-900 dark:hover:text-white transition">Services</a>
            <a href="{{ route('register') }}" class="hover:text-zinc-900 dark:hover:text-white transition">Spareparts</a>
            <a href="#about" class="hover:text-zinc-900 dark:hover:text-white transition">About</a>
            <a href="#location" class="hover:text-zinc-900 dark:hover:text-white transition">Location</a> 
        </div>
        <div class="flex items-center gap-3">
            <button type="button" class="inline-flex items-center justify-center h-11 w-11 rounded-full border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300 transition" aria-label="Cari">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                    <path d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            @guest
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center h-11 w-11 rounded-full border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300 transition" aria-label="Keranjang">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                        <path d="M6 6h15l-1.5 9h-12z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6 6l-2-3H2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="18" cy="20" r="1" />
                    </svg>
                </a>
            @endguest
            @auth
                <div class="relative group">
                    <a href="{{ route('toko.index') }}" class="inline-flex items-center justify-center h-11 w-11 rounded-full border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300 transition" aria-label="Keranjang">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                            <path d="M6 6h15l-1.5 9h-12z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 6l-2-3H2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                    </a>
                    <div class="absolute right-0 mt-3 w-80 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white border border-zinc-200 dark:border-zinc-850 rounded-2xl shadow-2xl z-50 opacity-0 translate-y-2 pointer-events-none transition group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto">
                        <div class="p-5">
                            <p class="text-lg font-semibold">Keranjang</p>
                            <div class="mt-5 flex flex-col items-center text-center">
                                <div class="relative h-24 w-24 rounded-full bg-red-50 dark:bg-red-950/20 flex items-center justify-center">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-10 h-10 text-red-400">
                                        <path d="M6 6h15l-1.5 9h-12z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 6l-2-3H2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="9" cy="20" r="1" />
                                        <circle cx="18" cy="20" r="1" />
                                    </svg>
                                    <span class="absolute top-1 right-1 h-6 min-w-6 px-2 rounded-full bg-red-600 text-white text-xs font-semibold flex items-center justify-center">0</span>
                                </div>
                                <p class="mt-4 font-semibold">Belum Ada Barang di Keranjangmu</p>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Yuk isi dulu dengan barang otomotif impianmu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
            <button type="button" id="sidebar-open" class="inline-flex items-center justify-center h-11 w-11 rounded-full border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300 transition" aria-label="Menu" aria-controls="sidebar" aria-expanded="false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                    <path d="M4 6h16M4 12h16M4 18h10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </nav>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>
    <aside id="sidebar" class="fixed top-0 right-0 h-screen w-[85vw] max-w-sm bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white translate-x-full transition-transform duration-300 z-50 shadow-2xl border-l border-zinc-200 dark:border-zinc-850">
        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between p-5 border-b border-zinc-200 dark:border-zinc-800">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-12 h-12 object-contain">
                    <span class="text-xl font-bengkel tracking-wider text-zinc-900 dark:text-white">Bengkel<span class="text-red-600">in</span></span>
                </a>
                <button type="button" id="sidebar-close" class="inline-flex items-center justify-center h-9 w-9 rounded-full border border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-850 transition text-zinc-700 dark:text-zinc-350" aria-label="Tutup menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                        <path d="M6 6l12 12M18 6l-12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto px-5 py-6 space-y-6 sidebar-scrollbar-hide">
                @guest
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" class="text-center font-semibold bg-red-600 text-white px-4 py-3 rounded-full hover:bg-red-700 transition">Login</a>
                        <a href="{{ route('register') }}" class="text-center font-semibold border border-red-600 text-red-600 px-4 py-3 rounded-full hover:bg-red-50 dark:hover:bg-red-950/20 transition">Daftar Akun</a>
                    </div>
                @endguest

                @auth
                    <div class="border border-zinc-200 dark:border-zinc-800 rounded-2xl p-4 space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 transition">
                                        {{ Auth::user()->name }}
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                            <path d="M9 6l6 6-6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                @elseif (Auth::user()->role === 'mekanik')
                                    <a href="{{ route('mekanik.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 transition">
                                        {{ Auth::user()->name }}
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                            <path d="M9 6l6 6-6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('pengguna.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 transition">
                                        {{ Auth::user()->name }}
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                            <path d="M9 6l6 6-6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                @endif
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">{{ Auth::user()->nomor_telepon ? implode('-', str_split(Auth::user()->nomor_telepon, 4)) : '-' }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 text-sm font-semibold text-red-600 hover:text-red-700 transition">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4">
                                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 17l5-5-5-5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15 12H3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                        <div class="flex items-center justify-between text-sm text-zinc-750 dark:text-zinc-300">
                            <div class="inline-flex items-center gap-2">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-500 dark:text-zinc-400">
                                    <path d="M7 7h10M7 12h10M7 17h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Daftar Pesanan</span>
                            </div>
                            <span class="inline-flex items-center justify-center h-6 min-w-6 px-2 rounded-full bg-red-600 text-white text-xs font-semibold">0</span>
                        </div>
                    </div>
                @endauth

                <div class="space-y-3">
                    <a href="{{ route('servis') }}" class="block w-full text-left py-2 font-semibold text-zinc-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 transition">Servis</a>
                    <details class="group">
                        <summary class="flex items-center justify-between py-2 cursor-pointer font-semibold text-zinc-900 dark:text-white">
                            <span class="group-open:text-red-600">Ban Motor</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-650 dark:text-zinc-400 transition-transform group-open:rotate-180 group-open:text-red-600">
                                <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </summary>
                        <div class="pl-4 pb-2 space-y-2 text-sm">
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Ban Motor Matic</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Ban Motor Bebek</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Ban Motor Sport</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Ban Motor Big Matic</a>
                        </div>
                    </details>
                    <details class="group">
                        <summary class="flex items-center justify-between py-2 cursor-pointer font-semibold text-zinc-900 dark:text-white">
                            <span class="group-open:text-red-600">Oli Motor</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-650 dark:text-zinc-400 transition-transform group-open:rotate-180 group-open:text-red-600">
                                <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </summary>
                        <div class="pl-4 pb-2 space-y-2 text-sm">
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Oli Motor Matic</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Oli Motor Bebek</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Oli Motor Sport</a>
                        </div>
                    </details>
                    <details class="group">
                        <summary class="flex items-center justify-between py-2 cursor-pointer font-semibold text-zinc-900 dark:text-white">
                            <span class="group-open:text-red-600">Sparepart</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-4 h-4 text-zinc-650 dark:text-zinc-400 transition-transform group-open:rotate-180 group-open:text-red-600">
                                <path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </summary>
                        <div class="pl-4 pb-2 space-y-2 text-sm">
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Aki Motor</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Filter Udara Motor</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Kampas Rem</a>
                            <a href="#" class="block text-zinc-700 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-500">Cairan Anti Bocor</a>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </aside>

    <main>
        <section id="home" class="max-w-7xl mx-auto px-8 py-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1 text-center lg:text-left">
                <div class="inline-block px-4 py-1 rounded-full bg-red-600/10 border border-red-600/20 text-red-500 text-xs font-bold tracking-[0.2em] mb-6">
                    PREMIUM GARAGE SERVICE
                </div>
                <h1 class="text-7xl md:text-8xl font-bengkel leading-none tracking-tight mb-6 text-zinc-900 dark:text-white">
                    KEEP YOUR ENGINE <br> <span class="text-red-600">PERFORMANCE</span>
                </h1>
                <p class="text-zinc-650 dark:text-zinc-400 text-lg max-w-lg mx-auto lg:mx-0 mb-10 leading-relaxed">
                    Solusi servis kendaraan sat-set tanpa antre. Mekanik pro, sparepart ori, harga gak bikin dompet mati.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold px-10 py-4 rounded-xl shadow-lg shadow-red-900/20 transition active:scale-95 text-center">
                        BOOKING SEKARANG
                    </a>
                    <a href="#" class="w-full sm:w-auto bg-zinc-200 dark:bg-zinc-800 hover:bg-zinc-300 dark:hover:bg-zinc-700 text-zinc-900 dark:text-white font-bold px-10 py-4 rounded-xl transition text-center border border-zinc-300 dark:border-zinc-700">
                        LIHAT LAYANAN
                    </a>
                </div>

                <div class="mt-16 grid grid-cols-3 gap-8 border-t border-zinc-200 dark:border-zinc-850 pt-8">
                    <div>
                        <p class="text-3xl font-bengkel text-zinc-900 dark:text-white">500+</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-450 uppercase tracking-widest mt-1">Customers</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bengkel text-zinc-900 dark:text-white">10+</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-450 uppercase tracking-widest mt-1">Expert Mechanics</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bengkel text-zinc-900 dark:text-white">24/7</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-450 uppercase tracking-widest mt-1">Support</p>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2 relative">
                <div class="absolute -inset-1 bg-red-600 rounded-3xl blur opacity-10"></div>
                <div class="relative bg-zinc-100 dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 overflow-hidden aspect-video lg:aspect-square flex items-center justify-center group transition-colors duration-300">
                    <img src="{{ asset ('img/Gemini_Generated_Image_rlwfwprlwfwprlwf.png') }}" alt="Gambar" class="w-full h-full object-cover">
                    <div class="absolute bottom-8 right-8 text-right">
                        <p class="text-zinc-400 dark:text-zinc-600 text-6xl font-bengkel opacity-100 uppercase leading-none">Bengkelin<br>Sidoarjo</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="max-w-7xl mx-auto px-8 py-24 border-t border-zinc-200 dark:border-zinc-850">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6">
                    <h2 class="text-5xl font-bengkel text-zinc-900 dark:text-white leading-tight uppercase">
                        Bukan Sekedar <br> <span class="text-red-600">Bengkel Biasa</span>
                    </h2>
                    <p class="text-zinc-650 dark:text-zinc-400 leading-relaxed">
                        Berawal dari keresahan antrean panjang di bengkel konvensional, <span class="text-zinc-900 dark:text-white font-bold">Bengkelin</span> hadir sebagai solusi digital untuk para pengendara yang menghargai waktu. Kami menggabungkan presisi mekanik profesional dengan kemudahan teknologi.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                        <div class="p-6 bg-zinc-100/50 dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-2xl transition-colors duration-300">
                            <p class="text-red-600 font-bold text-xs uppercase tracking-widest mb-2">Visi Kami</p>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed">Menjadi ekosistem perawatan kendaraan nomor satu di Sidoarjo yang transparan dan terpercaya.</p>
                        </div>
                        <div class="p-6 bg-zinc-100/50 dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-2xl transition-colors duration-300">
                            <p class="text-red-600 font-bold text-xs uppercase tracking-widest mb-2">Misi Kami</p>
                            <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed">Memberikan pelayanan berkualitas tinggi dengan standarisasi alat modern dan sparepart original.</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-zinc-300 dark:to-zinc-800 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                    <div class="relative bg-zinc-100 dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 p-2 overflow-hidden transition-colors duration-300">
                        <img src="{{ asset("img/Gemini_Generated_Image_m0vuzjm0vuzjm0vu.png") }}" alt="Workshop" class="rounded-2xl grayscale hover:grayscale-0 transition duration-700 w-full object-cover aspect-video lg:aspect-auto">
                    </div>
                </div>
            </div>
        </section>

        <section id="location" class="max-w-7xl mx-auto px-8 py-24 border-t border-zinc-200 dark:border-zinc-850">
            <div class="text-center mb-16">
                <p class="text-red-600 font-bold text-xs tracking-[0.3em] mb-4 uppercase">Kunjungi Workshop Kami</p>
                <h2 class="text-4xl font-bengkel text-zinc-900 dark:text-white uppercase">Bengkelin Sidoarjo</h2>
            </div>

            <div class="bg-zinc-100 dark:bg-zinc-900 rounded-[2.5rem] border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-2xl transition-colors duration-300">
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <div class="p-12 lg:border-r border-zinc-200 dark:border-zinc-800 flex flex-col justify-center">
                        <div class="space-y-8">
                            <div>
                                <h4 class="text-zinc-500 dark:text-zinc-400 text-[10px] uppercase tracking-widest font-bold mb-3">Alamat Utama</h4>
                                <p class="text-zinc-800 dark:text-white text-lg font-medium leading-relaxed italic">
                                    Nggrekmas, Pagerwojo, Kec. Buduran, Kabupaten Sidoarjo, Jawa Timur 61252
                                </p>
                            </div>
                            <div>
                                <h4 class="text-zinc-500 dark:text-zinc-400 text-[10px] uppercase tracking-widest font-bold mb-3">Jam Operasional</h4>
                                <p class="text-zinc-700 dark:text-zinc-300 text-sm">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                                <p class="text-red-500 text-sm mt-1">Minggu: Tutup (Booking Only)</p>
                            </div>
                            <div class="pt-4">
                                <a href="https://maps.app.goo.gl/YourActualGoogleMapsLink" target="_blank" class="inline-flex items-center gap-3 text-red-600 hover:text-red-500 font-bold text-xs uppercase tracking-widest transition">
                                    Buka di Google Maps
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 h-[450px] opacity-80 hover:opacity-100 transition-all duration-700">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            class="map-iframe w-full h-full"
                            src="https://maps.google.com/maps?q=Nggrekmas%20Pagerwojo%20Buduran%20Sidoarjo&t=&z=15&ie=UTF8&iwloc=&output=embed">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- FOOTER SECTION -->
    <footer class="bg-zinc-50 dark:bg-zinc-950 pt-20 pb-10 px-6 transition-colors duration-300">
        <div class="max-w-7xl mx-auto">
            <!-- Main Footer Card -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl transition-colors duration-300">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                    
                    <!-- Brand & Description -->
                    <div class="md:col-span-4 space-y-6">
                        <div class="flex items-center gap-3">
                            <div>
                                <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-20 h-20 object-contain">
                            </div>
                            <span class="text-2xl font-bengkel tracking-wider text-zinc-900 dark:text-white">BENGKEL<span class="text-red-600">IN</span></span>
                        </div>
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm leading-relaxed max-w-xs">
                            Solusi perawatan motor modern berbasis digital. Booking mekanik ahli dan beli sparepart original dalam satu platform.
                        </p>
                        <!-- Social Icons -->
                        <div class="flex gap-3">
                            @foreach(['instagram', 'twitter', 'github', 'youtube'] as $social)
                            <a href="#" class="h-10 w-10 bg-zinc-100 dark:bg-zinc-800 hover:bg-red-600 rounded-xl flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-white dark:hover:text-white transition-all duration-300">
                                <i class="fab fa-{{ $social }}"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="md:col-span-8 grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div>
                            <h4 class="text-zinc-900 dark:text-white font-bold text-sm mb-6 uppercase tracking-widest">Layanan</h4>
                            <ul class="space-y-4 text-zinc-500 dark:text-zinc-400 text-sm">
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Service Ringan</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Tune Up</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Ganti Oli</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Overhaul</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-zinc-900 dark:text-white font-bold text-sm mb-6 uppercase tracking-widest">Perusahaan</h4>
                            <ul class="space-y-4 text-zinc-500 dark:text-zinc-400 text-sm">
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Tentang Kami</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Mekanik Kami</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Karir</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Kontak</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-zinc-900 dark:text-white font-bold text-sm mb-6 uppercase tracking-widest">Bantuan</h4>
                            <ul class="space-y-4 text-zinc-500 dark:text-zinc-400 text-sm">
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">FAQ</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Pusat Bantuan</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Panduan</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Komunitas</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-zinc-900 dark:text-white font-bold text-sm mb-6 uppercase tracking-widest">Legal</h4>
                            <ul class="space-y-4 text-zinc-500 dark:text-zinc-400 text-sm">
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Privasi</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Ketentuan</a></li>
                                <li><a href="#" class="hover:text-red-500 dark:hover:text-red-400 transition">Keamanan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row: Badges -->
                <div class="mt-16 pt-8 border-t border-zinc-200 dark:border-zinc-800/50 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center gap-2 px-4 py-2 bg-zinc-50 dark:bg-zinc-950 rounded-lg border border-zinc-200 dark:border-zinc-800 text-[10px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest transition-colors duration-300">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            Service Certified
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-zinc-50 dark:bg-zinc-950 rounded-lg border border-zinc-200 dark:border-zinc-800 text-[10px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest transition-colors duration-300">
                            <span class="text-yellow-500">★★★★★</span>
                            4.9/5 Rating
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright & Status -->
            <div class="mt-10 flex flex-col md:flex-row justify-between items-center text-[10px] text-zinc-500 dark:text-zinc-600 uppercase tracking-[0.2em] font-medium px-4">
                <p>© 2026 Bengkelin. </p>
                <div class="flex gap-8 mt-4 md:mt-0">
                    <a href="#" class="hover:text-zinc-900 dark:hover:text-white transition">Status</a>
                    <a href="#" class="hover:text-zinc-900 dark:hover:text-white transition">Sitemap</a>
                    <a href="#" class="hover:text-zinc-900 dark:hover:text-white transition">Aksesibilitas</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        const sidebarOpen = document.getElementById('sidebar-open');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        const lockBody = (locked) => {
            if (locked) {
                const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
                document.body.classList.add('overflow-hidden');
                document.body.style.paddingRight = scrollbarWidth > 0 ? `${scrollbarWidth}px` : '';
                return;
            }
            document.body.classList.remove('overflow-hidden');
            document.body.style.paddingRight = '';
        };

        const openSidebar = () => {
            sidebar.classList.remove('translate-x-full');
            sidebarOverlay.classList.remove('opacity-0', 'pointer-events-none');
            sidebarOverlay.classList.add('opacity-100');
            lockBody(true);
            sidebarOpen.setAttribute('aria-expanded', 'true');
        };

        const closeSidebar = () => {
            sidebar.classList.add('translate-x-full');
            sidebarOverlay.classList.add('opacity-0', 'pointer-events-none');
            sidebarOverlay.classList.remove('opacity-100');
            lockBody(false);
            sidebarOpen.setAttribute('aria-expanded', 'false');
        };

        if (sidebarOpen) {
            sidebarOpen.addEventListener('click', openSidebar);
        }
        if (sidebarClose) {
            sidebarClose.addEventListener('click', closeSidebar);
        }
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    </script>
</div>
@endsection