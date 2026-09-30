<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Konten Katalog Armada</h1>
        <p class="text-slate-500 text-sm">Edit teks yang tampil di halaman Katalog Armada.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-6 text-sm">{{ session('message') }}</div>
    @endif

    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6 max-w-2xl">
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

    <button wire:click="simpan" class="bg-rose-700 hover:bg-rose-800 text-white font-semibold px-6 py-3 rounded-lg">
        Simpan Perubahan
    </button>
</div>