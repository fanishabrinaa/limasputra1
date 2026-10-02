<div class="py-6 px-6 md:px-12 max-w-7xl mx-auto space-y-8 bg-slate-50 min-h-screen animate-fade-in">

    {{-- 1️⃣ BREADCRUMB & HEADER --}}
    <section class="animate-fade-in-up">

        {{-- TOMBOL KEMBALI --}}
        <button
            type="button"
            onclick="if (document.referrer && document.referrer.includes(window.location.host)) { history.back(); } else { window.location.href = '{{ route('armada.katalog') }}'; }"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-rose-700 mb-4 transition-colors"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </button>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

            {{-- Judul & subjudul --}}
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2 tracking-tight">
                    {{ $armada->nama_bus }}
                </h1>
                <p class="text-slate-500 text-sm">
                    Bus Pariwisata · {{ $armada->kapasitas }} Kursi
                </p>
                <p class="text-slate-500 text-sm mt-1 max-w-2xl leading-relaxed">
                    Cocok untuk wisata keluarga, rombongan kantor, studi tur, dan acara instansi.
                </p>
            </div>

            {{-- Tombol bagikan + badge status --}}
            <div class="flex flex-wrap items-center gap-3 self-start md:self-auto"
                 x-data="{
                    copied: false,
                    async copy() {
                        const url = window.location.href;
                        try {
                            await navigator.clipboard.writeText(url);
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        } catch (e) {
                            window.prompt('Salin link ini:', url);
                        }
                    }
                 }">

                {{-- Salin link --}}
                <button type="button" @click="copy()"
                        class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:border-rose-300 hover:text-rose-700 text-slate-600 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8a2 2 0 012 2v10a2 2 0 01-2 2H8a2 2 0 01-2-2V9a2 2 0 012-2zm0 0V5a2 2 0 012-2h4a2 2 0 012 2v2"/>
                    </svg>
                    <span x-text="copied ? 'Link tersalin ✓' : 'Salin Link'">Salin Link</span>
                </button>

                {{-- Kirim ke WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode('Lihat bus ' . $armada->nama_bus . ' dari Putra Limas: ' . url()->current()) }}"
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:border-emerald-400 hover:text-emerald-700 text-slate-600 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm transition-colors">
                    Kirim ke WA
                </a>

                {{-- Badge status (dinamis) --}}
                @if ($armada->status === 'tersedia')
                    <span class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Armada Ready
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 bg-slate-100 border border-slate-200 text-slate-600 text-xs font-bold px-3.5 py-1.5 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        Sedang Tidak Tersedia
                    </span>
                @endif
            </div>
        </div>
    </section>

    {{-- 2️⃣ MAIN GRID --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT COLUMN (gambar + detail) --}}
        <div class="lg:col-span-2 space-y-10">

            @php
                $semuaGambar = array_values(array_filter(array_merge([$armada->gambar], $armada->galeri ?? [])));
            @endphp

            {{-- IMAGE SLIDER (Alpine.js) --}}
            <div x-data="{ index:0, images: {{ Js::from($semuaGambar) }} }"
                 class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-200/80 bg-slate-950 group animate-fade-in-up">

                <template x-if="images.length > 0">
                    <img :src="'/storage/' + images[index]"
                         alt="{{ $armada->nama_bus }}"
                         class="w-full h-80 md:h-[420px] object-cover opacity-95 transition-transform duration-700 group-hover:scale-105">
                </template>

                <template x-if="images.length === 0">
                    <div class="w-full h-80 md:h-[420px] bg-slate-900 flex items-center justify-center text-slate-500 text-sm">
                        Foto armada tidak tersedia
                    </div>
                </template>

                <template x-if="images.length > 1">
                    <div>
                        <button type="button" aria-label="Foto sebelumnya"
                                @click="index = index === 0 ? images.length - 1 : index - 1"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 text-slate-800 w-11 h-11 rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button type="button" aria-label="Foto berikutnya"
                                @click="index = index === images.length - 1 ? 0 : index + 1"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 text-slate-800 w-11 h-11 rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 bg-slate-950/60 backdrop-blur-md px-3 py-2 rounded-full border border-slate-800">
                            <template x-for="(img,i) in images" :key="i">
                                <button type="button" :aria-label="'Foto ' + (i + 1)"
                                        @click="index = i"
                                        class="h-3 rounded-full transition-all duration-300"
                                        :class="i===index ? 'bg-rose-500 w-7' : 'bg-white/50 hover:bg-white w-3'"></button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            {{-- FASILITAS (gabungan) --}}
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm animate-fade-in-up">
                <h2 class="text-xl font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                    Fasilitas
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @forelse ($armada->fasilitas ?? [] as $f)
                        <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 border border-slate-100/80 text-slate-800 text-sm font-semibold hover:bg-rose-50/50 transition-colors">
                            <span class="w-8 h-8 bg-rose-100 text-rose-700 rounded-xl flex items-center justify-center font-bold text-xs flex-shrink-0">✓</span>
                            <span>{{ $f->nama_fasilitas }}</span>
                        </div>
                    @empty
                        <p class="col-span-full text-sm text-slate-500">Informasi fasilitas belum tersedia.</p>
                    @endforelse
                </div>
            </div>

            {{-- DESKRIPSI ARMADA --}}
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm animate-fade-in-up">
                <h2 class="text-xl font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                    Deskripsi Armada
                </h2>
                <p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line">
                    {{ $armada->deskripsi }}
                </p>
            </div>

        </div>{{-- /LEFT COLUMN --}}

        {{-- RIGHT COLUMN --}}
        <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-24 lg:self-start">

            {{-- BOOKING CTA --}}
            <div class="bg-white border border-slate-200/80 rounded-3xl p-7 shadow-sm text-center space-y-4 animate-fade-in-up">
                <h3 class="text-xl font-extrabold text-slate-900">Tertarik Sewa Bus Ini?</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Konsultasikan rujukan rute, cek ketersediaan tanggal, dan dapatkan penawaran harga sewa terbaik dari tim CS kami.
                </p>

                @auth
                    <a href="{{ route('pemesanan.create', $armada->id) }}"
                       class="block w-full bg-rose-700 hover:bg-rose-800 text-white font-semibold py-3 rounded-lg transition-colors">
                        Booking Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="block w-full bg-rose-700 hover:bg-rose-800 text-white font-semibold py-3 rounded-lg transition-colors">
                        Login untuk Booking
                    </a>
                @endauth

                {{-- Tombol sekunder WhatsApp --}}
                @php
                    // GANTI dengan nomor CS asli: format 62812..., tanpa "+" dan tanpa 0 di depan
                    $waNumber = '628xxxxxxxxxx';
                @endphp
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo, saya tertarik menyewa bus ' . $armada->nama_bus . '. Boleh tanya ketersediaan & harga?') }}"
                   target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 w-full border-2 border-emerald-500 text-emerald-700 hover:bg-emerald-50 font-semibold py-2.5 rounded-lg transition-colors text-sm">
                    Tanya via WhatsApp
                </a>
            </div>

            {{-- CARA SEWA --}}
            <div class="bg-white border border-slate-200/80 rounded-3xl p-7 shadow-sm animate-fade-in-up">
                <h3 class="text-sm font-extrabold text-slate-900 mb-4">Cara Sewa</h3>
                <ol class="space-y-4">
                    @foreach ([
                        ['Konsultasi', 'Hubungi CS, ceritakan tujuan dan tanggal perjalanan.'],
                        ['Konfirmasi & DP', 'Setujui penawaran harga dan bayar DP.'],
                        ['Bus Berangkat', 'Armada siap menjemput sesuai jadwal.'],
                    ] as $i => [$judul, $isi])
                        <li class="flex gap-3">
                            <span class="w-7 h-7 flex-shrink-0 rounded-full bg-rose-100 text-rose-700 text-xs font-bold flex items-center justify-center">{{ $i + 1 }}</span>
                            <div>
                                <p class="text-sm font-bold text-slate-800 leading-tight">{{ $judul }}</p>
                                <p class="text-xs text-slate-500 leading-relaxed mt-0.5">{{ $isi }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

        </div>{{-- /RIGHT COLUMN --}}
    </section>

    {{-- 3️⃣ UNIT LAINNYA --}}
    @if ($armadaLain->count())
        <section class="animate-fade-in-up">
            <div class="flex items-end justify-between mb-5">
                <h2 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                    <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                    Unit Lainnya
                </h2>
                <a href="{{ route('armada.katalog') }}"
                   class="text-sm font-semibold text-rose-700 hover:text-rose-800 transition-colors">
                    Lihat semua →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($armadaLain as $lain)
                    <a href="{{ url('/armada/' . $lain->id) }}"
                       wire:key="lain-{{ $lain->id }}"
                       class="group bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg hover:border-rose-200 transition-all">

                        <div class="h-44 bg-slate-900 overflow-hidden">
                            @if ($lain->gambar)
                                <img src="{{ asset('storage/' . $lain->gambar) }}"
                                     alt="{{ $lain->nama_bus }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-500 text-xs">
                                    Foto tidak tersedia
                                </div>
                            @endif
                        </div>

                        <div class="p-5 space-y-3">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-lg font-extrabold text-slate-900 leading-tight">{{ $lain->nama_bus }}</h3>
                                <span class="text-xs font-bold text-rose-700 bg-rose-50 px-2.5 py-1 rounded-full whitespace-nowrap">
                                    {{ $lain->kapasitas }} Kursi
                                </span>
                            </div>

                            @if ($lain->fasilitas && $lain->fasilitas->count())
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($lain->fasilitas->take(3) as $f)
                                        <span class="text-[11px] font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded-lg">
                                            {{ $f->nama_fasilitas }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <p class="text-sm font-semibold text-rose-700 group-hover:underline">Lihat detail →</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- 4️⃣ TESTIMONI (tampil hanya jika ada data) --}}
    @if ($testimoni && $testimoni->count())
        <section class="animate-fade-in-up">
            <span class="text-[10px] text-rose-500 font-bold uppercase tracking-widest block px-1 mb-4">
                Ulasan Pelanggan
            </span>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($testimoni as $t)
                    <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 border border-slate-800 rounded-3xl p-7 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-rose-600/10 blur-xl rounded-full"></div>

                        <div class="relative z-10">
                            <div class="text-amber-400 text-lg mb-3 tracking-widest">
                                {{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}
                            </div>
                            <p class="italic text-slate-300 text-xs leading-relaxed mb-5">
                                “{{ $t->pesan }}”
                            </p>
                            <div class="pt-4 border-t border-slate-800/80">
                                <p class="font-bold text-sm text-white">{{ $t->nama }}</p>
                                <p class="text-xs text-slate-400 font-medium">
                                    {{ $t->jabatan }}{{ $t->perusahaan ? ', '.$t->perusahaan : '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

</div>