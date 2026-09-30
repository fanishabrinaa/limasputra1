<div>
    @include('partials.tab-unit-usaha')

    <!-- 1. HERO SECTION -->
    <section class="relative bg-slate-950 overflow-hidden border-b border-slate-900">
        <img
            src="{{ \App\Models\Setting::get('img_bangunan_hero') ? Storage::url(\App\Models\Setting::get('img_bangunan_hero')) : 'https://images.unsplash.com/photo-1541976590-713941681591?w=1600' }}"
            class="absolute inset-0 w-full h-full object-cover opacity-10 pointer-events-none"
        >

        <!-- Ambient glow -->
        <div class="absolute top-0 right-0 w-[500px] h-[300px] bg-rose-600/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 px-6 md:px-12 py-16 md:py-20 grid grid-cols-1 md:grid-cols-2 gap-12 items-center max-w-7xl mx-auto">

            <!-- KIRI: TEXT -->
            <div>
                <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-bold px-4 py-1.5 rounded-full mb-5 backdrop-blur-md">
                    UNIT USAHA — RETAIL & MATERIAL
                </span>

                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight leading-tight">
                    Material Bangunan
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">
                        Berkualitas Premium
                    </span>
                </h1>

                <p class="text-slate-400 text-sm md:text-base mb-8 leading-relaxed max-w-lg">
                    Limas Putra menyediakan stok terlengkap untuk segala kebutuhan konstruksi Anda. Dari semen hingga baja ringan, kualitas premium untuk bangunan kokoh dan tahan lama.
                </p>

                <div class="flex flex-wrap gap-3">
                    <a
                        href="#katalog"
                        class="inline-flex items-center gap-2 bg-rose-700 hover:bg-rose-800 text-white font-bold px-6 py-3.5 rounded-xl shadow-lg shadow-rose-950/40 transition-all hover:scale-[1.02]"
                    >
                        <span>Lihat Katalog Produk</span>

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>

                    <a
                        href="{{ route('kontak') }}"
                        class="inline-flex items-center gap-2 border border-slate-700 text-slate-300 hover:text-white hover:border-slate-500 font-bold px-6 py-3.5 rounded-xl transition-all"
                    >
                        Hubungi Sales
                    </a>
                </div>
            </div>

            <!-- KANAN: STATS GRID -->
            <div class="grid grid-cols-2 gap-4">

                <div class="bg-white/5 backdrop-blur-md border border-slate-800 rounded-2xl p-6 hover:border-rose-700/40 transition-colors">
                    <p class="text-3xl font-black text-white mb-1">
                        24h
                    </p>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">
                        Pengiriman Cepat
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-md border border-slate-800 rounded-2xl p-6 hover:border-rose-700/40 transition-colors">
                    <p class="text-3xl font-black text-rose-400 mb-1">
                        100+
                    </p>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">
                        Produk Ready
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-md border border-slate-800 rounded-2xl p-6 hover:border-rose-700/40 transition-colors">
                    <p class="text-3xl font-black text-rose-400 mb-1">
                        10+
                    </p>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">
                        Proyek Sukses
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-md border border-slate-800 rounded-2xl p-6 hover:border-rose-700/40 transition-colors">
                    <p class="text-3xl font-black text-white mb-1">
                        TOP
                    </p>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">
                        Kualitas Terjamin
                    </p>
                </div>

            </div>
        </div>
    </section>


        <!-- 2. FILTER KATEGORI -->
    <style>
        .lp-chip-row {
            display: flex; align-items: center; gap: .5rem;
            flex-wrap: nowrap; overflow-x: auto;
            padding: 6px 4px;
            scrollbar-width: none; -webkit-overflow-scrolling: touch;
        }
        .lp-chip-row::-webkit-scrollbar { display: none; }
        .lp-chip-row > * { flex-shrink: 0; white-space: nowrap; }

        .lp-filter-bar { position: static; }

        @media (min-width: 768px) {
            .lp-chip-row { flex-wrap: wrap; overflow-x: visible; }
            .lp-filter-bar { position: sticky; top: 69px; }
        }
    </style>

    <section
        id="katalog"
        class="lp-filter-bar bg-white border-b border-slate-100 px-6 md:px-12 py-4 z-30 shadow-sm"
    >
        <div class="max-w-7xl mx-auto lp-chip-row">

            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mr-2 hidden md:block">
                Filter:
            </span>

            @foreach ($kategoriList as $kategori)
                <button
                    wire:key="filter-{{ $kategori }}"
                    wire:click="setKategori('{{ $kategori }}')"
                    class="px-4 py-2 rounded-full text-xs font-bold border transition-all duration-200
                        {{ $kategoriAktif === $kategori
                            ? 'bg-rose-700 text-white border-rose-700 shadow-md shadow-rose-950/20 scale-105'
                            : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100 hover:border-slate-300' }}"
                >
                    {{ $kategori }}
                </button>
            @endforeach

        </div>
    </section>

    <!-- 3. GRID PRODUK -->
    <section class="bg-slate-50 px-6 md:px-12 py-12">

        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse ($daftarProduk as $item)

                    <!-- CARD PRODUK -->
                    <div
                        wire:key="produk-{{ $item->id }}"
                        onclick="window.location.href='{{ route('produk.detail', $item->id) }}'"
                        class="lp-scroll-zoom lp-motion-card bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:border-rose-200 hover:-translate-y-1 transition-all duration-300 flex flex-col group cursor-pointer"
                    >

                        <!-- GAMBAR PRODUK -->
                        <div class="relative overflow-hidden bg-slate-950 h-48">

                            @if ($item->gambar)

                                <img
                                    src="{{ Storage::url($item->gambar) }}"
                                    class="lp-content-image w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-95"
                                >

                            @else

                                <div class="w-full h-full flex items-center justify-center text-slate-500 text-xs">
                                    Foto Produk
                                </div>

                            @endif


                            @if ($item->badge)

                                <span class="absolute top-3 left-3 {{ $item->badge === 'PREMIUM' ? 'bg-slate-900/90' : 'bg-rose-700' }} text-white text-[10px] font-bold px-2.5 py-1 rounded-full backdrop-blur-md">
                                    {{ $item->badge }}
                                </span>

                            @endif


                            @if ($item->kategori)

                                <span class="absolute top-3 right-3 bg-white/90 text-slate-700 text-[10px] font-bold px-2.5 py-1 rounded-full backdrop-blur-md">
                                    {{ $item->kategori }}
                                </span>

                            @endif

                        </div>


                        <!-- DETAIL PRODUK -->
                        <div class="p-5 flex-1 flex flex-col justify-between">

                            <div class="mb-4">

                                <h3 class="font-extrabold text-slate-900 text-sm leading-snug mb-1 group-hover:text-rose-700 transition-colors">
                                    {{ $item->nama_produk }}
                                </h3>

                                <p class="text-[11px] text-slate-400 font-medium">
                                    per {{ $item->satuan }}
                                </p>

                                <span class="inline-block mt-3 text-[11px] font-bold text-rose-700">
                                    Lihat Detail →
                                </span>

                            </div>


                            <!-- TOMBOL WHATSAPP -->
                            <div class="pt-4 border-t border-slate-100">

                                <a
                                    href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_marketing', '6281234567890') }}?text={{ urlencode('Halo, saya tertarik dengan produk ' . $item->nama_produk) }}"
                                    target="_blank"
                                    onclick="event.stopPropagation();"
                                    class="flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold py-2.5 rounded-lg transition-colors"
                                >

                                    <svg
                                        class="w-4 h-4"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                    </svg>

                                    <span>
                                        Tanya via WhatsApp
                                    </span>

                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <!-- PRODUK KOSONG -->
                    <div
                        wire:key="produk-kosong"
                        class="col-span-full bg-white border border-slate-200/80 rounded-3xl p-12 text-center"
                    >


                        <h3 class="text-base font-bold text-slate-800">
                            Belum Ada Produk
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Produk untuk kategori ini belum tersedia saat ini.
                        </p>

                    </div>

                @endforelse


                <!-- CARD LAYANAN SEWA ALAT BERAT -->
                <div
                    wire:key="card-layanan-sewa"
                    class="lp-scroll-zoom lp-motion-card bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 border border-slate-800 rounded-3xl p-7 flex flex-col justify-between shadow-xl relative overflow-hidden group"
                >

                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-rose-600/10 blur-2xl rounded-full pointer-events-none"></div>

                    <div class="relative z-10">

                        <span class="inline-block bg-rose-700 text-white text-[10px] font-bold px-2.5 py-1 rounded-full mb-4">
                            LAYANAN SEWA
                        </span>

                        <h3 class="text-white font-extrabold text-lg mb-2 leading-snug">
                            Butuh Alat Berat?
                        </h3>

                        <p class="text-slate-400 text-xs leading-relaxed">
                            Sewa Crane, Excavator, dan Truk Molen untuk proyek skala besar dengan harga kompetitif.
                        </p>

                    </div>


                    <a
                        href="{{ route('kontak') }}"
                        class="lp-motion-button relative z-10 mt-6 inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-rose-700 border border-slate-700 hover:border-rose-700 text-white text-xs font-bold px-4 py-3 rounded-xl transition-all duration-300"
                    >
                        <span>
                            Hubungi Logistik
                        </span>

                        <span>
                            →
                        </span>
                    </a>

                </div>

            </div>
        </div>
    </section>


    <!-- 4. CTA BANNER -->
    <section class="px-6 md:px-12 py-16 bg-slate-50">

        <div class="max-w-7xl mx-auto">

            <div class="relative bg-slate-950 rounded-3xl px-8 md:px-12 py-12 flex flex-col md:flex-row justify-between items-center gap-8 overflow-hidden shadow-xl border border-slate-900">

                <!-- Glow -->
                <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[300px] h-[200px] bg-rose-600/10 blur-[100px] rounded-full pointer-events-none"></div>


                <div class="relative z-10">

                    <span class="text-rose-400 text-xs font-bold uppercase tracking-widest block mb-2">
                        PENGADAAN PROYEK SKALA BESAR
                    </span>

                    <h3 class="text-white text-2xl md:text-3xl font-extrabold mb-2">
                        Proyek Besar? Hubungi Sales Kami.
                    </h3>

                    <p class="text-slate-400 text-sm max-w-lg">
                        Dapatkan harga grosir dan jadwal pengiriman prioritas untuk pengadaan material proyek konstruksi Anda.
                    </p>

                </div>


                <div class="relative z-10 flex flex-col sm:flex-row gap-3 w-full md:w-auto flex-shrink-0">

                    <a
                        href="https://wa.me/6281234567890"
                        target="_blank"
                        class="inline-flex items-center justify-center gap-2 bg-white text-slate-900 font-bold px-6 py-3.5 rounded-xl text-sm hover:bg-slate-100 transition whitespace-nowrap"
                    >
                        WhatsApp Sales
                    </a>

                    <a
                        href="{{ route('kontak') }}"
                        class="inline-flex items-center justify-center gap-2 bg-rose-700 hover:bg-rose-800 text-white font-bold px-6 py-3.5 rounded-xl text-sm transition whitespace-nowrap shadow-lg shadow-rose-950/40"
                    >
                        Minta Penawaran →
                    </a>

                </div>

            </div>

        </div>
    </section>

</div>