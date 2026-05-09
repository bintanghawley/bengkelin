@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-zinc-950">
    <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <div >
                <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt="" class="w-20 h-20 object-contain ">
            </div>
            <span class="text-2xl font-bengkel tracking-wider">Bengkel<span class="text-red-600">in</span></span>
        </div>
        <div class="hidden md:flex gap-8 text-xs font-semibold uppercase tracking-widest text-zinc-400">
            <a href="#" class="hover:text-white transition">Services</a>
            <a href="#" class="hover:text-white transition">Spareparts</a>
            <a href="#" class="hover:text-white transition">About</a>
        </div>
        <div class="flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}" class="text-sm font-bold border border-zinc-700 px-6 py-2 rounded-full hover:bg-zinc-800 transition">Login</a>
                <a href="{{ route('register') }}" class="text-sm font-bold bg-red-600 px-6 py-2 rounded-full hover:bg-red-700 transition">Register</a>
            @endguest

            @auth
                <details class="relative">
                    <summary class="list-none cursor-pointer text-sm font-bold border border-zinc-700 px-6 py-2 rounded-full hover:bg-zinc-800 transition">
                        {{ Auth::user()->name }}
                    </summary>
                    <div class="absolute right-0 mt-2 w-48 bg-zinc-900 border border-zinc-800 rounded-lg shadow-lg p-2">
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-sm hover:bg-zinc-800 rounded">Dashboard</a>
                        @elseif (Auth::user()->role === 'mekanik')
                            <a href="{{ route('mekanik.dashboard') }}" class="block px-3 py-2 text-sm hover:bg-zinc-800 rounded">Dashboard</a>
                        @else
                            <a href="{{ route('pengguna.dashboard') }}" class="block px-3 py-2 text-sm hover:bg-zinc-800 rounded">Dashboard</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="mt-1">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm hover:bg-zinc-800 rounded">Logout</button>
                        </form>
                    </div>
                </details>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-8 py-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 text-center lg:text-left">
            <div class="inline-block px-4 py-1 rounded-full bg-red-600/10 border border-red-600/20 text-red-500 text-xs font-bold tracking-[0.2em] mb-6">
                PREMIUM GARAGE SERVICE
            </div>
            <h1 class="text-7xl md:text-8xl font-bengkel leading-none tracking-tight mb-6">
                KEEP YOUR ENGINE <br> <span class="text-red-600">PERFORMANCE</span>
            </h1>
            <p class="text-zinc-400 text-lg max-w-lg mx-auto lg:mx-0 mb-10 leading-relaxed">
                Solusi servis kendaraan sat-set tanpa antre. Mekanik pro, sparepart ori, harga gak bikin dompet mati.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold px-10 py-4 rounded-xl shadow-lg shadow-red-900/20 transition active:scale-95 text-center">
                    BOOKING SEKARANG
                </a>
                <a href="#" class="w-full sm:w-auto bg-zinc-800 hover:bg-zinc-700 text-white font-bold px-10 py-4 rounded-xl transition text-center border border-zinc-700">
                    LIHAT LAYANAN
                </a>
            </div>

            <div class="mt-16 grid grid-cols-3 gap-8 border-t border-zinc-900 pt-8">
                <div>
                    <p class="text-3xl font-bengkel text-white">500+</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-widest mt-1">Customers</p>
                </div>
                <div>
                    <p class="text-3xl font-bengkel text-white">10+</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-widest mt-1">Expert Mechanics</p>
                </div>
                <div>
                    <p class="text-3xl font-bengkel text-white">24/7</p>
                    <p class="text-xs text-zinc-500 uppercase tracking-widest mt-1">Support</p>
                </div>
            </div>
        </div>

        <div class="order-1 lg:order-2 relative">
            <div class="absolute -inset-1 bg-red-600 rounded-3xl blur opacity-10"></div>
            <div class="relative bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden aspect-video lg:aspect-square flex items-center justify-center group">
                <svg viewBox="0 0 24 24 " fill="none" stroke="currentColor" class="w-64 h-64 text-zinc-800 group-hover:text-red-600/20 transition duration-700">
                   <img src="{{ asset ('img/Gemini_Generated_Image_rlwfwprlwfwprlwf.png') }}" alt="Gambar">
            </svg>
                <div class="absolute bottom-8 right-8 text-right">
                    <p class="text-zinc-600 text-6xl font-bengkel opacity-100 uppercase leading-none">Bengkelin<br>Sidoarjo</p>
                </div>
            </div>
        </div>
    </main>
    <!-- FOOTER SECTION -->
