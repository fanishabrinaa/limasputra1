<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Kelola Konten Halaman</h1>
        <p class="text-slate-500 text-sm">Edit teks yang tampil di berbagai halaman publik.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-6 text-sm">{{ session('message') }}</div>
    @endif

    <!-- BERANDA -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Halaman Beranda</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Statistik: Tahun Pengalaman</label>
                <input type="text" wire:model="stat_tahun_pengalaman" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('stat_tahun_pengalaman') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Statistik: Pelanggan Puas</label>
                <input type="text" wire:model="stat_pelanggan_puas" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('stat_pelanggan_puas') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- KATALOG ARMADA -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Halaman Katalog Armada</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Section Info</label>
                <input type="text" wire:model="katalog_judul" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('katalog_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Section Info</label>
                <textarea wire:model="katalog_deskripsi" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('katalog_deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- UNIT USAHA -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Halaman Unit Usaha</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Hero</label>
                <input type="text" wire:model="unit_usaha_judul" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('unit_usaha_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Hero</label>
                <textarea wire:model="unit_usaha_deskripsi" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('unit_usaha_deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- KONSTRUKSI -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Halaman Konstruksi</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Hero</label>
                <textarea wire:model="konstruksi_hero_desc" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('konstruksi_hero_desc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- GALERI -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Halaman Galeri</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Hero</label>
                <input type="text" wire:model="galeri_judul" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('galeri_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Hero</label>
                <textarea wire:model="galeri_deskripsi" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('galeri_deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- TENTANG KAMI -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Halaman Tentang Kami</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Hero</label>
                <textarea wire:model="tentang_hero_desc" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_hero_desc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Sejarah - Paragraf 1</label>
                <textarea wire:model="tentang_sejarah_1" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_sejarah_1') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Sejarah - Paragraf 2</label>
                <textarea wire:model="tentang_sejarah_2" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_sejarah_2') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- FIELD JSON KOMPLEKS -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-2">Mengapa Memilih Kami</h2>
        <p class="text-xs text-slate-400 mb-2">Format JSON: icon, title, desc — pilihan icon: shield, bolt, briefcase, trending-up</p>
        <textarea wire:model="mengapa_kami" rows="14" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs font-mono"></textarea>
        @error('mengapa_kami') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-2">Milestone Perjalanan</h2>
        <p class="text-xs text-slate-400 mb-2">Format JSON: year, desc</p>
        <textarea wire:model="tentang_milestones" rows="12" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs font-mono"></textarea>
        @error('tentang_milestones') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-2">Pimpinan</h2>
        <p class="text-xs text-slate-400 mb-2">Format JSON: name, role, desc, image (path storage, opsional)</p>
        <textarea wire:model="tentang_leaders" rows="8" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs font-mono"></textarea>
        @error('tentang_leaders') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-2">Nilai Utama</h2>
        <p class="text-xs text-slate-400 mb-2">Format JSON: title, desc</p>
        <textarea wire:model="tentang_values" rows="8" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs font-mono"></textarea>
        @error('tentang_values') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <button wire:click="simpan" class="bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg">
        Simpan Semua Perubahan
    </button>
</div>