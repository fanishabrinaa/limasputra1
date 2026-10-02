<div>
    <!-- HERO SECTION -->
    <div class="lp-hero-glow relative min-h-[560px] bg-slate-950 flex items-center">
        <!-- Background Image & Gradient Overlay -->
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ \App\Models\Setting::get('img_beranda_hero') ? Storage::url(\App\Models\Setting::get('img_beranda_hero')) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400' }}"
                class="w-full h-full object-cover opacity-50 scale-105 transition-transform duration-1000">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
        </div>

            <div class="relative z-10 px-6 md:px-12 pt-10 pb-28 md:pb-32 max-w-3xl lp-hero-content">
            <span class="lp-fade-up lp-scroll-rotate inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-3.5 py-1.5 rounded-full mb-6 backdrop-blur-md">
                INSTITUTIONAL TRUST
            </span>
            <h1 class="lp-fade-up lp-delay-1 text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight">
                Membangun Masa Depan Bersama <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">
                    {{ $nama_perusahaan }}</span>
            </h1>
            <p class="lp-fade-up lp-delay-2 text-slate-300 text-lg mb-8 leading-relaxed max-w-xl">{{ $deskripsi }}</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('about') }}"  class="lp-fade-up lp-delay-3 lp-motion-button bg-rose-700 hover:bg-rose-600 text-white font-semibold px-7 py-3.5 rounded-xl shadow-lg shadow-rose-900/30 transition-all duration-300 hover:scale-[1.02]">
                    Pelajari Lebih Lanjut
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::get('telepon', '')) }}" target="_blank" class="lp-fade-up lp-delay-3 lp-motion-button bg-white/10 border border-white/30 hover:bg-white/20 text-white font-semibold px-7 py-3.5 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-slate-600">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
     <!-- FLOATING STAT BAR -->
<div class="relative z-20 -mt-24 px-6 md:px-12 lp-stat-bar">
    <div class="lp-scroll-zoom bg-white rounded-2xl shadow-xl shadow-slate-950/20 border border-slate-100 grid grid-cols-2 md:grid-cols-4 overflow-hidden divide-x divide-slate-100">
        <div class="lp-stat-item p-4 md:p-6 text-center hover:bg-slate-50/50 transition-colors">
            <p class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-1">{{ $statTahunPengalaman }}</p>
            <p class="text-[11px] md:text-xs font-medium text-slate-500 uppercase tracking-wider">Tahun Pengalaman</p>
        </div>
        <div class="lp-stat-item p-4 md:p-6 text-center hover:bg-slate-50/50 transition-colors">
            <p class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-1">{{ $jumlahProduk }}+</p>
            <p class="text-[11px] md:text-xs font-medium text-slate-500 uppercase tracking-wider">Produk Tersedia</p>
        </div>
        <div class="lp-stat-item p-4 md:p-6 text-center hover:bg-slate-50/50 transition-colors">
            <p class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-1">{{ $jumlahArmada }}+</p>
            <p class="text-[11px] md:text-xs font-medium text-slate-500 uppercase tracking-wider">Armada Siap Sewa</p>
        </div>
        <div class="lp-stat-item p-4 md:p-6 text-center bg-slate-900 text-white">
            <p class="text-2xl md:text-3xl font-extrabold text-rose-500 mb-1">{{ $statPelangganPuas }}</p>
            <p class="text-[11px] md:text-xs font-medium text-slate-300 uppercase tracking-wider">Pelanggan Puas</p>
        </div>
    </div>
</div>
<!-- MENGAPA MEMILIH KAMI -->
<div class="px-6 md:px-12 pb-20 text-center bg-slate-50" style="padding-top: 3rem;">
    <h2 class="lp-scroll text-3xl font-bold text-slate-900 mb-2">Mengapa Memilih Kami?</h2>
    <div class="lp-scroll lp-pulse-line w-16 h-1 bg-rose-600 mx-auto mb-12 rounded-full"></div>

