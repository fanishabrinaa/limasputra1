<div x-data="{
    lightboxOpen: false,
    current: 0,

    items: [],

    bukaLightbox(index) {
        this.items = Array.from(this.$root.querySelectorAll('[data-galeri]'))
            .map(el => JSON.parse(el.dataset.galeri));
        this.current = index;
        this.lightboxOpen = true;
    },

    prev() {
        this.current = (this.current - 1 + this.items.length) % this.items.length;
    },

    next() {
        this.current = (this.current + 1) % this.items.length;
    }
}"
    @keydown.escape.window="lightboxOpen = false"
    @keydown.arrow-left.window="if (lightboxOpen) prev()"
    @keydown.arrow-right.window="if (lightboxOpen) next()"
>

    <!-- HERO HEADER GALERI -->
    <div class="relative bg-slate-950 text-white py-10 md:py-20 px-6 md:px-12 text-center overflow-hidden border-b border-slate-900">

        <!-- Ambient Glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-rose-600/10 blur-[100px] rounded-full pointer-events-none"></div>

        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img
                src="{{ \App\Models\Setting::get('img_halaman_hero')
                    ? Storage::url(\App\Models\Setting::get('img_halaman_hero'))
                    : (\App\Models\Setting::get('img_unit_usaha_hero')
                        ? Storage::url(\App\Models\Setting::get('img_unit_usaha_hero'))
                        : 'https://images.unsplash.com/photo-1541888946425-d0fbb186a5b7?auto=format&fit=crop&q=80&w=1600') }}"
                alt="Unit Usaha Limas Putra"
                class="lp-hero-image w-full h-full object-cover opacity-60 scale-105"
            >

            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-950/70 to-slate-950"></div>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto">

            <span
                class="lp-scroll-rotate inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-5 backdrop-blur-md"
                style="--delay: 0ms;"
            >
                DOKUMENTASI KAMI
            </span>

            <h1
                class="lp-scroll text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight"
                style="--delay: 120ms;"
            >
                {!! preg_replace(
                    '/(Dokumentasi)/i',
                    '<span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">$1</span>',
                    e($galeri_judul)
                ) !!}
            </h1>

            <p
                class="lp-scroll text-slate-300 text-base max-w-xl mx-auto leading-relaxed"
                style="--delay: 220ms;"
            >
                {{ $galeri_deskripsi }}
            </p>

        </div>
    </div>


    <!-- MAIN CONTENT AREA -->
    <div class="bg-slate-50 px-6 md:px-12 py-8 md:py-16 min-h-screen">

        <div class="max-w-7xl mx-auto">

            <!-- FILTER CATEGORY TABS -->
            <div
                class="flex justify-center items-center gap-2 md:gap-3 mb-8 md:mb-12 flex-wrap"
                wire:loading.class="opacity-60 pointer-events-none"
                wire:target="setFilter"
            >

                @foreach (['Semua', 'Bus Pariwisata', 'Toko Bangunan', 'Konstruksi'] as $kat)

                    <button
                        wire:key="filter-{{ $kat }}"
                        wire:click="setFilter('{{ $kat }}')"
                        wire:loading.attr="disabled"
                        wire:target="setFilter"
                        class="lp-scroll px-5 py-2.5 rounded-full text-xs md:text-sm font-semibold transition-all duration-300 shadow-sm border
                            {{ $filterKategori === $kat
                                ? 'bg-rose-700 text-white border-rose-700 shadow-rose-900/20 scale-105'
                                : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-100 hover:text-slate-900' }}"
                        style="--delay: {{ $loop->index * 100 }}ms;"
                    >
                        {{ $kat }}
                    </button>

                @endforeach

            </div>


            <!-- GALLERY GRID -->
            <div
                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6"
                wire:key="galeri-grid-{{ $filterKategori }}"
            >

                @forelse ($daftarGaleri as $item)

                    <div
                        wire:key="galeri-{{ $filterKategori }}-{{ $item->id }}"
                        data-galeri="{{ json_encode([
                            'gambar'    => $item->gambar ? Storage::url($item->gambar) : null,
                            'judul'     => $item->judul,
                            'deskripsi' => $item->deskripsi,
                            'kategori'  => $item->kategori,
                        ]) }}"
                        class="lp-scroll-zoom lp-motion-card bg-white border border-slate-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-rose-200 hover:-translate-y-1 transition-all duration-300 flex flex-col group"
                        style="--delay: {{ $loop->index * 90 }}ms;"
                    >

                        <div
                            class="relative overflow-hidden bg-slate-950 h-32 sm:h-52 cursor-pointer"
                            @click="bukaLightbox({{ $loop->index }})"
                        >

                            @if ($item->gambar)

                                <img
                                    src="{{ Storage::url($item->gambar) }}"
                                    alt="{{ $item->judul }}"
                                    loading="lazy"
                                    class="lp-card-image w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90"
                                >

                            @else

                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">
                                    Tanpa Gambar
                                </div>

                            @endif


                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>


                            <!-- Badge Kategori -->
                            <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-slate-900/80 text-white text-[9px] sm:text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 sm:px-3 sm:py-1 rounded-full backdrop-blur-md">
                                {{ $item->kategori }}
                            </span>

                        </div>


                        <div class="p-3 sm:p-5 flex-1 flex flex-col justify-between">

                            <h3 class="font-bold text-sm sm:text-base text-slate-900 line-clamp-2 leading-snug group-hover:text-rose-700 transition-colors">
                                {{ $item->judul }}
                            </h3>

                            @if (!empty($item->deskripsi))

                                <p class="text-slate-500 text-xs mt-2 line-clamp-2 leading-relaxed">
                                    {{ $item->deskripsi }}
                                </p>

                            @endif

                        </div>

                    </div>

                @empty

                    <!-- EMPTY STATE -->
                    <div
                        wire:key="galeri-empty-{{ $filterKategori }}"
                        class="lp-scroll-zoom col-span-full bg-white border border-slate-200/80 rounded-3xl p-12 text-center max-w-lg mx-auto shadow-sm my-8"
                        style="--delay: 0ms;"
                    >

                        <div class="w-16 h-16 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 mb-1">
                            Belum Ada Foto
                        </h3>

                        <p class="text-sm text-slate-500">
                            Belum ada dokumentasi foto yang diunggah untuk kategori
                            <span class="font-bold text-slate-700">
                                "{{ $filterKategori }}"
                            </span>.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    <!-- LIGHTBOX MODAL -->
    <template x-teleport="body">

        <div
            x-show="lightboxOpen"
            x-cloak
            x-transition.opacity
            style="display:none; position:fixed; inset:0; z-index:100; height:100dvh;"
        >

            <!-- Latar gelap: klik di sini menutup -->
            <div
                @click="lightboxOpen = false"
                style="position:absolute; inset:0; background:rgba(2,6,23,.95);"
            ></div>


            <!-- Wadah tengah (tidak menangkap klik) -->
            <div
                style="
                    position:relative;
                    height:100%;
                    box-sizing:border-box;
                    padding:16px;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    pointer-events:none;
                "
            >

                <!-- Kartu -->
                <div
                    style="
                        pointer-events:auto;
                        width:100%;
                        max-width:560px;
                        max-height:calc(100dvh - 32px);
                        display:flex;
                        flex-direction:column;
                        background:#fff;
                        border-radius:18px;
                        overflow:hidden;
                        box-shadow:0 25px 50px rgba(0,0,0,.4);
                    "
                >

                    <!-- Area foto (bersih, tanpa tombol di atasnya) -->
                    <div
                        style="
                            flex-shrink:0;
                            height:min(45dvh, 400px);
                            background:#020617;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            overflow:hidden;
                        "
                    >
                        <template x-if="items[current] && items[current].gambar">
                            <img
                                :src="items[current].gambar"
                                :alt="items[current].judul"
                                style="width:100%; height:100%; object-fit:contain; display:block;"
                            >
                        </template>
                    </div>


                    <!-- Baris navigasi: panah kiri, posisi, panah kanan -->
                    <template x-if="items.length > 1">
                    <div
                        style="
                            flex-shrink:0;
                            display:flex;
                            align-items:center;
                            justify-content:space-between;
                            padding:10px 16px;
                            border-bottom:1px solid #f1f5f9;
                        "
                    >
                        <button
                            type="button"
                            @click="prev()"
                            aria-label="Foto sebelumnya"
                            style="width:36px; height:36px; border-radius:9999px; background:#f1f5f9; color:#334155; display:flex; align-items:center; justify-content:center; border:0; cursor:pointer;"
                        >
                            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <span style="font-size:12px; font-weight:600; color:#64748b;">
                            <span x-text="current + 1"></span> / <span x-text="items.length"></span>
                        </span>

                        <button
                            type="button"
                            @click="next()"
                            aria-label="Foto berikutnya"
                            style="width:36px; height:36px; border-radius:9999px; background:#f1f5f9; color:#334155; display:flex; align-items:center; justify-content:center; border:0; cursor:pointer;"
                        >
                            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                    </template>


                    <!-- Caption (bisa di-scroll kalau layar pendek) -->
                    <div style="padding:16px 20px; overflow-y:auto; min-height:0;">

                        <span
                            class="inline-block bg-rose-50 text-rose-700 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-2"
                            x-text="items[current] ? items[current].kategori : ''"
                        ></span>

                        <h3
                            class="text-lg font-bold text-slate-900 mb-1"
                            x-text="items[current] ? items[current].judul : ''"
                        ></h3>

                        <p
                            class="text-sm text-slate-500 leading-relaxed"
                            x-show="items[current] && items[current].deskripsi"
                            x-text="items[current] ? items[current].deskripsi : ''"
                        ></p>

                    </div>

                </div>

            </div>


            <!-- Tombol tutup -->
            <button
                type="button"
                @click="lightboxOpen = false"
                aria-label="Tutup"
                style="
                    position:absolute;
                    top:12px;
                    right:12px;
                    z-index:2;
                    width:40px;
                    height:40px;
                    border-radius:9999px;
                    background:rgba(255,255,255,.15);
                    color:#fff;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    border:0;
                    cursor:pointer;
                "
            >
                <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>

    </template>

</div>