<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Pengaturan Perusahaan</h1>
        <p class="text-slate-500 text-sm">Profil dan kontak yang tampil di halaman publik.</p>
    </div>
    <div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Link Instagram</label>
    <input type="text" wire:model="instagram" placeholder="https://instagram.com/limasputra"
           class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Link TikTok</label>
    <input type="text" wire:model="tiktok" placeholder="https://tiktok.com/@limasputra"
           class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
</div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">{{ session('message') }}</div>
    @endif

    <form wire:submit="simpan" class="bg-white border border-slate-200 rounded-xl p-6 space-y-4 max-w-xl">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Perusahaan</label>
            <input type="text" wire:model="nama_perusahaan" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
            @error('nama_perusahaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea wire:model="deskripsi" rows="4" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Alamat</label>
            <textarea wire:model="alamat" rows="2" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lokasi untuk Peta</label>
            <input type="text" wire:model="lokasi_peta" placeholder="Contoh: TB. Limas Putra Sekuro Jepara"
                class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
            <p class="text-xs text-slate-400 mt-1">Isi dengan nama tempat yang mudah dicari di Google Maps (bukan alamat kode).</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Telepon</label>
            <input type="text" wire:model="telepon" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Jam Operasional</label>
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs text-slate-500 mb-1">Sabtu - Kamis</label>
                    <input type="text" wire:model="jam_sabtu_kamis" placeholder="08:00 - 17:00"
                        class="border border-slate-300 rounded-lg px-3 py-2 w-full text-sm">
                </div>
                <div>
                    <label class="block text-xs text-slate-500 mb-1">Jumat</label>
                    <input type="text" wire:model="jam_jumat" placeholder="Tutup"
                        class="border border-slate-300 rounded-lg px-3 py-2 w-full text-sm">
                </div>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input type="email" wire:model="email" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Logo Perusahaan</label>
    <input type="file" wire:model="logo" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full text-sm">
    @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    <div wire:loading wire:target="logo" class="text-xs text-slate-400 mt-1">Mengupload...</div>

    @if ($logo)
        <img src="{{ $logo->temporaryUrl() }}" class="h-16 mt-2 object-contain">
    @elseif ($logo_lama)
        <img src="{{ Storage::url($logo_lama) }}" class="h-16 mt-2 object-contain">
    @endif      
    </div>
        <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white px-5 py-2.5 rounded-lg text-sm font-semibold">
            Simpan
        </button>
    </form>
</div>