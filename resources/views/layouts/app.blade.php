@php
    $setting   = fn ($key, $default = null) => \App\Models\Setting::get($key, $default);

    $nama      = $setting('nama_perusahaan', 'Perusahaan');
    $deskripsi = $setting('deskripsi', 'Solusi terpadu untuk kebutuhan transportasi pariwisata, bahan bangunan, dan konstruksi dengan standar profesionalisme dan kualitas terbaik.');
    $logo      = $setting('logo');
    $telepon   = $setting('telepon');
    $email     = $setting('email');
    $alamat    = $setting('alamat', 'Alamat belum diisi');
    $instagram = $setting('instagram');
    $tiktok    = $setting('tiktok');

    // Nomor internasional untuk wa.me / tel: (0812... -> 62812...)
    $nomor = $telepon ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $telepon)) : null;

    // Menu utama (navbar desktop, navbar mobile, footer)
    $menu = [
        ['label' => 'Beranda',      'route' => 'beranda',       'active' => ['beranda']],
        ['label' => 'Unit Usaha',   'route' => 'unit-usaha',    'active' => ['unit-usaha', 'armada.katalog', 'armada.detail', 'produk.publik', 'produk.detail', 'konstruksi']],
        ['label' => 'Galeri',       'route' => 'galeri.publik', 'active' => ['galeri.publik'], 'footer' => 'Galeri Foto'],
        ['label' => 'Tentang Kami', 'route' => 'about',         'active' => ['about']],
        ['label' => 'Kontak',       'route' => 'kontak',        'active' => ['kontak']],
    ];
    $footerMenu = array_slice($menu, 0, 4);

    // ===== SEO =====
    $pageTitle = (isset($title) ? $title . ' - ' : '') . $nama;
    $pageDesc  = $metaDescription ?? $deskripsi;
    $ogImage   = $logo ? url(Storage::url($logo)) : null;

    // Data bisnis lokal untuk Google (schema.org)
    $schema = array_filter([
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => $nama,
        'url'         => url('/'),
        'description' => $deskripsi,
        'telephone'   => $nomor ? '+' . $nomor : null,
        'email'       => $email,
        'image'       => $ogImage,
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Bendo, Sekuro, Kec. Mlonggo',
            'addressLocality' => 'Jepara',
            'addressRegion'   => 'Jawa Tengah',
            'addressCountry'  => 'ID',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => -6.5268919,
            'longitude' => 110.7173314,
        ],
        'sameAs' => array_values(array_filter([$instagram, $tiktok])),
    ]);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDesc }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Tampilan saat link dibagikan ke WhatsApp, Facebook, dll --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $nama }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDesc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">

    @if ($logo)
        <link rel="icon" type="image/png" href="{{ Storage::url($logo) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* Tanpa ini elemen x-cloak sempat tampil sebentar saat halaman dimuat */
        [x-cloak] { display: none !important; }

        /* Sembunyikan tombol WhatsApp mengambang saat menu mobile terbuka
           (di dalam menu sudah ada tombol "Hubungi via WhatsApp") */
        @media (max-width: 767px) {
            body.menu-open #wa-float { display: none !important; }
        }
    </style>

    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</head>

