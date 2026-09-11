<div class="py-10 px-6 md:px-12 max-w-7xl mx-auto space-y-8 bg-slate-50 min-h-screen">
    
    <!-- 1. BREADCRUMB & HEADER -->
    <div>
        <nav class="text-xs text-slate-500 mb-3 flex items-center gap-2 font-medium">
            <a href="{{ route('armada.katalog') }}" class="hover:text-rose-700 transition">Unit Usaha</a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('armada.katalog') }}" class="hover:text-rose-700 transition">Bus Pariwisata</a>
            <span class="text-slate-300">/</span>
            <span class="font-bold text-rose-700">{{ $armada->nama_bus }}</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2 tracking-tight">{{ $armada->nama_bus }}</h1>
                <p class="text-slate-500 text-sm max-w-2xl leading-relaxed">{{ \Illuminate\Support\Str::limit($armada->deskripsi, 120) }}</p>
            </div>
            <span class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold px-3.5 py-1.5 rounded-full self-start md:self-auto shadow-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Armada Ready
            </span>
        </div>
    </div>

    <!-- 2. MAIN CONTENT GRID SPLIT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- LEFT COLUMN: GAMBAR & SPESIFIKASI -->
        <div class="lg:col-span-2 space-y-8">
            
            @php
                $semuaGambar = array_filter(array_merge([$armada->gambar], $armada->galeri ?? []));
            @endphp

            <!-- ALPINE.JS IMAGE SLIDER GALLERY -->
            <div x-data="{ index: 0, images: {{ Js::from($semuaGambar) }} }" class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-200/80 bg-slate-950 group">
                <template x-if="images.length > 0">
                    <img :src="'/storage/' + images[index]" class="w-full h-80 md:h-[420px] object-cover opacity-95 group-hover:scale-105 transition-transform duration-700">
                </template>

                <template x-if="images.length === 0">
                    <div class="w-full h-80 md:h-[420px] bg-slate-900 flex items-center justify-center text-slate-500 text-sm">
                        Foto armada tidak tersedia
                    </div>
                </template>

                <template x-if="images.length > 1">
                    <div>
                        <button @click="index = index === 0 ? images.length - 1 : index - 1"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-slate-950/70 hover:bg-slate-950 text-white w-11 h-11 rounded-2xl flex items-center justify-center backdrop-blur-md border border-slate-800 shadow-xl transition-transform hover:scale-110">
                            ‹
                        </button>
                        <button @click="index = index === images.length - 1 ? 0 : index + 1"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-slate-950/70 hover:bg-slate-950 text-white w-11 h-11 rounded-2xl flex items-center justify-center backdrop-blur-md border border-slate-800 shadow-xl transition-transform hover:scale-110">
                            ›
                        </button>
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 bg-slate-950/60 backdrop-blur-md px-3 py-1.5 rounded-full border border-slate-800">
                            <template x-for="(img, i) in images" :key="i">
                                <button @click="index = i"
                                        class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                                        :class="i === index ? 'bg-rose-500 w-6' : 'bg-white/40 hover:bg-white/80'"></button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- FASILITAS UTAMA GRID (DINAMIS DARI DATABASE) -->
            @if ($armada->fasilitas && $armada->fasilitas->count())
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Fasilitas Utama</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Kartu Kapasitas Kursi -->
                        <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors">
                            <div class="w-10 h-10 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center mx-auto mb-3 font-bold">
                                🪑
                            </div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">KAPASITAS</p>
                            <p class="text-sm font-extrabold text-slate-900">{{ $armada->kapasitas }} Kursi</p>
                        </div>

                        <!-- 3 Fasilitas Pertama dari Database -->
                        @foreach ($armada->fasilitas->take(3) as $f)
                            <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors flex flex-col justify-between">
                                <div class="w-10 h-10 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center mx-auto mb-3 font-bold text-base">
                                    ✨
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">FASILITAS</p>
                                    <p class="text-sm font-extrabold text-slate-900 leading-tight">{{ $f->nama_fasilitas }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- DESKRIPSI ARMADA -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm">
                <h2 class="text-xl font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                    Deskripsi Armada
                </h2>
                <p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line">{{ $armada->deskripsi }}</p>
            </div>

            <!-- SELURUH FASILITAS LENGKAP -->
            @if ($armada->fasilitas && $armada->fasilitas->count())
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm">
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
    
        <!-- RIGHT COLUMN: SIDEBAR BOOKING CS & TESTIMONI -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- BOOKING CTA WIDGET -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-7 shadow-sm text-center space-y-4">
                <div class="w-14 h-14 bg-rose-50 text-rose-700 rounded-2xl flex items-center justify-center mx-auto text-2xl">
                    📞
                </div>
                <h3 class="text-xl font-extrabold text-slate-900">Tertarik Sewa Bus Ini?</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Konsultasikan rujukan rute, cek ketersediaan tanggal, dan dapatkan penawaran harga sewa terbaik dari tim CS kami.</p>
                @auth
                <a href="{{ route('pemesanan.create', $armada->id) }}"
                class="block text-center bg-rose-700 hover:bg-rose-800 text-white font-semibold py-3 rounded-lg">
                    🛒 Booking Sekarang
                </a>
            @else
                <a href="{{ route('login') }}"
                class="block text-center bg-rose-700 hover:bg-rose-800 text-white font-semibold py-3 rounded-lg">
                    Login untuk Booking
                </a>
            @endauth
            </div>

           <!-- TESTIMONI PELANGGAN -->
            @if ($testimoni && $testimoni->count())
                <div class="space-y-4">
                    <span class="text-[10px] text-rose-400 font-bold uppercase tracking-widest block px-1">ULASAN PELANGGAN</span>
                    @foreach ($testimoni as $t)
                        <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 border border-slate-800 rounded-3xl p-7 text-white shadow-xl relative overflow-hidden">
                            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-rose-600/10 blur-xl rounded-full"></div>
                            <div class="relative z-10">
                                <div class="text-amber-400 text-lg mb-3 tracking-widest">
                                    {{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}
                                </div>
                                <p class="italic text-slate-300 text-xs leading-relaxed mb-5">"{{ $t->pesan }}"</p>
                                <div class="pt-4 border-t border-slate-800/80">
                                    <p class="font-bold text-sm text-white">{{ $t->nama }}</p>
                                    <p class="text-xs text-slate-400 font-medium">{{ $t->jabatan }}{{ $t->perusahaan ? ', '.$t->perusahaan : '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    </div>

</div>