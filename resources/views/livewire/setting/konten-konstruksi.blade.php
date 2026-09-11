<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Kelola Konten Konstruksi</h1>
        <p class="text-slate-500 text-sm">Edit teks dan layanan di halaman Konstruksi.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">{{ session('message') }}</div>
    @endif

    <form wire:submit="simpan" class="space-y-6 max-w-3xl">
        <div class="bg-white border border-slate-200 rounded-xl p-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Hero</label>
                    <textarea wire:model="konstruksi_hero_desc" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Daftar Layanan (format JSON: title, desc)
                    </label>
                    <textarea wire:model="konstruksi_layanan" rows="14" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full font-mono text-xs"></textarea>
                    @error('konstruksi_layanan') <span class="text-red-500 text-xs">Format JSON tidak valid</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Estimasi Harga per Meter (format JSON: jenis, harga)
                    </label>
                    <textarea wire:model="konstruksi_harga_meter" rows="8" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full font-mono text-xs"></textarea>
                    @error('konstruksi_harga_meter') <span class="text-red-500 text-xs">Format JSON tidak valid</span> @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white px-6 py-2.5 rounded-lg text-sm font-semibold">
            Simpan Perubahan
        </button>
    </form>
</div>