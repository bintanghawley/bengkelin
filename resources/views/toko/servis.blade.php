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
                    @include('partials.cart-widget')

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

    <section class="bg-zinc-50 text-zinc-900 py-20 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bengkel uppercase tracking-wide mb-4">Layanan Servis Kami</h2>
                <p class="text-zinc-500">Pilih layanan servis yang sesuai dengan kebutuhan motor Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="bg-white border border-zinc-200 rounded-[2rem] overflow-hidden shadow-xl shadow-zinc-200/40 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col group">
                    <div class="relative aspect-video overflow-hidden">
                        <img src="{{ $service->gambar_url }}" alt="{{ $service->nama }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                            <span class="inline-block bg-red-600 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-2 w-max">{{ $service->estimasi_waktu }}</span>
                            <h3 class="text-2xl font-bengkel text-white uppercase tracking-wide">{{ $service->nama }}</h3>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <p class="text-zinc-600 text-sm line-clamp-2 mb-6 flex-1">{{ $service->deskripsi }}</p>
                        
                        <div class="flex items-center justify-between mb-6 pb-6 border-b border-zinc-100">
                            <div>
                                <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest mb-1">Mulai Dari</p>
                                <p class="text-lg font-bold text-red-600">{{ $service->harga_mulai_formatted }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-zinc-400 uppercase font-bold tracking-widest mb-1">Pekerjaan</p>
                                <p class="text-sm font-semibold text-zinc-700">{{ $service->items_count }} Item</p>
                            </div>
                        </div>
                        
                        <a href="{{ route('servis.detail', $service->slug) }}" class="block w-full text-center border-2 border-zinc-200 hover:border-red-600 hover:bg-red-600 hover:text-white text-zinc-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-xs uppercase tracking-widest">
                            Detail Servis
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if($services->isEmpty())
            <div class="text-center py-20 bg-white rounded-3xl border border-zinc-200">
                <svg class="w-16 h-16 text-zinc-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="text-xl font-bold text-zinc-700 mb-2">Belum Ada Layanan Servis</h3>
                <p class="text-zinc-500">Silakan kembali lagi nanti untuk melihat daftar layanan kami.</p>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