<body class="lp-site bg-slate-50 text-slate-800 font-sans antialiased selection:bg-rose-500 selection:text-white flex flex-col min-h-screen">

    {{-- ============================= NAVBAR ============================= --}}
    <nav x-data="{ mobileOpen: false }"
         x-effect="document.body.style.overflow = mobileOpen ? 'hidden' : ''; document.body.classList.toggle('menu-open', mobileOpen)"
         @keydown.escape.window="mobileOpen = false"
         class="bg-gradient-to-b from-white to-slate-100 border-b border-slate-200 px-6 md:px-12 py-4 sticky top-0 z-50">
        <div class="flex justify-between items-center">

            {{-- Logo & nama --}}
            <a href="{{ route('beranda') }}" class="flex items-center gap-2">
                @if ($logo)
                    <img src="{{ Storage::url($logo) }}" alt="Logo {{ $nama }}" class="h-9 object-contain">
                @endif
                <span class="font-bold text-xl text-rose-700">{{ $nama }}</span>
            </a>

            {{-- Navigasi desktop --}}
            <div class="hidden md:flex gap-8 items-center text-sm font-medium text-slate-600">
                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}"
                       class="{{ request()->routeIs(...$item['active']) ? 'text-rose-700 border-b-2 border-rose-700 pb-1' : 'hover:text-rose-700' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Auth (desktop) --}}
            <div class="hidden md:flex items-center gap-4">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-rose-700 hover:underline">Dashboard Admin</a>
                    @else
                        <a href="{{ route('pemesanan.riwayat') }}" class="text-sm font-medium text-slate-600 hover:text-rose-700">Pesanan Saya</a>
                    @endif

                    {{-- @click.outside dipasang di wrapper, bukan di tombol --}}
                    <div class="relative" x-data="{ userMenuOpen: false }" @click.outside="userMenuOpen = false">
                        <button type="button" @click="userMenuOpen = !userMenuOpen" :aria-expanded="userMenuOpen"
                                class="flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-rose-700 transition">
                            <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-700 font-semibold text-xs">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': userMenuOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="userMenuOpen" x-cloak x-transition
                             class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-slate-100 py-1 z-50">
                            <a href="{{ route('profile') }}"
                               class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-rose-700">
                                Profil Saya
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-slate-500 hover:bg-rose-50 hover:text-rose-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-rose-700 hover:bg-rose-800 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                        Login
                    </a>
                @endauth
            </div>

            {{-- Hamburger (mobile) --}}
            <button type="button" @click="mobileOpen = true" aria-label="Buka menu" class="md:hidden text-slate-700">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Backdrop mobile (klik di luar panel = tutup) --}}
        <div x-show="mobileOpen" x-cloak x-transition.opacity
             @click="mobileOpen = false"
             class="md:hidden fixed inset-0 bg-black/40 z-40"></div>

        {{-- Panel menu mobile --}}
        <div x-show="mobileOpen" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="md:hidden fixed top-0 right-0 h-dvh w-72 max-w-[85vw] bg-white shadow-2xl z-50 flex flex-col">

            {{-- Header --}}
            <div class="flex justify-between items-center px-5 py-4 border-b border-slate-100 shrink-0">
                <span class="font-bold text-rose-700 truncate">{{ $nama }}</span>
                <button type="button" @click="mobileOpen = false" aria-label="Tutup menu"
                        class="text-slate-400 hover:text-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Menu: bagian ini yang scroll kalau layar pendek --}}
            <div class="flex-1 min-h-0 overflow-y-auto px-2 py-3 text-base font-medium">
                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
                       class="block px-3 py-3 rounded-lg {{ request()->routeIs(...$item['active']) ? 'text-rose-700 font-bold bg-rose-50' : 'text-slate-600 hover:bg-slate-50' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Aksi: selalu kelihatan di dasar --}}
            <div class="shrink-0 border-t border-slate-200 px-5 pt-4 space-y-3 text-sm font-medium"
                 style="padding-bottom: max(1rem, env(safe-area-inset-bottom));">

                @if ($nomor)
                    <a href="https://wa.me/{{ $nomor }}" target="_blank" rel="noopener noreferrer"
                       class="flex items-center justify-center bg-green-50 border border-green-200 text-green-700 font-semibold px-4 py-2.5 rounded-xl hover:bg-green-100 transition-colors">
                        Hubungi via WhatsApp
                    </a>
                @endif

                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="block py-1.5 text-rose-700 font-bold">Dashboard Admin</a>
                    @endif

                    <a href="{{ route('pemesanan.riwayat') }}" class="block py-1.5 text-slate-600">Pesanan Saya</a>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('profile') }}" class="py-1.5 text-slate-600">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-1.5 pl-4 text-slate-500 hover:text-rose-700">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center bg-rose-700 hover:bg-rose-600 text-white font-semibold px-4 py-2.5 rounded-xl transition-colors">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ============================= KONTEN UTAMA ============================= --}}
    <main class="lp-page-content flex-1">
        {{ $slot }}
    </main>

    {{-- ============================= FOOTER ============================= --}}
    <footer class="lp-site-footer">

        {{-- Baris atas: putih, hanya judul kolom (desktop) --}}
        <div class="hidden md:block bg-white border-t border-slate-200 px-12 pt-4 pb-2">
            <div class="grid grid-cols-4 gap-8">
                <h4 class="text-slate-900 font-bold text-sm uppercase tracking-wider">{{ $nama }}</h4>
                <h4 class="text-slate-900 font-bold text-sm uppercase tracking-wider">Navigasi Menu</h4>
                <h4 class="text-slate-900 font-bold text-sm uppercase tracking-wider">Layanan</h4>
                <h4 class="text-slate-900 font-bold text-sm uppercase tracking-wider">Lokasi Kami</h4>
            </div>
        </div>

        {{-- Baris bawah: gelap, isi konten --}}
        <div class="bg-slate-900 text-slate-300">
            <div class="px-6 md:px-12 py-8 grid grid-cols-1 md:grid-cols-4 gap-8">

                {{-- Kolom 1: brand + ikon kontak --}}
                <div>
                    <h3 class="md:hidden text-white font-bold text-lg mb-3">{{ $nama }}</h3>
                    <p class="text-sm text-slate-400">{{ $deskripsi }}</p>

                    <div class="flex flex-wrap gap-3 mt-5">
                        @if ($nomor)
                            <a href="tel:+{{ $nomor }}" aria-label="Telepon" title="Telepon"
                               class="w-10 h-10 rounded-full bg-slate-800 hover:bg-rose-600 text-rose-500 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.5 4.5a1 1 0 01-.5 1.2l-2.26 1.13a11 11 0 005.52 5.52l1.13-2.26a1 1 0 011.2-.5l4.5 1.5a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.72 21 3 14.28 3 6V5z"/></svg>
                            </a>
                        @endif
                        @if ($email)
                            <a href="mailto:{{ $email }}" aria-label="Email" title="Email"
                               class="w-10 h-10 rounded-full bg-slate-800 hover:bg-rose-600 text-rose-500 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </a>
                        @endif
                        @if ($instagram)
                            <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" title="Instagram"
                               class="w-10 h-10 rounded-full bg-slate-800 hover:bg-rose-600 text-rose-500 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                            </a>
                        @endif
                        @if ($tiktok)
                            <a href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok" title="TikTok"
                               class="w-10 h-10 rounded-full bg-slate-800 hover:bg-rose-600 text-rose-500 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Kolom 2: navigasi --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-3 md:hidden">Navigasi Menu</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach ($footerMenu as $item)
                            <li><a href="{{ route($item['route']) }}" class="hover:text-white transition-colors">{{ $item['footer'] ?? $item['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kolom 3: layanan --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-3 md:hidden">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('armada.katalog') }}" class="hover:text-white transition-colors">Sewa Bus Pariwisata</a></li>
                        <li><a href="{{ route('produk.publik') }}" class="hover:text-white transition-colors">Toko Bangunan</a></li>
                        <li><a href="{{ route('konstruksi') }}" class="hover:text-white transition-colors">Jasa Konstruksi</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-white transition-colors">Pusat Kontak</a></li>
                    </ul>
                </div>

                {{-- Kolom 4: peta + alamat --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-3 md:hidden">Lokasi Kami</h4>
                    <div style="height:150px; border-radius:12px; overflow:hidden; border:1px solid #334155;">
                        <iframe
                            src="https://maps.google.com/maps?q=-6.5268919,110.7173314&z=17&output=embed"
                            style="width:100%; height:100%; border:0;"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                            title="Lokasi {{ $nama }}">
                        </iframe>
                    </div>

                    <div class="flex gap-3 text-sm mt-4">
                        <svg class="w-5 h-5 text-rose-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <a href="https://maps.app.goo.gl/ohrcUYJdje8HGr1D9" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">
                            Bendo, Sekuro, Kec. Mlonggo, Kabupaten Jepara
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 px-6 md:px-12 py-4 text-xs text-slate-500 text-center">
                &copy; {{ date('Y') }} {{ $nama }}. Seluruh Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    {{-- ============================= FLOATING WHATSAPP ============================= --}}
    @if ($nomor)
        <a href="https://wa.me/{{ $nomor }}?text={{ urlencode('Halo, saya ingin bertanya seputar layanan ' . $nama . '...') }}"
           id="wa-float"
           target="_blank" rel="noopener noreferrer"
           aria-label="Chat via WhatsApp"
           class="fixed bottom-5 right-5 md:bottom-8 md:right-8 z-[90] flex items-center justify-center w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 group">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12.001 2C6.478 2 2 6.478 2 12c0 1.788.472 3.51 1.363 5.024L2 22l5.108-1.34A9.955 9.955 0 0012.001 22C17.523 22 22 17.522 22 12S17.523 2 12.001 2zm0 18.001c-1.62 0-3.208-.436-4.593-1.262l-.33-.196-3.03.795.81-2.955-.215-.34A7.977 7.977 0 014 12c0-4.411 3.589-8 8.001-8C16.412 4 20 7.589 20 12s-3.588 8.001-7.999 8.001z"/>
            </svg>
            <span class="absolute right-full mr-3 bg-slate-900 text-white text-xs font-medium px-3 py-1.5 rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                Tanya via WhatsApp
            </span>
        </a>
    @endif

    @livewireScripts

    {{-- ============================= AUTO-GESER CAROUSEL (mobile) ============================= --}}
    <script>
    (function () {
        if (window.__autoScrollInit) return;
        window.__autoScrollInit = true;

        const pausedUntil = new WeakMap();

        // Geser dengan durasi yang bisa diatur (ms)
        function animateScroll(el, to, duration) {
            const from = el.scrollLeft;
            const start = performance.now();
            el.style.scrollSnapType = 'none'; // matikan snap sementara supaya tidak melawan animasi

            function tick(now) {
                const t = Math.min((now - start) / duration, 1);
                const ease = 1 - Math.pow(1 - t, 3); // easeOutCubic
                el.scrollLeft = from + (to - from) * ease;
                if (t < 1) {
                    requestAnimationFrame(tick);
                } else {
                    el.style.scrollSnapType = ''; // snap aktif lagi
                }
            }
            requestAnimationFrame(tick);
        }

        // Jeda 3 detik setelah carousel disentuh / digeser manual
        const pause = (e) => {
            const s = e.target.closest && e.target.closest('[data-autoscroll]');
            if (s) pausedUntil.set(s, Date.now() + 3000);
        };
        ['touchstart', 'touchmove', 'pointerdown', 'wheel'].forEach(ev =>
            document.addEventListener(ev, pause, { passive: true })
        );

        setInterval(() => {
            if (window.innerWidth >= 768) return; // desktop pakai grid

            document.querySelectorAll('[data-autoscroll]').forEach(s => {
                if (Date.now() < (pausedUntil.get(s) || 0)) return;

                // hanya geser kalau carousel sedang terlihat di layar
                const r = s.getBoundingClientRect();
                if (r.bottom < 0 || r.top > window.innerHeight) return;

                const cards = s.children;
                const maxScroll = s.scrollWidth - s.clientWidth;
                if (cards.length < 2 || maxScroll <= 0) return;

                const step = cards[1].offsetLeft - cards[0].offsetLeft;
                const next = s.scrollLeft >= maxScroll - 5 ? 0 : Math.min(s.scrollLeft + step, maxScroll);

                animateScroll(s, next, 400);
            });
        }, 2000); // jeda antar geseran (ms)
    })();
    </script>
</body>
</html>