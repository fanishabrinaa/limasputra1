<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ \App\Models\Setting::get('nama_perusahaan', config('app.name')) }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="lp-site bg-slate-50 text-slate-800 font-sans antialiased selection:bg-rose-500 selection:text-white flex flex-col min-h-screen">

    <nav x-data="{ mobileOpen: false }" class="bg-gradient-to-b from-white to-slate-100 border-b border-slate-200 px-6 md:px-12 py-4 sticky top-0 z-50">
    <div class="flex justify-between items-center">
        <a href="{{ route('beranda') }}" class="flex items-center gap-2">
            @if (\App\Models\Setting::get('logo'))
                <img src="{{ Storage::url(\App\Models\Setting::get('logo')) }}" class="h-9 object-contain">
            @endif
            <span class="font-bold text-xl text-rose-700">
                {{ \App\Models\Setting::get('nama_perusahaan', 'Perusahaan') }}
            </span>
        </a>

        <div class="hidden md:flex gap-8 items-center text-sm font-medium text-slate-600">
            <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'text-rose-700 border-b-2 border-rose-700 pb-1' : 'hover:text-rose-700' }}">Beranda</a>
            <a href="{{ route('unit-usaha') }}" class="{{ request()->routeIs('unit-usaha', 'armada.katalog', 'armada.detail', 'produk.publik', 'produk.detail', 'konstruksi') ? 'text-rose-700 border-b-2 border-rose-700 pb-1' : 'hover:text-rose-700' }}">Unit Usaha</a>
            <a href="{{ route('galeri.publik') }}" class="{{ request()->routeIs('galeri.publik') ? 'text-rose-700 border-b-2 border-rose-700 pb-1' : 'hover:text-rose-700' }}">Galeri</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-rose-700 border-b-2 border-rose-700 pb-1' : 'hover:text-rose-700' }}">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-rose-700 border-b-2 border-rose-700 pb-1' : 'hover:text-rose-700' }}">Kontak</a>
        </div>

        <div class="hidden md:flex items-center gap-4">
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-rose-700 hover:underline">Dashboard Admin</a>
                @else
                    <a href="{{ route('pemesanan.riwayat') }}" class="text-sm font-medium text-slate-600 hover:text-rose-700">Pesanan Saya</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-slate-500 hover:text-rose-700">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-rose-700 hover:bg-rose-800 text-white text-sm font-semibold px-5 py-2 rounded-lg">Login</a>
            @endauth
        </div>

        <!-- TOMBOL HAMBURGER - cuma muncul di mobile -->
        <button @click="mobileOpen = !mobileOpen" class="md:hidden text-slate-700">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
        <!-- PANEL MENU MOBILE -->
        <div x-show="mobileOpen" x-cloak
            class="md:hidden fixed top-0 right-0 h-screen w-72 max-w-[85vw] bg-white shadow-2xl p-6 z-50 overflow-y-auto"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            style="display: none;">

            <div class="flex justify-between items-center mb-6">
                <span class="font-bold text-rose-700">{{ \App\Models\Setting::get('nama_perusahaan', 'Perusahaan') }}</span>
                <button @click="mobileOpen = false" class="text-slate-400 hover:text-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

               <div class="flex flex-col justify-between h-[calc(100%-5rem)]">
        <div class="space-y-4 text-sm font-medium">
            <a href="{{ route('beranda') }}" class="block {{ request()->routeIs('beranda') ? 'text-rose-700 font-bold' : 'text-slate-600' }}">Beranda</a>
            <a href="{{ route('unit-usaha') }}" class="block {{ request()->routeIs('unit-usaha', 'armada.katalog', 'armada.detail', 'produk.publik', 'produk.detail', 'konstruksi') ? 'text-rose-700 font-bold' : 'text-slate-600' }}">Unit Usaha</a>
            <a href="{{ route('galeri.publik') }}" class="block {{ request()->routeIs('galeri.publik') ? 'text-rose-700 font-bold' : 'text-slate-600' }}">Galeri</a>
            <a href="{{ route('about') }}" class="block {{ request()->routeIs('about') ? 'text-rose-700 font-bold' : 'text-slate-600' }}">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="block {{ request()->routeIs('kontak') ? 'text-rose-700 font-bold' : 'text-slate-600' }}">Kontak</a>
        </div>

        <div class="space-y-4">
            @if (\App\Models\Setting::get('telepon'))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::get('telepon')) }}"
                   target="_blank"
                   class="flex items-center justify-center gap-2 bg-green-50 border border-green-200 text-green-700 font-semibold text-sm px-4 py-3 rounded-xl hover:bg-green-100 transition-colors">
                    Hubungi via WhatsApp
                </a>
            @endif

            <hr class="border-slate-200">

            <div class="space-y-3 text-sm font-medium">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="block text-rose-700 font-bold">Dashboard Admin</a>
                    @else
                        <a href="{{ route('pemesanan.riwayat') }}" class="block text-slate-600">Pesanan Saya</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-left text-slate-500">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-rose-700 text-white font-semibold px-5 py-2 rounded-lg">Login</a>
                @endauth
            </div>
        </div>
    </div>
            
        </div>
    </nav>

    <!-- KONTEN UTAMA HALAMAN -->
    <main class="lp-page-content flex-1">
        {{ $slot }}
    </main>

   <!-- FOOTER -->
