@php
    $nomorWa   = \App\Models\Setting::get('nomor_whatsapp', '6281234567890');
    $alamat    = \App\Models\Setting::get('alamat', 'Depo Putra Limas');
    $gambarUrl = $produk->gambar ? Storage::url($produk->gambar) : null;

    // Semua foto jadi satu daftar: foto utama + galeri (tanpa duplikat)
    $fotoList = collect([$gambarUrl])
        ->merge(collect(is_array($produk->galeri) ? $produk->galeri : [])->map(fn ($f) => Storage::url($f)))
        ->filter()
        ->unique()
        ->values();

    $pesanLangsung = "Halo, saya mau pesan:\n\n*{$produk->nama_produk}*\n\nMohon info ketersediaan & harganya. Terima kasih.";

    $adaSpek   = !empty($produk->spesifikasi) && is_array($produk->spesifikasi);
    $adaUnggul = !empty($produk->keunggulan) && is_array($produk->keunggulan);
@endphp

<div
    class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8 py-6 md:py-10"
    x-data="{
        mainImage: @js($fotoList->first() ?? ''),
        nomorWa: @js($nomorWa),
        pesanSekarang() {
            const teks = @js($pesanLangsung);
            window.open(`https://wa.me/${this.nomorWa}?text=${encodeURIComponent(teks)}`, '_blank');
        }
    }"
