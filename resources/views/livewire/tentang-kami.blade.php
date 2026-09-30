<div>
<?php
$img = fn($key, $fallback) => \App\Models\Setting::get($key)
    ? Storage::url(\App\Models\Setting::get($key))
    : $fallback;

// $leaders & $values dikirim dari TentangKami.php (baca dari dashboard) - JANGAN ditimpa di sini.
// Cuma nempelin foto per pemimpin berdasarkan urutan slot gambar di dashboard "Kelola Gambar".
$leaders = collect($leaders)->values()->map(function ($leader, $i) use ($img) {
    $leader['image'] = $img('img_leader_' . ($i + 1), 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=300');
    return $leader;
})->all();

$units = [
    [
        'title' => 'Bus Pariwisata',
        'desc' => 'Armada bus modern dan nyaman untuk perjalanan wisata maupun perjalanan dinas perusahaan.',
        'link_text' => 'Lihat Unit Bus &rarr;',
        'link' => route('armada.katalog'),
        'image' => $img('img_unit_bus', 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=600')
    ],
    [
        'title' => 'Toko Bahan Bangunan',
        'desc' => 'Menyediakan bahan bangunan berkualitas tinggi untuk kebutuhan proyek skala kecil hingga besar.',
        'link_text' => 'Lihat Bahan Bangunan &rarr;',
        'link' => route('produk.publik'),
        'image' => $img('img_unit_bangunan', 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&q=80&w=600')
    ],
    [
        'title' => 'Jasa Konstruksi',
        'desc' => 'Layanan pemborong & kontraktor profesional untuk pembangunan struktur, gedung, dan infrastruktur.',
        'link_text' => 'Lihat Jasa Konstruksi &rarr;',
        'link' => route('kontak'),
        'image' => $img('img_unit_konstruksi', 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=600')
    ]
];
?>
<!-- 1. HERO HEADER SECTION -->
<section class="relative bg-slate-950 text-white py-16 md:py-20 text-center overflow-hidden flex items-center justify-center border-b border-slate-900">

    <div class="absolute inset-0 z-0">
        @php
            $hero = \App\Models\Setting::get('img_halaman_hero', \App\Models\Setting::get('img_unit_usaha_hero'));
        @endphp

        @if ($hero)
            <img src="{{ Storage::url($hero) }}"
                 class="lp-hero-image w-full h-full object-cover opacity-60 scale-105 transition-transform duration-1000">
        @endif

        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-950/70 to-slate-950"></div>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto px-6">
            <span class="lp-scroll-rotate inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-3.5 py-1 rounded-full mb-4 backdrop-blur-md" style="--delay: 0ms;">
                TENTANG PERUSAHAAN
            </span>
            <h1 class="lp-scroll text-3xl md:text-5xl font-extrabold mb-3 tracking-tight" style="--delay: 120ms;">
                Mengenal <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">Lebih Dekat</span>
            </h1>
            <p class="lp-scroll text-sm md:text-base text-slate-300 max-w-xl mx-auto leading-relaxed font-normal" style="--delay: 240ms;">
                {{ $hero_desc }}
            </p>
        </div>
    </section>

    <!-- 2. SEJARAH & DEDIKASI -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="lp-scroll-right" style="--delay: 0ms;">
                    <span class="text-rose-700 text-xs font-bold tracking-widest uppercase mb-3 block">SEJARAH KAMI</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 leading-tight">
                        Dedikasi Puluhan Tahun dalam Membangun Negeri
                    </h2>
                    <p class="text-slate-600 mb-5 leading-relaxed text-base">
                        {{ $sejarah_1 }}
                    </p>
                    <p class="text-slate-600 leading-relaxed text-base">
                        {{ $sejarah_2 }}
                    </p>
                </div>
                <div class="relative lp-scroll-left" style="--delay: 150ms;">
                    <div class="lp-motion-card rounded-2xl overflow-hidden shadow-2xl border border-slate-100">
                        <img src="{{ $img('img_tentang_sejarah', 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800') }}" 
                            alt="Kantor Limas Putra" 
                            class="w-full object-cover h-96 hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-rose-700 text-white p-6 rounded-2xl shadow-xl shadow-rose-950/30 text-center border-4 border-white">
                        <div class="text-4xl font-black mb-0.5">20+</div>
                        <div class="text-xs text-rose-100 font-bold uppercase tracking-wider">Tahun Pengalaman</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. MILESTONE PERJALANAN KAMI -->
    <section class="pt-14 sm:pt-20 pb-6 sm:pb-10 bg-slate-50 border-y border-slate-100">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16 lp-scroll" style="--delay: 0ms;">
                <span class="text-rose-700 text-xs font-bold tracking-widest uppercase mb-2 block">REKAM JEJAK</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Milestone Perjalanan Kami</h2>
            </div>

            <div class="relative border-l-2 border-rose-600/80 mx-auto max-w-2xl ml-4 md:ml-auto space-y-8">
                @foreach($milestones as $index => $item)
                    <div class="ml-8 relative group lp-scroll-zoom" style="--delay: {{ $index * 100 }}ms;">
                        <span class="absolute -left-[41px] top-1.5 w-5 h-5 rounded-full {{ $index % 2 === 0 ? 'bg-rose-600 ring-4 ring-rose-100' : 'bg-slate-900 ring-4 ring-slate-200' }} transition-transform group-hover:scale-125 duration-300"></span>

                        <div class="lp-motion-card bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 hover:shadow-md hover:border-rose-200 transition-all duration-300">
                            <span class="text-rose-700 font-extrabold text-lg mb-2 block">{{ $item['year'] }}</span>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

               <!-- 4. LEADERSHIP / MANAJEMEN -->
        <section class="pt-14 sm:pt-20 pb-14 sm:pb-20 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-14 lp-scroll" style="--delay: 0ms;">
                    <span class="text-rose-700 text-xs font-bold tracking-widest uppercase mb-2 block">MANAJEMEN</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Kepemimpinan</h2>
                </div>

                @foreach($leaders as $leader)
                    <div class="lp-motion-card lp-scroll-zoom max-w-4xl mx-auto bg-slate-50 rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden grid grid-cols-1 sm:grid-cols-5 group" style="--delay: {{ $loop->index * 120 }}ms;">
                        <div class="sm:col-span-2 relative h-72 sm:h-full overflow-hidden">
                            <img src="{{ $leader['image'] }}"
                                alt="{{ $leader['name'] }}"
                                class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="sm:col-span-3 p-8 sm:p-10 flex flex-col justify-center text-center sm:text-left">
                            <span class="inline-block w-fit mx-auto sm:mx-0 text-xs font-bold text-rose-700 bg-rose-100 border border-rose-200 px-3 py-1 rounded-full mb-4">
                                {{ $leader['role'] }}
                            </span>
                            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-4">{{ $leader['name'] }}</h3>
                            <p class="text-sm sm:text-base text-slate-600 leading-relaxed">{{ $leader['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
            <!-- 5. VISI & MISI -->
        <section class="py-14 sm:py-24 bg-slate-950 text-white relative overflow-hidden">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] bg-rose-600/10 blur-[120px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-14 lp-scroll" style="--delay: 0ms;">
                    <span class="text-rose-400 text-xs font-bold tracking-widest uppercase mb-2 block">ARAH & TUJUAN</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white">Visi & Misi Perusahaan</h2>
                </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-8">
                        <div class="lp-motion-card lp-scroll-zoom bg-gradient-to-br from-slate-900 to-slate-900/50 p-6 sm:p-8 md:p-10 rounded-2xl sm:rounded-3xl border border-slate-800 backdrop-blur-xl shadow-2xl" style="--delay: 120ms;">
                        <h3 class="text-lg sm:text-2xl font-bold text-white mb-2 sm:mb-4">Visi Kami</h3>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            Menjadi perusahaan pilihan utama berbasis solusi terpadu di Indonesia, menghubungkan kebutuhan transportasi, pembangunan, dan infrastruktur secara tepercaya dan berkelanjutan.
                        </p>
                    </div>

                    <div class="lp-motion-card lp-scroll-zoom bg-gradient-to-br from-slate-900 to-slate-900/50 p-6 sm:p-8 md:p-10 rounded-2xl sm:rounded-3xl border border-slate-800 backdrop-blur-xl shadow-2xl" style="--delay: 240ms;">
                        <h3 class="text-lg sm:text-2xl font-bold text-white mb-2 sm:mb-4">Misi Kami</h3>
                        <ul class="text-slate-300 text-xs sm:text-sm space-y-3 sm:space-y-4 leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-rose-500 mt-2 flex-shrink-0"></span>
                                <span>Memberikan layanan transportasi aman, nyaman, dan tepat waktu bagi seluruh pelanggan nasional.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-rose-500 mt-2 flex-shrink-0"></span>
                                <span>Menyediakan material bangunan berkualitas tinggi dengan harga kompetitif untuk mendukung konstruksi.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-rose-500 mt-2 flex-shrink-0"></span>
                                <span>Mengembangkan sumber daya manusia yang profesional dan adopsi teknologi tepat guna.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
            <!-- 6. NILAI-NILAI UTAMA (VALUES) -->
        <section class="pt-14 sm:pt-20 pb-6 sm:pb-10 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-14 lp-scroll" style="--delay: 0ms;">
                    <span class="text-rose-700 text-xs font-bold tracking-widest uppercase mb-2 block">PRINSIP UTAMA</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-3">Nilai-Nilai Utama</h2>
                    <p class="text-slate-500 text-sm sm:text-base max-w-xl mx-auto">Prinsip yang mengarahkan setiap keputusan dan tindakan kami dalam melayani Anda.</p>
                </div>

                <div class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-4 -mx-6 px-6 md:mx-0 md:px-0 md:grid md:grid-cols-3 md:gap-8 md:overflow-visible [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @foreach($values as $val)
                        <div class="lp-motion-card lp-scroll-zoom flex-shrink-0 w-64 snap-start md:w-auto p-6 sm:p-8 bg-slate-50 hover:bg-white rounded-2xl border border-slate-200/80 text-center hover:shadow-xl hover:border-rose-200 transition-all duration-300 group" style="--delay: {{ $loop->index * 120 }}ms;">
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2 sm:mb-3">{{ $val['title'] }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $val['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    <!-- 7. UNIT USAHA TERINTEGRASI -->
    <section class="pt-6 sm:pt-10 pb-14 sm:pb-20 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-12 lp-scroll" style="--delay: 0ms;">
                <span class="text-rose-700 text-xs font-bold tracking-widest uppercase mb-2 block">EKOSISTEM BISNIS</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Unit Usaha Terintegrasi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($units as $unit)
                    <div class="lp-motion-card lp-scroll-zoom relative rounded-2xl overflow-hidden group shadow-lg h-80 flex flex-col justify-end p-7 text-white" style="--delay: {{ $loop->index * 140 }}ms;">
                        <img src="{{ $unit['image'] }}" 
                             alt="{{ $unit['title'] }}" 
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>

                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-2">{{ $unit['title'] }}</h3>
                            <p class="text-sm text-slate-300 mb-4 line-clamp-2 leading-relaxed">{{ $unit['desc'] }}</p>
                            <a href="{{ $unit['link'] }}" class="inline-flex items-center gap-2 text-sm font-bold text-rose-400 hover:text-rose-300 transition-colors">
                                {!! $unit['link_text'] !!}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 8. LAYANAN BANTUAN CTA BANNER -->
    <section class="pt-10 sm:pt-16 pb-16 sm:pb-20 bg-rose-50 text-center border-t border-rose-100">
        <div class="max-w-3xl mx-auto px-6 lp-scroll" style="--delay: 0ms;">
            <h2 class="text-2xl font-extrabold text-slate-900 mb-3">Punya Pertanyaan atau Butuh Solusi?</h2>
            <p class="text-slate-600 text-base mb-8 leading-relaxed">
                Tim profesional kami siap membantu menjawab pertanyaan Anda mengenai layanan armada bus, kebutuhan bahan bangunan, maupun konsultasi proyek konstruksi.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('kontak') }}" class="lp-motion-button bg-rose-700 hover:bg-rose-800 text-white text-sm font-semibold px-6 py-3.5 rounded-xl shadow-md transition-all duration-300 hover:scale-[1.02]">
                    Layanan Pelanggan
                </a>
                <a href="{{ route('kontak') }}" class="bg-white border border-rose-300 text-rose-800 text-sm font-semibold px-6 py-3.5 rounded-xl hover:bg-rose-100 transition-colors">
                    Lokasi Kantor Kami
                </a>
                <a href="{{ route('kontak') }}" class="bg-white border border-rose-300 text-rose-800 text-sm font-semibold px-6 py-3.5 rounded-xl hover:bg-rose-100 transition-colors">
                    Hubungi Tim Sales
                </a>
            </div>
        </div>
    </section>
</div>