<div data-autoscroll class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 md:grid md:grid-cols-4 md:gap-8 md:overflow-visible text-left max-w-7xl mx-auto [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
    @foreach ($mengapaKami as $index => $item)
        <div
            class="lp-why-card lp-scroll-zoom lp-motion-card snap-start snap-always bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-rose-200 transition-all duration-300 group"
            style="--delay: {{ $index * 120 }}ms;"
        >
            <h3 class="font-bold text-slate-900 text-lg mb-2">{{ $item['title'] }}</h3>
            <p class="text-sm text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
        </div>
    @endforeach
</div>
</div>

    <!-- UNIT BISNIS -->
    <div class="bg-slate-950 px-6 md:px-12 pt-20 pb-12">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between md:items-end mb-12 gap-4">
                <div>
                    <h2 class="lp-scroll text-3xl font-bold text-white mb-3">{{ \App\Models\Setting::get('beranda_unitbisnis_judul', 'Unit Bisnis Strategis Kami') }}</h2>
                    <p class="lp-scroll text-slate-400 max-w-xl text-base">{{ \App\Models\Setting::get('beranda_unitbisnis_paragraf', 'Putra Limas mengintegrasikan tiga pilar bisnis utama untuk mendukung kebutuhan mobilitas dan pembangunan infrastruktur di Indonesia.') }}</p>
                </div>
                <a href="{{ route('unit-usaha') }}" class="inline-flex items-center gap-2 text-rose-400 text-sm font-semibold hover:text-rose-300 transition-colors">
                    Lihat Semua Unit
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- BUS PARIWISATA -->
                <div class="lp-scroll-zoom lp-motion-card lp-business-card bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden flex flex-col hover:border-slate-700 transition-all duration-300 group" style="--delay: 0ms;">
                    <div class="h-40 relative overflow-hidden bg-slate-950">
                        <img src="{{ \App\Models\Setting::get('img_unit_bus') ? Storage::url(\App\Models\Setting::get('img_unit_bus')) : 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800' }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="font-bold text-xl text-white mb-2">Bus Pariwisata</h3>
                        <p class="text-sm text-slate-400 mb-6 leading-relaxed">{{ \App\Models\Setting::get('beranda_desc_bus', 'Layanan transportasi eksekutif dengan armada modern untuk perjalanan wisata, bisnis, maupun keperluan grup.') }}</p>
                        <a href="{{ route('armada.katalog') }}"
                           class="mt-auto block text-center bg-slate-800 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl text-sm transition-colors duration-300 border border-slate-700 hover:border-rose-700">
                            Lihat Unit Usaha
                        </a>
                    </div>
                </div>

                <!-- TOKO BANGUNAN -->
                <div class="lp-scroll-zoom lp-motion-card lp-business-card bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden flex flex-col hover:border-slate-700 transition-all duration-300 group" style="--delay: 150ms;">
                    <div class="h-40 relative overflow-hidden bg-slate-950">
                        <img src="{{ \App\Models\Setting::get('img_unit_bangunan') ? Storage::url(\App\Models\Setting::get('img_unit_bangunan')) : 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800' }}"
                           class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="font-bold text-xl text-white mb-2">Toko Bangunan</h3>
                        <p class="text-sm text-slate-400 mb-6 leading-relaxed">{{ \App\Models\Setting::get('beranda_desc_bangunan', 'Pusat retail bahan bangunan terlengkap yang menyediakan material berkualitas dengan harga kompetitif.') }}</p>
                        <a href="{{ route('produk.publik') }}"
                           class="mt-auto block text-center bg-slate-800 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl text-sm transition-colors duration-300 border border-slate-700 hover:border-rose-700">
                            Lihat Unit Usaha
                        </a>
                    </div>
                </div>

                <!-- Jasa KONSTRUKSI -->
                <div class="lp-scroll-zoom lp-motion-card lp-business-card bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden flex flex-col hover:border-slate-700 transition-all duration-300 group" style="--delay: 300ms;">
                    <div class="h-40 relative overflow-hidden bg-slate-950">
                        <img src="{{ \App\Models\Setting::get('img_unit_konstruksi') ? Storage::url(\App\Models\Setting::get('img_unit_konstruksi')) : 'https://images.unsplash.com/photo-1541888946425-d0fbb186a5b3?w=800' }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="font-bold text-xl text-white mb-2">Jasa Konstruksi</h3>
                        <p class="text-sm text-slate-400 mb-6 leading-relaxed">{{ \App\Models\Setting::get('beranda_desc_konstruksi', 'Solusi konstruksi profesional untuk proyek skala besar, infrastruktur, dan perumahan dengan dukungan tim teknis handal.') }}</p>
                        <a href="{{ route('konstruksi') }}"
                           class="mt-auto block text-center bg-slate-800 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl text-sm transition-colors duration-300 border border-slate-700 hover:border-rose-700">
                            Konsultasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KEMITRAAN STRATEGIS & CTA (REDESIGNED & HIGH-CONTRAST) -->
   <div class="bg-slate-950 px-6 md:px-12 pt-12 pb-24 text-center border-t border-slate-900 relative overflow-hidden">
        <!-- Subtle Glow Background -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-rose-600/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <!-- High Contrast Tag Badge -->
            <span class="lp-scroll-rotate inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 backdrop-blur-md">
                {{ \App\Models\Setting::get('beranda_kemitraan_badge', 'DIPERCAYA BANYAK PIHAK') }}
            </span>
            <h2 class="lp-scroll text-3xl md:text-4xl font-extrabold text-white mb-4">{{ \App\Models\Setting::get('beranda_kemitraan_judul', 'Kemitraan Strategis') }}</h2>
            <p class="lp-scroll text-slate-300 text-base max-w-2xl mx-auto mb-12 leading-relaxed">
                {{ \App\Models\Setting::get('beranda_kemitraan_paragraf', 'Telah dipercaya oleh berbagai institusi pemerintah dan perusahaan swasta nasional dalam menyediakan solusi transportasi dan material konstruksi berkualitas tinggi.') }}
            </p>

            <!-- Social Proof Logos Showcase (Baru: Menyelesaikan visual yang sepi) -->
            <div class="lp-scroll grid grid-cols-2 md:grid-cols-4 gap-6 items-center justify-center opacity-60 mb-16">
                <div class="lp-scroll-zoom h-12 bg-slate-900/80 border border-slate-800 rounded-xl flex items-center justify-center text-slate-400 text-xs font-bold tracking-widest uppercase" style="--delay: 0ms;">{{ \App\Models\Setting::get('beranda_logo1', 'INSTITUSI PEMERINTAH') }}</div>
                <div class="lp-scroll-zoom h-12 bg-slate-900/80 border border-slate-800 rounded-xl flex items-center justify-center text-slate-400 text-xs font-bold tracking-widest uppercase" style="--delay: 100ms;">{{ \App\Models\Setting::get('beranda_logo2', 'BUMN KONTRAKTOR') }}</div>
                <div class="lp-scroll-zoom h-12 bg-slate-900/80 border border-slate-800 rounded-xl flex items-center justify-center text-slate-400 text-xs font-bold tracking-widest uppercase" style="--delay: 200ms;">{{ \App\Models\Setting::get('beranda_logo3', 'SWASTA NASIONAL') }}</div>
                <div class="lp-scroll-zoom h-12 bg-slate-900/80 border border-slate-800 rounded-xl flex items-center justify-center text-slate-400 text-xs font-bold tracking-widest uppercase" style="--delay: 300ms;">{{ \App\Models\Setting::get('beranda_logo4', 'PROYEK INFRASTRUKTUR') }}</div>
            </div>

            <!-- PREMIUM GLASSMORPHISM CTA CARD -->
            <div class="lp-scroll-zoom bg-gradient-to-br from-slate-900/90 to-slate-900/40 border border-slate-800 rounded-3xl p-8 md:p-12 backdrop-blur-xl shadow-2xl relative overflow-hidden text-center max-w-2xl mx-auto">
                <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-3">{{ \App\Models\Setting::get('beranda_cta_judul', 'Siap Membangun Bersama Kami?') }}</h3>
                <p class="text-slate-300 text-base mb-8 max-w-md mx-auto">{{ \App\Models\Setting::get('beranda_cta_paragraf', 'Konsultasikan kebutuhan konstruksi atau transportasi Anda dengan tim ahli kami sekarang juga.') }}</p>
                <a href="{{ route('kontak') }}" class="lp-motion-button lp-button-glow inline-flex items-center justify-center gap-2 bg-gradient-to-r from-rose-700 to-rose-600 hover:from-rose-600 hover:to-rose-500 text-white font-bold px-9 py-4 rounded-xl shadow-lg shadow-rose-950/50 transition-all duration-300 hover:scale-[1.03]">
                    Mulai Konsultasi
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>