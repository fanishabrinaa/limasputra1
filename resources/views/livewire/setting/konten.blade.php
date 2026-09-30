<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Konten Tentang Kami</h1>
        <p class="text-slate-500 text-sm">Edit teks yang tampil di halaman Tentang Kami.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-6 text-sm">{{ session('message') }}</div>
    @endif

    <!-- HERO & SEJARAH -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Hero & Sejarah</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">H1 Judul</label>
                <input type="text" wire:model="tentang_h1_judul" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('tentang_h1_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Hero</label>
                <textarea wire:model="tentang_hero_desc" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_hero_desc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Sejarah</label>
                <input type="text" wire:model="tentang_sejarah_judul" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('tentang_sejarah_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Badge Angka Sejarah</label>
                <input type="text" wire:model="tentang_sejarah_badge_angka" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('tentang_sejarah_badge_angka') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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

    <!-- VISI MISI & UNIT DESC -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Visi, Misi & Unit Usaha</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Visi</label>
                <textarea wire:model="tentang_visi" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_visi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Misi (JSON array teks)</label>
                <textarea wire:model="tentang_misi" rows="6" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-xs font-mono"></textarea>
                @error('tentang_misi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Intro Nilai Utama</label>
                <textarea wire:model="tentang_values_intro" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_values_intro') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Unit Bus</label>
                <textarea wire:model="tentang_unit_bus_desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_unit_bus_desc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Unit Bangunan</label>
                <textarea wire:model="tentang_unit_bangunan_desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_unit_bangunan_desc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Unit Konstruksi</label>
                <textarea wire:model="tentang_unit_konstruksi_desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_unit_konstruksi_desc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Call to Action Akhir</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Judul CTA</label>
                <input type="text" wire:model="tentang_cta_judul" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                @error('tentang_cta_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi CTA</label>
                <textarea wire:model="tentang_cta_desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('tentang_cta_desc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- FIELD JSON KOMPLEKS (kolom-kolom) -->

    {{-- MENGAPA MEMILIH KAMI --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h2 class="text-lg font-bold text-slate-800">Mengapa Memilih Kami</h2>
                <p class="text-xs text-slate-400">Icon tersedia: shield, bolt, briefcase, trending-up</p>
            </div>
            <button type="button" wire:click="tambahItem('mengapa_kami')"
                class="text-xs bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg whitespace-nowrap">
                + Tambah
            </button>
        </div>
        @foreach ($mengapa_kami as $i => $item)
            <div class="border border-slate-200 rounded-lg p-4 mb-3 relative bg-slate-50">
                <button type="button" wire:click="hapusItem('mengapa_kami', {{ $i }})"
                    class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xs font-medium">Hapus</button>
                <label class="text-xs font-medium text-slate-500">Icon</label>
                <select wire:model="mengapa_kami.{{ $i }}.icon" class="w-full border border-slate-300 rounded-lg px-3 py-2 mb-2 text-sm">
                    <option value="shield">Shield</option>
                    <option value="bolt">Bolt</option>
                    <option value="briefcase">Briefcase</option>
                    <option value="trending-up">Trending Up</option>
                </select>
                <label class="text-xs font-medium text-slate-500">Title</label>
                <input type="text" wire:model="mengapa_kami.{{ $i }}.title" class="w-full border border-slate-300 rounded-lg px-3 py-2 mb-2 text-sm">
                <label class="text-xs font-medium text-slate-500">Deskripsi</label>
                <textarea wire:model="mengapa_kami.{{ $i }}.desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
        @endforeach
        @error('mengapa_kami') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    {{-- MILESTONE PERJALANAN --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-slate-800">Milestone Perjalanan</h2>
            <button type="button" wire:click="tambahItem('tentang_milestones')" class="text-xs bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg whitespace-nowrap">+ Tambah</button>
        </div>
        @foreach ($tentang_milestones as $i => $item)
            <div class="border border-slate-200 rounded-lg p-4 mb-3 relative bg-slate-50">
                <button type="button" wire:click="hapusItem('tentang_milestones', {{ $i }})" class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xs font-medium">Hapus</button>
                <label class="text-xs font-medium text-slate-500">Tahun</label>
                <input type="text" wire:model="tentang_milestones.{{ $i }}.year" class="w-full border border-slate-300 rounded-lg px-3 py-2 mb-2 text-sm">
                <label class="text-xs font-medium text-slate-500">Deskripsi</label>
                <textarea wire:model="tentang_milestones.{{ $i }}.desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
        @endforeach
        @error('tentang_milestones') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    {{-- PIMPINAN --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-slate-800">Pimpinan</h2>
            <button type="button" wire:click="tambahItem('tentang_leaders')" class="text-xs bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg whitespace-nowrap">+ Tambah</button>
        </div>
        @foreach ($tentang_leaders as $i => $item)
            <div class="border border-slate-200 rounded-lg p-4 mb-3 relative bg-slate-50">
                <button type="button" wire:click="hapusItem('tentang_leaders', {{ $i }})" class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xs font-medium">Hapus</button>
                <label class="text-xs font-medium text-slate-500">Nama</label>
                <input type="text" wire:model="tentang_leaders.{{ $i }}.name" class="w-full border border-slate-300 rounded-lg px-3 py-2 mb-2 text-sm">
                <label class="text-xs font-medium text-slate-500">Jabatan</label>
                <input type="text" wire:model="tentang_leaders.{{ $i }}.role" class="w-full border border-slate-300 rounded-lg px-3 py-2 mb-2 text-sm">
                <label class="text-xs font-medium text-slate-500">Deskripsi</label>
                <textarea wire:model="tentang_leaders.{{ $i }}.desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
        @endforeach
        @error('tentang_leaders') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    {{-- NILAI UTAMA --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-slate-800">Nilai Utama</h2>
            <button type="button" wire:click="tambahItem('tentang_values')" class="text-xs bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg whitespace-nowrap">+ Tambah</button>
        </div>
        @foreach ($tentang_values as $i => $item)
            <div class="border border-slate-200 rounded-lg p-4 mb-3 relative bg-slate-50">
                <button type="button" wire:click="hapusItem('tentang_values', {{ $i }})" class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xs font-medium">Hapus</button>
                <label class="text-xs font-medium text-slate-500">Title</label>
                <input type="text" wire:model="tentang_values.{{ $i }}.title" class="w-full border border-slate-300 rounded-lg px-3 py-2 mb-2 text-sm">
                <label class="text-xs font-medium text-slate-500">Deskripsi</label>
                <textarea wire:model="tentang_values.{{ $i }}.desc" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
        @endforeach
        @error('tentang_values') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <button wire:click="simpan" class="bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg">
        Simpan Semua Perubahan
    </button>
</div>