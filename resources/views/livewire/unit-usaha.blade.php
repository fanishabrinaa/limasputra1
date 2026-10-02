<div>
    <!-- HEADER SECTION -->
    <div class="lp-hero-glow relative bg-slate-950 text-white py-20 px-6 md:px-12 text-center overflow-hidden border-b border-slate-900"> 
        <div class="absolute inset-0 z-0">
    <img src="{{ \App\Models\Setting::get('img_halaman_hero') ? Storage::url(\App\Models\Setting::get('img_halaman_hero')) : (\App\Models\Setting::get('img_unit_usaha_hero') ? Storage::url(\App\Models\Setting::get('img_unit_usaha_hero')) : 'https://images.unsplash.com/photo-1541888946425-d0fbb186a5b7?auto=format&fit=crop&q=80&w=1600') }}"
        alt="Unit Usaha Putra Limas"
        class="lp-hero-image w-full h-full object-cover opacity-90 brightness-110 scale-105">
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/40 via-slate-950/50 to-slate-950"></div>
</div>

        <!-- Glow Effect Ambient -->
       <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-rose-600/10 blur-[100px] rounded-full pointer-events-none"></div>
        
        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="lp-fade-up inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-5 backdrop-blur-md">
                PILAR BISNIS UTAMA
            </span>
           <h1 class="lp-fade-up lp-delay-1 text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                {!! preg_replace(
                    '/\*\*(.*?)\*\*/',
                    '<span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">$1</span>',
                    e(\App\Models\Setting::get('unit_usaha_judul', 'Unit Usaha **Putra Limas**'))
                ) !!}
            </h1>
            <p class="lp-fade-up lp-delay-2 text-slate-300 text-base max-w-xl mx-auto leading-relaxed">
                {{ \App\Models\Setting::get('unit_usaha_deskripsi', 'Temukan berbagai layanan unggulan kami melalui tiga bidang usaha utama yang mengutamakan kualitas, profesionalisme, dan kepercayaan pelanggan.') }}
            </p>
        </div>
    </div>

    @php
        // Helper: ambil daftar foto galeri (array URL), fallback ke foto tunggal kalau galeri kosong/belum ada
        $ambilGaleri = function (string $galleryKey, string $singleKey, string $fallback) {
            $raw = \App\Models\Setting::get($galleryKey);
            $paths = $raw ? (json_decode($raw, true) ?: []) : [];

            if (!empty($paths)) {
                return array_map(fn ($p) => Storage::url($p), $paths);
            }

            $single = \App\Models\Setting::get($singleKey);
            return [$single ? Storage::url($single) : $fallback];
        };

        $galeriBus = $ambilGaleri('img_unit_bus_gallery', 'img_unit_bus', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400');
        $galeriBangunan = $ambilGaleri('img_unit_bangunan_gallery', 'img_unit_bangunan', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400');
        $galeriKonstruksi = $ambilGaleri('img_unit_konstruksi_gallery', 'img_unit_konstruksi', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400');
    @endphp

    <!-- CARDS SECTION (STATIS, GAMBAR DI DALAM SLIDESHOW OTOMATIS) -->
    <div class="bg-slate-50 px-6 md:px-12 py-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- BUS PARIWISATA -->
            <div class="lp-scroll-zoom bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between hover:shadow-xl hover:border-rose-200 hover:-translate-y-1 transition-all duration-300 group" style="--delay: 0ms;">
                <div>
                    <div class="unit-usaha-slideshow h-52 relative overflow-hidden bg-slate-950" data-images='@json($galeriBus)'>
                        @foreach ($galeriBus as $i => $src)
                            <img src="{{ $src }}"
                                 class="unit-usaha-slide-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $i === 0 ? 'opacity-90' : 'opacity-0' }} group-hover:scale-110"
                                 style="transition-property: opacity, transform;"
                                 draggable="false">
                        @endforeach
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent pointer-events-none"></div>
                        <span class="absolute top-4 left-4 bg-rose-700/90 text-white text-[11px] font-bold tracking-wider px-3 py-1 rounded-full uppercase backdrop-blur-md">
                            TRANSPORTASI
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-slate-900 mb-2">Bus Pariwisata</h3>
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">Layanan penyewaan bus pariwisata dengan armada nyaman dan fasilitas lengkap untuk perjalanan dinas maupun wisata.</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('armada.katalog') }}"
                       class="inline-flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl text-sm transition-colors duration-300 shadow-md group-hover:shadow-rose-900/20">
                        <span>Lihat Detail</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- TOKO BANGUNAN -->
            <div class="lp-scroll-zoom bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between hover:shadow-xl hover:border-rose-200 hover:-translate-y-1 transition-all duration-300 group" style="--delay: 150ms;">
                <div>
                    <div class="unit-usaha-slideshow h-52 relative overflow-hidden bg-slate-950" data-images='@json($galeriBangunan)'>
                        @foreach ($galeriBangunan as $i => $src)
                            <img src="{{ $src }}"
                                 class="unit-usaha-slide-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $i === 0 ? 'opacity-90' : 'opacity-0' }} group-hover:scale-110"
                                 style="transition-property: opacity, transform;"
                                 draggable="false">
                        @endforeach
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent pointer-events-none"></div>
                        <span class="absolute top-4 left-4 bg-rose-700/90 text-white text-[11px] font-bold tracking-wider px-3 py-1 rounded-full uppercase backdrop-blur-md">
                            MATERIAL
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-slate-900 mb-2">Toko Bangunan</h3>
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">Penyedia berbagai kebutuhan material bangunan berkualitas untuk pembangunan dan renovasi hunian atau gedung.</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('produk.publik') }}"
                       class="inline-flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl text-sm transition-colors duration-300 shadow-md group-hover:shadow-rose-900/20">
                        <span>Lihat Detail</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- KONSTRUKSI -->
            <div class="lp-scroll-zoom bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between hover:shadow-xl hover:border-rose-200 hover:-translate-y-1 transition-all duration-300 group"
                 style="--delay: 300ms;">
                <div>
                    <div class="unit-usaha-slideshow h-52 relative overflow-hidden bg-slate-950" data-images='@json($galeriKonstruksi)'>
                        @foreach ($galeriKonstruksi as $i => $src)
                            <img src="{{ $src }}"
                                 class="unit-usaha-slide-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $i === 0 ? 'opacity-90' : 'opacity-0' }} group-hover:scale-110"
                                 style="transition-property: opacity, transform;"
                                 draggable="false">
                        @endforeach
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent pointer-events-none"></div>
                        <span class="absolute top-4 left-4 bg-rose-700/90 text-white text-[11px] font-bold tracking-wider px-3 py-1 rounded-full uppercase backdrop-blur-md">
                            KONSTRUKSI
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-slate-900 mb-2">Jasa Konstruksi</h3>
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">Layanan konstruksi profesional untuk pembangunan, renovasi, dan pelaksanaan proyek infrastruktur secara tepat waktu.</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('konstruksi') }}"
                       class="inline-flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl text-sm transition-colors duration-300 shadow-md group-hover:shadow-rose-900/20">
                        <span>Konsultasi Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        // ===== SLIDESHOW OTOMATIS DI DALAM TIAP KARTU (fade antar foto, posisi kartu tetap diam) =====
        document.querySelectorAll('.unit-usaha-slideshow').forEach(function (box) {
            const imgs = box.querySelectorAll('.unit-usaha-slide-img');
            if (imgs.length <= 1) return; // cuma 1 foto (atau kosong), gak perlu slideshow

            let current = 0;
            const DELAY = 3000; // 3 detik tiap foto, ubah kalau mau beda

            setInterval(function () {
                imgs[current].classList.remove('opacity-90');
                imgs[current].classList.add('opacity-0');

                current = (current + 1) % imgs.length;

                imgs[current].classList.remove('opacity-0');
                imgs[current].classList.add('opacity-90');
            }, DELAY);
        });
    </script>
</div>