<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Konten Unit Usaha</h1>
        <p class="text-slate-500 text-sm">Edit teks yang tampil di halaman Unit Usaha.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-6 text-sm">{{ session('message') }}</div>
    @endif

    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6 max-w-2xl">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Hero</label>
                <input type="text" wire:model="unit_usaha_judul" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <p class="text-xs text-slate-400 mt-1">Kasih tanda ** di sekitar kata yang mau dikasih warna gradasi. Contoh: Unit Usaha **Putra Limas**</p>
                @error('unit_usaha_judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Hero</label>
                <textarea wire:model="unit_usaha_deskripsi" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
                @error('unit_usaha_deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <button wire:click="simpan" class="bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg">
        Simpan Perubahan
    </button>
</div>