>
    {{-- NAVIGASI: kembali + breadcrumb --}}
    <div class="flex flex-wrap items-center gap-3 mb-6 text-sm">
        <button
            type="button"
            onclick="if (document.referrer && document.referrer.includes(window.location.host)) { history.back(); } else { window.location.href = '{{ route('produk.publik') }}'; }"
            class="inline-flex items-center gap-2 font-semibold text-slate-600 hover:text-rose-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-300 rounded"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </button>

        <span class="text-slate-300" aria-hidden="true">|</span>

        <nav aria-label="Breadcrumb" class="flex flex-wrap items-center text-slate-500">
            <a href="{{ route('produk.publik') }}" class="hover:text-rose-700 transition-colors">Unit Usaha</a>
            @if ($produk->kategori)
                <span class="mx-1" aria-hidden="true">›</span>
                <span>{{ $produk->kategori }}</span>
            @endif
            <span class="mx-1" aria-hidden="true">›</span>
            <span class="text-slate-800 font-medium">{{ $produk->nama_produk }}</span>
        </nav>
    </div>

    {{-- DETAIL UTAMA --}}
    <div class="grid md:grid-cols-2 gap-8 lg:gap-12 items-start">

        {{-- GAMBAR PRODUK --}}
        <div class="md:sticky md:top-6">
            <div class="relative border border-slate-200 rounded-xl overflow-hidden bg-slate-100">
                @if ($produk->badge)
                    <span class="absolute top-4 left-4 z-10 bg-rose-700 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                        {{ $produk->badge }}
                    </span>
                @endif

                <template x-if="mainImage">
                    <img
                        :src="mainImage"
                        alt="{{ $produk->nama_produk }}"
                        class="w-full h-96 object-cover"
                    >
                </template>

                <template x-if="!mainImage">
                    <div class="w-full h-96 flex flex-col items-center justify-center gap-2 text-slate-400 text-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.5-4.5a2 2 0 012.8 0L16 16m-2-2l1.5-1.5a2 2 0 012.8 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Belum ada gambar
                    </div>
                </template>
            </div>

            {{-- GALERI: klik untuk ganti gambar utama --}}
            @if ($fotoList->count() > 1)
                <div class="flex gap-3 mt-4 overflow-x-auto pb-1">
                    @foreach ($fotoList as $i => $foto)
                        <button
                            type="button"
                            @click="mainImage = @js($foto)"
                            aria-label="Lihat foto {{ $i + 1 }}"
                            class="shrink-0 w-20 h-20 border rounded-lg overflow-hidden bg-white transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-300"
                            :class="mainImage === @js($foto) ? 'border-rose-600 ring-2 ring-rose-200' : 'border-slate-200 hover:border-rose-300'"
                        >
                            <img src="{{ $foto }}" alt="" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- INFORMASI PRODUK --}}
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 leading-tight mb-3">
                {{ $produk->nama_produk }}
            </h1>

            @if ($produk->kategori || $produk->sku)
                <div class="flex flex-wrap items-center gap-3 mb-6 text-sm">
                    @if ($produk->kategori)
                        <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full">{{ $produk->kategori }}</span>
                    @endif
                    @if ($produk->sku)
                        <span class="text-slate-400">SKU: {{ $produk->sku }}</span>
                    @endif
                </div>
            @endif

            @if ($produk->deskripsi)
                <p class="text-slate-600 leading-relaxed mb-6">
                    {{ $produk->deskripsi }}
                </p>
            @endif

            {{-- Poin layanan --}}
            <ul class="space-y-3 mb-8 text-sm text-slate-700">
                <li class="flex items-center gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-rose-50 text-rose-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h11v9H3zM14 10h4l3 3v3h-7zM7 19a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm10 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                    </span>
                    Pengiriman armada sendiri atau ambil di gudang
                </li>
                <li class="flex items-center gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-rose-50 text-rose-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.6-1a9 9 0 11-17.2 0A9 9 0 0120.6 11z" />
                        </svg>
                    </span>
                    Standar Nasional Indonesia (SNI) teruji
                </li>
            </ul>

            {{-- TOMBOL AKSI: satu tombol ke WhatsApp --}}
            <div class="border-t border-slate-200 pt-6">
                <button
                    type="button"
                    @click="pesanSekarang()"
                    class="w-full inline-flex items-center justify-center gap-2 bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-300 focus-visible:ring-offset-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8M8 14h5m-9 6l1.3-3.9A8 8 0 1112 20a8 8 0 01-3.7-.9L4 20z" />
                    </svg>
                    Pesan via WhatsApp
                </button>

                <p class="mt-3 text-xs text-slate-500 text-center">
                    Anda akan diarahkan ke WhatsApp untuk menanyakan stok dan harga.
                </p>
            </div>
        </div>
    </div>

    {{-- SPESIFIKASI & KEUNGGULAN --}}
    @if ($adaSpek || $adaUnggul)
        <div class="grid lg:grid-cols-2 gap-6 mt-12">

            @if ($adaSpek)
                <section class="bg-white border border-slate-200 rounded-xl p-6">
                    <h2 class="font-bold text-lg text-slate-900 mb-2">Spesifikasi teknis</h2>

                    <dl class="divide-y divide-slate-100 text-sm">
                        @foreach ($produk->spesifikasi as $label => $value)
                            <div class="flex justify-between gap-6 py-3">
                                <dt class="text-slate-500">{{ $label }}</dt>
                                <dd class="font-semibold text-slate-800 text-right">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </section>
            @endif

            @if ($adaUnggul)
                <section class="bg-white border border-slate-200 rounded-xl p-6">
                    <h2 class="font-bold text-lg text-slate-900 mb-4">Keunggulan produk</h2>

                    <ul class="space-y-3 text-sm text-slate-700">
                        @foreach ($produk->keunggulan as $poin)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 shrink-0 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $poin }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

        </div>
    @endif

    {{-- GROSIR & LOKASI --}}
    <div class="grid md:grid-cols-2 gap-6 mt-8">

        <section class="bg-slate-900 rounded-xl p-6 flex flex-col">
            <h2 class="text-white font-bold text-lg mb-2">Beli grosir?</h2>
            <p class="text-slate-300 text-sm leading-relaxed mb-5">
                Dapatkan harga khusus untuk proyek konstruksi dan pembelian dalam jumlah besar.
            </p>
            <a
                href="{{ route('kontak') }}"
                class="mt-auto block bg-white text-slate-900 text-center font-semibold px-4 py-2.5 rounded-lg text-sm hover:bg-slate-100 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900"
            >
                Minta penawaran proyek
            </a>
        </section>

        <section class="bg-white border border-slate-200 rounded-xl p-6">
            <h2 class="font-bold text-lg text-slate-900 mb-3">Lokasi pengiriman</h2>
            <div class="flex items-start gap-3 text-sm text-slate-600">
                <svg class="w-5 h-5 shrink-0 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.7 16.7L13.4 21a2 2 0 01-2.8 0l-4.3-4.3a8 8 0 1111.4 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <p class="leading-relaxed">{{ $alamat }}</p>
            </div>
        </section>

    </div>
</div>