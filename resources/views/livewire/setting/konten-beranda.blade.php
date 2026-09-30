<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Konten Beranda</h1>
        <p class="text-slate-500 text-sm">Edit teks yang tampil di halaman Beranda.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">{{ session('message') }}</div>
    @endif

    <form wire:submit="simpan" class="space-y-6 max-w-2xl">

        <!-- SECTION: UNIT BISNIS -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 space-y-4">
            <p class="text-sm font-bold text-slate-700 uppercase tracking-wide">Section Unit Bisnis</p>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul</label>
                <input type="text" wire:model="unitbisnis_judul" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
                @error('unitbisnis_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Paragraf</label>
                <textarea wire:model="unitbisnis_paragraf" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
                @error('unitbisnis_paragraf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Card — Bus Pariwisata</label>
                <textarea wire:model="desc_bus" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
                @error('desc_bus') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Card — Toko Bangunan</label>
                <textarea wire:model="desc_bangunan" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
                @error('desc_bangunan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Card — Jasa Konstruksi</label>
                <textarea wire:model="desc_konstruksi" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
                @error('desc_konstruksi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- SECTION: KEMITRAAN -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 space-y-4">
            <p class="text-sm font-bold text-slate-700 uppercase tracking-wide">Section Kemitraan Strategis</p>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Badge Kecil</label>
                <input type="text" wire:model="kemitraan_badge" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
                @error('kemitraan_badge') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul</label>
                <input type="text" wire:model="kemitraan_judul" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
                @error('kemitraan_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Paragraf</label>
                <textarea wire:model="kemitraan_paragraf" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
                @error('kemitraan_paragraf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Label Logo 1</label>
                    <input type="text" wire:model="logo1" class="border border-slate-300 rounded-lg px-3 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-rose-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Label Logo 2</label>
                    <input type="text" wire:model="logo2" class="border border-slate-300 rounded-lg px-3 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-rose-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Label Logo 3</label>
                    <input type="text" wire:model="logo3" class="border border-slate-300 rounded-lg px-3 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-rose-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Label Logo 4</label>
                    <input type="text" wire:model="logo4" class="border border-slate-300 rounded-lg px-3 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-rose-700">
                </div>
            </div>
        </div>

        <!-- SECTION: CTA AKHIR -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 space-y-4">
            <p class="text-sm font-bold text-slate-700 uppercase tracking-wide">CTA Penutup</p>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul</label>
                <input type="text" wire:model="cta_judul" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
                @error('cta_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Paragraf</label>
                <textarea wire:model="cta_paragraf" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
                @error('cta_paragraf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white px-6 py-2.5 rounded-lg text-sm font-semibold">
            Simpan Semua
        </button>
    </form>
</div>