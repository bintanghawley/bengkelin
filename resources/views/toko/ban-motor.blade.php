@extends('layouts.guest')

@section('content')
<div class="bg-zinc-950 text-white">
    <section class="relative overflow-hidden bg-gradient-to-br from-[#0b3aa6] via-[#0f4fd9] to-[#0c3fbc]">
        <style>
            @keyframes fade-up {
                0% { opacity: 0; transform: translateY(12px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .fade-up { animation: fade-up 0.8s ease-out both; }
            .fade-up-delay { animation-delay: 0.15s; }
        </style>

        <nav class="w-full border-b border-zinc-900/60 bg-zinc-950/90 backdrop-blur relative z-30">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-10 h-10 object-contain">
                    <span class="text-xl font-bengkel tracking-wider">Bengkel<span class="text-red-600">in</span></span>
                </a>
                <div class="hidden lg:flex items-center gap-10 text-xs font-semibold uppercase tracking-widest text-zinc-400">
                    <a href="{{ route('servis') }}" class="hover:text-white transition">Servis</a>
                    <a href="{{ route('toko.banmotor') }}" class="text-white transition">Ban Motor</a>
                    <a href="#" class="hover:text-white transition">Oli Motor</a>
                    <a href="#" class="hover:text-white transition">Sparepart</a>
                    <a href="{{ route('home') }}#location" class="hover:text-white transition">Lokasi Toko</a>
                    <a href="#" class="hover:text-white transition">Promo</a>
                    <a href="#" class="hover:text-white transition">Buku Servis</a>
                    <a href="#" class="hover:text-white transition">Blog</a>
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
            <div class="absolute right-[-10%] top-[-10%] h-[140%] w-[60%] opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(135deg, rgba(255,255,255,0.18) 0, rgba(255,255,255,0.18) 6px, transparent 6px, transparent 26px);"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-10 lg:py-14 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="relative">
                <div class="relative w-full max-w-lg mx-auto lg:mx-0">
                    <div class="absolute -top-6 -left-6 h-24 w-24 bg-white/15 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -right-12 h-32 w-32 bg-black/25 rounded-full blur-2xl"></div>
                    <div class="relative rounded-[2rem] bg-[#0a2f86] p-4 shadow-[0_30px_80px_rgba(0,0,0,0.35)]">
                        <img src="{{ asset('img/image.png') }}" alt="Ban Motor" class="w-full h-full object-cover rounded-[1.5rem] aspect-[4/3]">
                    </div>
                </div>
            </div>

            <div class="relative z-10 text-center lg:text-left space-y-6">
                <p class="text-2xl md:text-3xl font-light tracking-wide fade-up">Perusahaan Ritel Ban Motor</p>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bengkel uppercase tracking-wide fade-up fade-up-delay">Berkualitas dan Tahan Lama</h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-xl leading-relaxed fade-up fade-up-delay">
                    Ratusan ban motor tersedia di Bengkelin. Temukan pilihan terbaik untuk perjalanan harian dan touring.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white text-zinc-900">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <h2 class="text-2xl font-semibold mb-6">Harga Ban Motor</h2>
            <div class="min-h-[320px] rounded-2xl border border-dashed border-zinc-200 bg-white"></div>
        </div>
    </section>
</div>
@endsection
