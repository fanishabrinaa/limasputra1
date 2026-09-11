<div class="px-6 md:px-12 py-8">
    <div class="text-sm text-slate-500 mb-6">
        <a href="{{ route('produk.publik') }}" class="hover:text-rose-700">Unit Usaha</a>
        <span class="mx-1">›</span>
        <span>{{ $produk->kategori }}</span>
        <span class="mx-1">›</span>
        <span class="text-slate-800 font-medium">{{ $produk->nama_produk }}</span>
    </div>

    <div class="grid md:grid-cols-2 gap-10">
        <div>
            <div class="relative border border-slate-200 rounded-lg overflow-hidden bg-white">
                @if ($produk->badge)
                    <span class="absolute top-4 left-4 bg-rose-700 text-white text-xs font-semibold px-3 py-1 rounded-full z-10">
                        {{ $produk->badge }}
                    </span>
                @endif
                @if ($produk->gambar)
                    <img src="{{ Storage::url($produk->gambar) }}" class="w-full h-96 object-contain p-6">
                @else
                    <div class="w-full h-96 bg-slate-100"></div>
                @endif
            </div>

            @if ($produk->galeri && count($produk->galeri))
                <div class="grid grid-cols-4 gap-3 mt-4">
                    @foreach ($produk->galeri as $foto)
                        <img src="{{ Storage::url($foto) }}" class="w-full h-20 object-cover rounded-lg border border-slate-200">
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-3">{{ $produk->nama_produk }}</h1>

            <div class="flex items-center gap-3 mb-5 text-sm">
                @if ($produk->kategori)
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full">{{ $produk->kategori }}</span>
                @endif
                @if ($produk->sku)
                    <span class="text-slate-400">SKU: {{ $produk->sku }}</span>
                @endif
            </div>

            <div class="bg-slate-50 border-l-4 border-rose-700 rounded-lg px-5 py-4 mb-5">
                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Harga Satuan</p>
                <p class="text-rose-700 text-2xl font-bold">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    @if ($produk->harga_coret)
                        <span class="text-slate-400 text-base font-normal line-through ml-2">
                            Rp {{ number_format($produk->harga_coret, 0, ',', '.') }}
                        </span>
                    @endif
                </p>
            </div>

            <div class="space-y-3 mb-6 text-sm text-slate-700">
                <p>Stok Tersedia: <strong>{{ $produk->stok }}+ {{ $produk->satuan }}</strong></p>
                <p>Pengiriman armada sendiri atau ambil di gudang</p>
                <p>Standar Nasional Indonesia (SNI) Teruji</p>
            </div>

            <p class="text-slate-600 mb-6">{{ $produk->deskripsi }}</p>

            <div class="border-t border-slate-200 pt-5 flex gap-3">
                <button class="flex-1 bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg">
                    Pesan Sekarang
                </button>
                <a href="https://wa.me/6281234567890?text=Halo, saya tertarik dengan {{ $produk->nama_produk }}" target="_blank"
                   class="bg-slate-900 hover:bg-slate-800 text-white font-semibold px-6 py-3 rounded-lg text-center whitespace-nowrap">
                    Hubungi Marketing
                </a>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-8 mt-12">
        <div class="md:col-span-2 space-y-8">
            @if ($produk->spesifikasi)
                <div class="bg-white border border-slate-200 rounded-lg p-6">
                    <h3 class="font-bold text-lg mb-4 border-b border-slate-100 pb-3">Spesifikasi Teknis</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        @foreach ($produk->spesifikasi as $label => $value)
                            <div>
                                <p class="text-slate-400">{{ $label }}</p>
                                <p class="font-semibold text-slate-800">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($produk->keunggulan)
                <div class="bg-white border border-slate-200 rounded-lg p-6">
                    <h3 class="font-bold text-lg mb-4 border-b border-slate-100 pb-3">Keunggulan Produk</h3>
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

        <div class="space-y-6">
            <div class="bg-slate-900 rounded-lg p-6">
                <h4 class="text-white font-bold mb-2">Beli Grosir?</h4>
                <p class="text-slate-400 text-sm mb-4">
                    Dapatkan harga khusus untuk proyek konstruksi dan pembelian dalam jumlah besar (tonase).
                </p>
                <a href="{{ route('kontak') }}" class="block bg-white text-slate-900 text-center font-semibold px-4 py-2 rounded-lg text-sm">
                    Minta Penawaran Proyek
                </a>
            </div>

            <div class="bg-white border border-slate-200 rounded-lg p-6">
                <h4 class="font-bold mb-3">Lokasi Pengiriman</h4>
                <p class="text-sm text-slate-600 mb-3">{{ \App\Models\Setting::get('alamat', 'Depo Limas Putra') }}</p>
                <p class="text-sm text-slate-500">Estimasi pengiriman 1-2 hari kerja untuk wilayah Jabodetabek & Jawa Barat.</p>
            </div>
        </div>
    </div>
</div>