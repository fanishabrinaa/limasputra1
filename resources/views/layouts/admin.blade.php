<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="lp-admin bg-slate-100 text-slate-800 font-sans antialiased selection:bg-rose-500 selection:text-white">

    <div class="flex min-h-screen">

        <!-- SIDEBAR DESKTOP -->
        <aside class="lp-admin-sidebar w-64 bg-slate-950 text-white flex-shrink-0 hidden md:flex flex-col border-r border-slate-900 sticky top-0 h-screen z-30">
            
            <!-- BRAND LOGO HEADER -->
            <div class="px-6 py-6 border-b border-slate-900 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    @if (\App\Models\Setting::get('logo'))
                        <img src="{{ Storage::url(\App\Models\Setting::get('logo')) }}" class="h-8 object-contain">
                    @else
                        <span class="w-3 h-3 rounded-full bg-rose-600"></span>
                    @endif
                    <div>
                        <span class="font-extrabold text-base text-white tracking-tight block leading-none">
                            {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}
                        </span>
                        <span class="text-[10px] font-semibold text-rose-500 uppercase tracking-widest block mt-1">Admin Panel</span>
                    </div>
                </a>
            </div>

            <!-- NAVIGATION LINKS -->
            <nav class="flex-1 px-4 py-6 space-y-6 overflow-y-auto text-xs">
                
                <!-- GROUP 1: UTAMA -->
                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">NAVIGASI UTAMA</span>
                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Dashboard
                        </a>
                        <a href="{{ route('pemesanan.index') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('pemesanan.index') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Pemesanan Armada
                        </a>
                        <a href="{{ route('pesan-masuk.index') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('pesan-masuk.index') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Pesan Masuk
                            @php $totalBaru = \App\Models\PesanMasuk::where('dibaca', false)->count(); @endphp
                            @if ($totalBaru > 0)
                                <span class="ml-auto bg-rose-600 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full animate-pulse">{{ $totalBaru }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- GROUP 2: MANAJEMEN UNIT & PRODUK -->
                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">INVENTARIS & LAYANAN</span>
                    <div class="space-y-1">
                        <a href="{{ route('armada') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('armada') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Bus Pariwisata
                        </a>
                        <a href="{{ route('fasilitas') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('fasilitas') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Fasilitas Bus
                        </a>
                        <a href="{{ route('produk.index') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('produk.index') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Bahan Bangunan
                        </a>
                        <a href="{{ route('setting.konten-konstruksi') }}"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('setting.konten-konstruksi') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Jasa Konstruksi
                        </a>
                        <a href="{{ route('setting.konten-unit-usaha') }}"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('setting.konten-unit-usaha') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Konten Unit Usaha
                        </a>
                    </div>
                </div>

                <!-- GROUP 3: KONTEN & MEDIA -->
                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">KONTEN & MEDIA</span>
                    <div class="space-y-1">
                        <a href="{{ route('galeri.index') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('galeri.index') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Galeri Dokumentasi
                        </a>
                        <a href="{{ route('testimoni.index') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('testimoni.index') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Testimoni Pelanggan
                        </a>
                    </div>
                </div>
    

                <!-- GROUP 4: PENGATURAN SYSTEM -->
                <div>
                    <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">PENGATURAN WEBSITE</span>
                    <div class="space-y-1">
                        <a href="{{ route('setting.index') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('setting.index') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Pengaturan Umum
                        </a>
                        <a href="{{ route('setting.konten') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('setting.konten') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Konten Tentang Kami
                        </a>
                        <a href="{{ route('setting.gambar') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('setting.gambar') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Gambar Banner Utama
                        </a>
                        <a href="{{ route('setting.konten-beranda') }}"
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold transition-all duration-200 {{ request()->routeIs('setting.konten-beranda') ? 'bg-rose-700 text-white shadow-lg shadow-rose-950/40' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            <span class="text-sm"></span> Konten Beranda
                        </a>
                    </div>
                </div>

            </nav>

            <!-- FOOTER USER & LOGOUT -->
            <div class="px-4 py-4 border-t border-slate-900 space-y-1.5 bg-slate-950/80">
                <a href="{{ route('beranda') }}" target="_blank"
                   class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-slate-400 hover:bg-slate-900 hover:text-white text-xs font-medium transition">
                    <span class="text-sm"></span> Lihat Website
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-3.5 py-2 rounded-xl text-rose-400 hover:bg-rose-950/50 hover:text-rose-300 text-xs font-semibold transition">
                        <span class="text-sm"></span> Keluar (Logout)
                    </button>
                </form>
            </div>
        </aside>
        <!-- MOBILE TOP BAR HEADER -->
        <div x-data="{ mobileNavOpen: false }">
            <div class="md:hidden fixed top-0 left-0 right-0 bg-slate-950 text-white px-4 py-3 flex justify-between items-center z-40 border-b border-slate-900 shadow-md">
                <span class="font-bold text-rose-500 text-sm flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-600"></span>
                    {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}
                </span>
                <button @click="mobileNavOpen = true" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- BACKDROP -->
            <div x-show="mobileNavOpen" x-cloak @click="mobileNavOpen = false"
                 class="md:hidden fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-40"
                 x-transition:enter="transition-opacity ease-out duration-300"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 style="display: none;"></div>

            <!-- DRAWER MENU MOBILE -->
            <aside x-show="mobileNavOpen" x-cloak
                   class="md:hidden fixed top-0 left-0 h-screen w-72 max-w-[85vw] bg-slate-950 text-white z-50 overflow-y-auto"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                   style="display: none;">

                <div class="px-6 py-6 border-b border-slate-900 flex items-center justify-between">
                    <span class="font-extrabold text-base text-white">
                        {{ \App\Models\Setting::get('nama_perusahaan', 'Putra Limas') }}
                    </span>
                    <button @click="mobileNavOpen = false" class="text-slate-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <nav class="px-4 py-6 space-y-6 text-xs">
                    <div>
                        <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">NAVIGASI UTAMA</span>
                        <div class="space-y-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold {{ request()->routeIs('dashboard') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Dashboard</a>
                            <a href="{{ route('pemesanan.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('pemesanan.index') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Pemesanan Armada</a>
                            <a href="{{ route('pesan-masuk.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('pesan-masuk.index') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                                Pesan Masuk
                                @php $totalBaru = \App\Models\PesanMasuk::where('dibaca', false)->count(); @endphp
                                @if ($totalBaru > 0)
                                    <span class="ml-auto bg-rose-600 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full">{{ $totalBaru }}</span>
                                @endif
                            </a>
                        </div>
                    </div>

                    <div>
                        <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">INVENTARIS & LAYANAN</span>
                        <div class="space-y-1">
                            <a href="{{ route('armada') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('armada') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Bus Pariwisata</a>
                            <a href="{{ route('fasilitas') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('fasilitas') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Fasilitas Bus</a>
                            <a href="{{ route('produk.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('produk.index') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Bahan Bangunan</a>
                            <a href="{{ route('setting.konten-konstruksi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('setting.konten-konstruksi') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Konten Konstruksi</a>
                        </div>
                    </div>

                    <div>
                        <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">KONTEN & MEDIA</span>
                        <div class="space-y-1">
                            <a href="{{ route('galeri.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('galeri.index') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Galeri Dokumentasi</a>
                            <a href="{{ route('testimoni.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('testimoni.index') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Testimoni Pelanggan</a>
                        </div>
                    </div>

                    <div>
                        <span class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">PENGATURAN WEBSITE</span>
                        <div class="space-y-1">
                            <a href="{{ route('setting.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('setting.index') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Pengaturan Umum</a>
                            <a href="{{ route('setting.konten') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('setting.konten') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Konten Tentang Kami</a>
                            <a href="{{ route('setting.gambar') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('setting.gambar') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Gambar Banner Utama</a>
                            <a href="{{ route('setting.konten-beranda') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg font-semibold {{ request()->routeIs('setting.konten-beranda') ? 'bg-rose-700 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">Konten Beranda</a>
                        </div>
                    </div>
                </nav>

                <div class="px-4 py-4 border-t border-slate-900 space-y-1.5 bg-slate-950/80 mt-auto">
                    <a href="{{ route('beranda') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-slate-400 hover:bg-slate-900 hover:text-white text-xs font-medium">Lihat Website</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2 rounded-xl text-rose-400 hover:bg-rose-950/50 hover:text-rose-300 text-xs font-semibold">Keluar (Logout)</button>
                    </form>
                </div>
            </aside>
        </div>

        <!-- MAIN KONTEN CONTAINER -->
        <main class="flex-1 md:mt-0 mt-14 overflow-x-hidden min-h-screen bg-slate-100">
            <!-- TOP BAR HEADER DESKTOP -->
            <header class="lp-admin-topbar hidden md:flex bg-white border-b border-slate-200 px-8 py-4 justify-between items-center sticky top-0 z-20 shadow-xs">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                    <span>Admin Panel</span>
                    <span>/</span>
                    <span class="text-slate-900 font-bold capitalize">{{ request()->route() ? str_replace(['.index', '-'], ['', ' '], request()->route()->getName()) : 'Dashboard' }}</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('beranda') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-rose-700 bg-slate-100 hover:bg-rose-50 px-3.5 py-1.5 rounded-xl transition">
                        <span>Pratinjau Website</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </header>

            <!-- LIVEWIRE COMPONENT SLOT -->
            <div class="lp-admin-content p-6 md:p-8">
                {{ $slot }}
            </div>
        </main>

    </div>

    @livewireScripts
    <!-- TOAST NOTIFICATION - taruh sebelum </body>, cukup 1x di layout admin -->
    <div x-data="{ show: false, message: '' }"
        x-on:toast.window="message = $event.detail.message; show = true; clearTimeout(window.__toastTimer); window.__toastTimer = setTimeout(() => show = false, 3000)"
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-3"
        class="fixed bottom-6 right-6 z-[9999] bg-slate-900 text-white text-sm font-semibold pl-4 pr-5 py-3.5 rounded-2xl shadow-2xl flex items-center gap-3"
        style="display: none;">
        <span class="w-7 h-7 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </span>
        <span x-text="message"></span>
    </div>
</body>
</html>