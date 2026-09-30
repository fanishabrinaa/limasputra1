<div>
    <div>
    @include('partials.tab-unit-usaha')
    <!-- HERO -->
    <div class="relative h-[420px] bg-slate-900 overflow-hidden">
        <img src="{{ \App\Models\Setting::get('img_katalog_hero') ? Storage::url(\App\Models\Setting::get('img_katalog_hero')) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400' }}"
             class="absolute inset-0 w-full h-full object-cover opacity-60">
        <div class="relative z-10 px-6 md:px-12 py-16 max-w-2xl">
            <span class="inline-block bg-rose-700 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">
                LIMAS PUTRA TOURISM
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Perjalanan Mewah, Keamanan Utama.
            </h1>
            <p class="text-slate-200 mb-6">
                Hadirkan kenyamanan tak tertandingi untuk setiap perjalanan wisata Anda.
                Armada terbaru dengan fasilitas kelas eksekutif untuk pengalaman yang mengesankan.
            </p>
            <a href="#katalog" class="inline-block bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg">
                Sewa Sekarang
            </a>
        </div>
    </div>

    <!-- INFO SINGKAT -->
<div class="px-6 md:px-12 py-16 grid md:grid-cols-2 gap-10 items-center">
    <div>
        <h2 class="text-2xl font-bold mb-4 border-l-4 border-rose-700 pl-4">
            {{ \App\Models\Setting::get('katalog_judul', 'Layanan Sewa Bus Pariwisata Profesional') }}
        </h2>
        <p class="text-slate-600 mb-6">
            {{ \App\Models\Setting::get('katalog_deskripsi', 'Limas Putra telah berpengalaman lebih dari satu dekade dalam menyediakan jasa transportasi pariwisata. Seluruh armada kami dirawat secara berkala untuk memastikan performa mesin yang prima dan interior yang senantiasa bersih.') }}
        </p>
        <div class="grid grid-cols-2 gap-3 text-sm text-slate-700">
            <div class="flex items-center gap-2">Supir Berpengalaman</div>
            <div class="flex items-center gap-2">AC Super Dingin</div>
            <div class="flex items-center gap-2">Fasilitas Wi-Fi</div>
            <div class="flex items-center gap-2">Kursi Ergonomis</div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <img src="{{ \App\Models\Setting::get('img_katalog_interior') ? Storage::url(\App\Models\Setting::get('img_katalog_interior')) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400' }}" class="rounded-lg h-64 object-cover w-full">
        <img src="{{ \App\Models\Setting::get('img_katalog_supir') ? Storage::url(\App\Models\Setting::get('img_katalog_supir')) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400' }}" class="rounded-lg h-64 object-cover w-full">
    </div>
</div>

    <!-- KATALOG -->
    <div id="katalog" class="bg-slate-50 px-6 md:px-12 py-16">
        <h2 class="text-2xl font-bold text-center mb-2">Katalog Armada Kami</h2>
        <p class="text-slate-500 text-center mb-10">
            Pilih armada yang paling sesuai dengan jumlah peserta dan kebutuhan perjalanan wisata Anda.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($daftarArmada as $item)
                <div class="bg-white border border-slate-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                    <div class="relative">
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-slate-200"></div>
                        @endif
                    </div>
                    <div class="p-4">
    <h3 class="font-bold text-lg">{{ $item->nama_bus }}</h3>

    <p class="text-sm text-slate-500 mb-2">
        Kapasitas standar: {{ $item->kapasitas }} Seats
    </p>

    <div class="inline-flex items-center gap-1.5 text-xs text-rose-700 bg-rose-50 px-2.5 py-1.5 rounded-md mb-4">
        <span>Bisa pesan lebih dari 40 kursi</span>
    </div>

    <div class="flex justify-between items-center">
        <span class="text-rose-700 text-sm font-semibold">
            Hubungi Untuk Harga
        </span>

        <a href="{{ route('armada.detail', $item->id) }}"
           class="bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            Lihat Detail
        </a>
    </div>
</div>
                </div>
            @empty
                <p class="col-span-3 text-center text-slate-400">Belum ada armada tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- CTA -->
    <div class="px-6 md:px-12 py-16">
        <div class="bg-slate-900 rounded-2xl px-8 py-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h3 class="text-white text-2xl font-bold mb-2">Siap Menjelajah Bersama Kami?</h3>
                <p class="text-slate-300">Dapatkan penawaran harga terbaik untuk rute perjalanan Anda hari ini.</p>
            </div>
            <a href="{{ route('kontak') }}"
               class="bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg whitespace-nowrap">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>