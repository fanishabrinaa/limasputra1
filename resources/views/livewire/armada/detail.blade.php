<div class="py-10 px-6 md:px-12 max-w-7xl mx-auto space-y-12 bg-slate-50 min-h-screen animate-fade-in">

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
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2 tracking-tight">
                    {{ $armada->nama_bus }}
                </h1>
                <p class="text-slate-500 text-sm max-w-2xl leading-relaxed">
                    {{ \Illuminate\Support\Str::limit($armada->deskripsi, 120) }}
                </p>
            </div>
            <span class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold px-3.5 py-1.5 rounded-full self-start md:self-auto shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Armada Ready
            </span>
        </div>
    </section>

    {{-- 2️⃣ MAIN GRID --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT COLUMN (gambar + detail) --}}
        <div class="lg:col-span-2 space-y-10">

            @php
                $semuaGambar = array_filter(array_merge([$armada->gambar], $armada->galeri ?? []));
            @endphp

            {{-- IMAGE SLIDER (Alpine.js) --}}
            <div x-data="{ index:0, images: {{ Js::from($semuaGambar) }} }"
                 class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-200/80 bg-slate-950 group animate-fade-in-up">

                <template x-if="images.length > 0">
                    <img :src="'/storage/' + images[index]"
                         class="w-full h-80 md:h-[420px] object-cover opacity-95 transition-transform duration-700 group-hover:scale-105">
                </template>

                <template x-if="images.length === 0">
                    <div class="w-full h-80 md:h-[420px] bg-slate-900 flex items-center justify-center text-slate-500 text-sm">
                        Foto armada tidak tersedia
                    </div>
                </template>

                <template x-if="images.length > 1">
                    <div>
                        <button @click="index = index === 0 ? images.length - 1 : index - 1"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-slate-950/70 text-white w-11 h-11 rounded-2xl flex items-center justify-center backdrop-blur-md border border-slate-800 shadow-xl hover:scale-110 transition-transform">
                            ‹
                        </button>
                        <button @click="index = index === images.length - 1 ? 0 : index + 1"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-slate-950/70 text-white w-11 h-11 rounded-2xl flex items-center justify-center backdrop-blur-md border border-slate-800 shadow-xl hover:scale-110 transition-transform">
                            ›
                        </button>

                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 bg-slate-950/60 backdrop-blur-md px-3 py-1.5 rounded-full border border-slate-800">
                            <template x-for="(img,i) in images" :key="i">
                                <button @click="index = i"
                                        class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                                        :class="i===index ? 'bg-rose-500 w-6' : 'bg-white/40 hover:bg-white/80'"></button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            {{-- FASILITAS UTAMA --}}
            @if ($armada->fasilitas && $armada->fasilitas->count())
                <div class="animate-fade-in">
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                        Fasilitas Utama
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        {{-- Kapasitas Kursi --}}
                        <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">KAPASITAS</p>
                            <p class="text-sm font-extrabold text-slate-900">{{ $armada->kapasitas }} Kursi</p>
                        </div>

                        {{-- 3 fasilitas pertama --}}
                        @foreach ($armada->fasilitas->take(3) as $f)
                            <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors flex flex-col justify-between">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">FASILITAS</p>
                                <p class="text-sm font-extrabold text-slate-900 leading-tight">{{ $f->nama_fasilitas }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

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

            {{-- SELURUH FASILITAS --}}
            @if ($armada->fasilitas && $armada->fasilitas->count())
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm animate-fade-in-up">
                    <h2 class="text-xl font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                        Seluruh Fasilitas Unggulan
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($armada->fasilitas as $f)
                            <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 border border-slate-100/80 text-slate-800 text-sm font-semibold hover:bg-rose-50/50 transition-colors">
                                <span class="w-8 h-8 bg-rose-100 text-rose-700 rounded-xl flex items-center justify-center font-bold text-xs flex-shrink-0">✓</span>
                                <span>{{ $f->nama_fasilitas }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- RIGHT COLUMN (booking + testimoni) --}}
        <div class="lg:col-span-1 space-y-8">

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
            </div>

            {{-- TESTIMONI --}}
            @if ($testimoni && $testimoni->count())
                <div class="space-y-6 animate-fade-in-up">
                    <span class="text-[10px] text-rose-400 font-bold uppercase tracking-widest block px-1">
                        ULASAN PELANGGAN
                    </span>

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
            @endif
        </div>
    </section>
</div>