<footer class="bg-zinc-950 pt-20 pb-10 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Main Footer Card -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                
                <!-- Brand & Description -->
                <div class="md:col-span-4 space-y-6">
                    <div class="flex items-center gap-3">
                        <div >
                            <img src="{{ asset('img/image-removebg-preview (3).png') }}" alt=""class="w-20 h-20 object-contain">
                        </div>
                        <span class="text-2xl font-bengkel tracking-wider text-white">BENGKEL<span class="text-red-600">IN</span></span>
                    </div>
                    <p class="text-zinc-400 text-sm leading-relaxed max-w-xs">
                        Solusi perawatan motor modern berbasis digital. Booking mekanik ahli dan beli sparepart original dalam satu platform.
                    </p>
                    <!-- Social Icons -->
                    <div class="flex gap-3">
                        @foreach(['instagram', 'twitter', 'github', 'youtube'] as $social)
                        <a href="#" class="h-10 w-10 bg-zinc-800 hover:bg-red-600 rounded-xl flex items-center justify-center text-zinc-400 hover:text-white transition-all duration-300">
                            <i class="fab fa-{{ $social }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="md:col-span-8 grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h4 class="text-white font-bold text-sm mb-6 uppercase tracking-widest">Layanan</h4>
                        <ul class="space-y-4 text-zinc-500 text-sm">
                            <li><a href="#" class="hover:text-red-500 transition">Service Ringan</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Tune Up</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Ganti Oli</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Overhaul</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm mb-6 uppercase tracking-widest">Perusahaan</h4>
                        <ul class="space-y-4 text-zinc-500 text-sm">
                            <li><a href="#" class="hover:text-red-500 transition">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Mekanik Kami</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Karir</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm mb-6 uppercase tracking-widest">Bantuan</h4>
                        <ul class="space-y-4 text-zinc-500 text-sm">
                            <li><a href="#" class="hover:text-red-500 transition">FAQ</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Pusat Bantuan</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Panduan</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Komunitas</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm mb-6 uppercase tracking-widest">Legal</h4>
                        <ul class="space-y-4 text-zinc-500 text-sm">
                            <li><a href="#" class="hover:text-red-500 transition">Privasi</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Ketentuan</a></li>
                            <li><a href="#" class="hover:text-red-500 transition">Keamanan</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: Badges & Newsletter -->
            <div class="mt-16 pt-8 border-t border-zinc-800/50 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 px-4 py-2 bg-zinc-950 rounded-lg border border-zinc-800 text-[10px] font-bold text-zinc-400 uppercase tracking-widest">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        Service Certified
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-zinc-950 rounded-lg border border-zinc-800 text-[10px] font-bold text-zinc-400 uppercase tracking-widest">
                        <span class="text-yellow-500">★★★★★</span>
                        4.9/5 Rating
                    </div>
                </div>

               
            </div>
        </div>

        <!-- Copyright & Status -->
        <div class="mt-10 flex flex-col md:flex-row justify-between items-center text-[10px] text-zinc-600 uppercase tracking-[0.2em] font-medium px-4">
            <p>© 2026 Bengkelin. </p>
            <div class="flex gap-8 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Status</a>
                <a href="#" class="hover:text-white transition">Sitemap</a>
                <a href="#" class="hover:text-white transition">Aksesibilitas</a>
            </div>
        </div>
    </div>
</footer>
</div>
@endsection