<footer class="lp-site-footer">
    <!-- BARIS ATAS: PUTIH, CUMA JUDUL (disembunyikan di mobile) -->
    <div class="hidden md:block bg-white border-t border-slate-200 px-6 md:px-12 pt-4 pb-2">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div></div>
            <h4 class="text-slate-900 font-bold text-sm uppercase tracking-wider">Navigasi Menu</h4>
            <h4 class="text-slate-900 font-bold text-sm uppercase tracking-wider">Bantuan & Privasi</h4>
            <h4 class="text-slate-900 font-bold text-sm uppercase tracking-wider">Hubungi Kami</h4>
        </div>
    </div>

    <!-- BARIS BAWAH: GELAP, ISI KONTEN -->
    <div class="bg-slate-900 text-slate-300">
        <div class="px-6 md:px-12 py-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white font-bold text-lg mb-3">
                    {{ \App\Models\Setting::get('nama_perusahaan', 'Perusahaan') }}
                </h3>
                <p class="text-sm text-slate-400">
                    {{ \App\Models\Setting::get('deskripsi', 'Solusi terpadu untuk kebutuhan transportasi pariwisata, bahan bangunan, dan konstruksi dengan standar profesionalisme dan kualitas terbaik.') }}
                </p>
                <div class="flex gap-4 mt-4">
                    @if (\App\Models\Setting::get('instagram'))
                        <a href="{{ \App\Models\Setting::get('instagram') }}" target="_blank" class="hover:text-white">
                            <span class="text-2xl"></span>
                        </a>
                    @endif
                    @if (\App\Models\Setting::get('tiktok'))
                        <a href="{{ \App\Models\Setting::get('tiktok') }}" target="_blank" class="hover:text-white">
                            <span class="text-2xl"></span>
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-3 md:hidden">Navigasi Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('unit-usaha') }}" class="hover:text-white">Unit Usaha</a></li>
                    <li><a href="{{ route('galeri.publik') }}" class="hover:text-white">Galeri Foto</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-3 md:hidden">Bantuan & Privasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('kontak') }}" class="hover:text-white">Pusat Kontak</a></li>
                    <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-3 md:hidden">Hubungi Kami</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex gap-2"><span></span> {{ \App\Models\Setting::get('alamat', 'Alamat belum diisi') }}</li>
                    <li class="flex gap-2"><span></span> {{ \App\Models\Setting::get('telepon', '-') }}</li>
                    <li class="flex gap-2"><span></span> {{ \App\Models\Setting::get('email', '-') }}</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-800 px-6 md:px-12 py-4 text-xs text-slate-500 text-center">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('nama_perusahaan', 'Perusahaan') }}. Seluruh Hak Cipta Dilindungi.
        </div>
    </div>
</footer>

    @livewireScripts
</body>
</html>