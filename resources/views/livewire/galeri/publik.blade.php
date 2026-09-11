<div>
    <!-- HERO HEADER GALERI -->
    <div class="relative bg-slate-950 text-white py-20 px-6 md:px-12 text-center overflow-hidden border-b border-slate-900">
        <!-- Ambient Glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-rose-600/10 blur-[100px] rounded-full pointer-events-none"></div>
         <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ \App\Models\Setting::get('img_halaman_hero') ? Storage::url(\App\Models\Setting::get('img_halaman_hero')) : (\App\Models\Setting::get('img_unit_usaha_hero') ? Storage::url(\App\Models\Setting::get('img_unit_usaha_hero')) : 'https://images.unsplash.com/photo-1541888946425-d0fbb186a5b7?auto=format&fit=crop&q=80&w=1600') }}"
                alt="Unit Usaha Limas Putra"
                class="lp-hero-image w-full h-full object-cover opacity-60 scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-950/70 to-slate-950"></div>
        </div>
        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-5 backdrop-blur-md">
                DOKUMENTASI KAMI
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">Dokumentasi</span>
            </h1>
            <p class="text-slate-300 text-base max-w-xl mx-auto leading-relaxed">
                Jelajahi kumpulan foto kegiatan, armada bus pariwisata, material toko bangunan, dan pengerjaan proyek konstruksi Limas Putra.
            </p>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="bg-slate-50 px-6 md:px-12 py-16 min-h-screen">
        <div class="max-w-7xl mx-auto">

            <!-- FILTER CATEGORY TABS -->
            <div class="flex justify-center items-center gap-2 md:gap-3 mb-12 flex-wrap">
                @foreach (['Semua', 'Bus Pariwisata', 'Toko Bangunan', 'Konstruksi'] as $kat)
                    <button wire:click="$set('filterKategori', '{{ $kat }}')"
                            class="px-5 py-2.5 rounded-full text-xs md:text-sm font-semibold transition-all duration-300 shadow-sm border {{ $filterKategori === $kat ? 'bg-rose-700 text-white border-rose-700 shadow-rose-900/20 scale-105' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-100 hover:text-slate-900' }}">
                        {{ $kat }}
                    </button>
                @endforeach
            </div>

            <!-- GALLERY GRID -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                @forelse ($daftarGaleri as $item)
                    <div class="lp-scroll bg-white border border-slate-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-rose-200 hover:-translate-y-1 transition-all duration-300 flex flex-col group" style="--delay: {{ $loop->index * 80 }}ms;">
                        <div class="relative overflow-hidden bg-slate-950 h-32 sm:h-52">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" 
                                alt="{{ $item->judul }}"
                         loading="lazy"
                                class="lp-card-image w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">Tanpa Gambar</div>
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
                    <div class="col-span-full bg-white border border-slate-200/80 rounded-3xl p-12 text-center max-w-lg mx-auto shadow-sm my-8">
                        <div class="w-16 h-16 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">
                            
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Foto</h3>
                        <p class="text-sm text-slate-500">Belum ada dokumentasi foto yang diunggah untuk kategori <span class="font-bold text-slate-700">"{{ $filterKategori }}"</span>.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>