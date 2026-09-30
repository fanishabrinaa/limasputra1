<div class="px-6 md:px-12 py-8" x-data="{
    mainImage: '{{ $produk->gambar ? Storage::url($produk->gambar) : '' }}',
    nomorWa: '{{ \App\Models\Setting::get('nomor_whatsapp', '6281234567890') }}',
    pesanSekarang() {
        const teks = `Halo, saya mau pesan:\n\n*{{ $produk->nama_produk }}*\n\nMohon info ketersediaan & harganya. Terima kasih.`;
        window.open(`https://wa.me/${this.nomorWa}?text=${encodeURIComponent(teks)}`, '_blank');
    }
}">
    {{-- TOMBOL KEMBALI --}}
    <button
        type="button"
        onclick="if (document.referrer && document.referrer.includes(window.location.host)) { history.back(); } else { window.location.href = '{{ route('produk.publik') }}'; }"
        class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-rose-700 mb-4 transition-colors"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali</span>
    </button>

    {{-- Breadcrumb --}}
    <div class="text-sm text-slate-500 mb-6">
        <a href="{{ route('produk.publik') }}" class="hover:text-rose-700">
            Unit Usaha
        </a>
        <span class="mx-1">›</span>
        <span>{{ $produk->kategori }}</span>
        <span class="mx-1">›</span>
        <span class="text-slate-800 font-medium">
            {{ $produk->nama_produk }}
        </span>
    </div>

    {{-- DETAIL UTAMA --}}
    <div class="grid md:grid-cols-2 gap-10">

        {{-- GAMBAR PRODUK --}}
        <div>
            <div class="relative border border-slate-200 rounded-lg overflow-hidden bg-white">
                @if ($produk->badge)
                    <span class="absolute top-4 left-4 bg-rose-700 text-white text-xs font-semibold px-3 py-1 rounded-full z-10">
                        {{ $produk->badge }}
                    </span>
                @endif

                <template x-if="mainImage">
                    <img :src="mainImage" class="w-full h-96 object-contain p-6">
                </template>

                <template x-if="!mainImage">
                    <div class="w-full h-96 bg-slate-100 flex items-center justify-center text-slate-400 text-sm">
                        Belum ada gambar
                    </div>
                </template>
            </div>

            {{-- GALERI (klik buat ganti gambar utama) --}}
            @if (!empty($produk->galeri) && is_array($produk->galeri) && count($produk->galeri))
                <div class="grid grid-cols-4 gap-3 mt-4">
                    {{-- Foto utama juga masuk sebagai thumbnail pertama --}}
                    @if ($produk->gambar)
                        <button
                            type="button"
                            @click="mainImage = '{{ Storage::url($produk->gambar) }}'"
                            class="border rounded-lg overflow-hidden transition-all"
                            :class="mainImage === '{{ Storage::url($produk->gambar) }}' ? 'border-rose-600 ring-2 ring-rose-200' : 'border-slate-200 hover:border-rose-300'"
                        >
                            <img src="{{ Storage::url($produk->gambar) }}" class="w-full h-20 object-cover">
                        </button>
                    @endif

                    @foreach ($produk->galeri as $foto)
                        <button
                            type="button"
                            @click="mainImage = '{{ Storage::url($foto) }}'"
                            class="border rounded-lg overflow-hidden transition-all"
                            :class="mainImage === '{{ Storage::url($foto) }}' ? 'border-rose-600 ring-2 ring-rose-200' : 'border-slate-200 hover:border-rose-300'"
                        >
                            <img src="{{ Storage::url($foto) }}" class="w-full h-20 object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- INFORMASI PRODUK --}}
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-3">
                {{ $produk->nama_produk }}
            </h1>

            <div class="flex items-center gap-3 mb-5 text-sm">
                @if ($produk->kategori)
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full">
                        {{ $produk->kategori }}
                    </span>
                @endif

                @if ($produk->sku)
                    <span class="text-slate-400">
                        SKU: {{ $produk->sku }}
                    </span>
                @endif
            </div>

            <div class="space-y-3 mb-6 text-sm text-slate-700">
                <p>
                    Pengiriman armada sendiri atau ambil di gudang
                </p>

                <p>
                    Standar Nasional Indonesia (SNI) Teruji
                </p>
            </div>

            @if ($produk->deskripsi)
                <p class="text-slate-600 mb-6">
                    {{ $produk->deskripsi }}
                </p>
            @endif

            {{-- TOMBOL --}}
            <div class="border-t border-slate-200 pt-5 flex gap-3">
                <button
                    type="button"
                    @click="pesanSekarang()"
                    class="flex-1 bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg transition-colors"
                >
                    Pesan Sekarang
                </button>

                <a
                    href="https://wa.me/{{ \App\Models\Setting::get('nomor_whatsapp', '6281234567890') }}?text={{ urlencode('Halo, saya tertarik dengan ' . $produk->nama_produk) }}"
                    target="_blank"
                    class="bg-slate-900 hover:bg-slate-800 text-white font-semibold px-6 py-3 rounded-lg text-center whitespace-nowrap"
                >
                    Hubungi Marketing
                </a>
            </div>
        </div>
    </div>

    {{-- INFORMASI TAMBAHAN --}}
    <div class="grid lg:grid-cols-2 gap-8 mt-12">

        {{-- SPESIFIKASI --}}
        @if (!empty($produk->spesifikasi) && is_array($produk->spesifikasi))
            <div class="bg-white border border-slate-200 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4 border-b border-slate-100 pb-3">
                    Spesifikasi Teknis
                </h3>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    @foreach ($produk->spesifikasi as $label => $value)
                        <div>
                            <p class="text-slate-400">
                                {{ $label }}
                            </p>

                            <p class="font-semibold text-slate-800">
                                {{ $value }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- KEUNGGULAN --}}
        @if (!empty($produk->keunggulan) && is_array($produk->keunggulan))
            <div class="bg-white border border-slate-200 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4 border-b border-slate-100 pb-3">
                    Keunggulan Produk
                </h3>

                <div class="grid grid-cols-2 gap-3 text-sm">
                    @foreach ($produk->keunggulan as $poin)
                        <div class="flex items-start gap-2">
                            <span class="text-rose-700">✓</span>
                            <span>{{ $poin }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    {{-- INFORMASI PEMBELIAN & PENGIRIMAN --}}
    <div class="grid md:grid-cols-2 gap-8 mt-8">

        {{-- BELI GROSIR --}}
        <div class="bg-slate-900 rounded-lg p-6">
            <h4 class="text-white font-bold mb-2">
                Beli Grosir?
            </h4>

            <p class="text-slate-400 text-sm mb-4">
                Dapatkan harga khusus untuk proyek konstruksi
                dan pembelian dalam jumlah besar.
            </p>

            <a
                href="{{ route('kontak') }}"
                class="block bg-white text-slate-900 text-center font-semibold px-4 py-2 rounded-lg text-sm hover:bg-slate-100"
            >
                Minta Penawaran Proyek
            </a>
        </div>

        {{-- LOKASI PENGIRIMAN --}}
        <div class="bg-white border border-slate-200 rounded-lg p-6">
            <h4 class="font-bold mb-3">
                Lokasi Pengiriman
            </h4>

            <p class="text-sm text-slate-600 mb-3">
                {{ \App\Models\Setting::get('alamat', 'Depo Limas Putra') }}
            </p>
        </div>

    </div>
</div>