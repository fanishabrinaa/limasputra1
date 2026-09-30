<div class="p-6 md:p-8">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kelola Produk Bangunan</h1>
            <p class="text-slate-500 text-sm">Katalog material yang dijual di Toko Bangunan.</p>
        </div>
        @if (!$showForm)
            <button wire:click="bukaForm" class="bg-rose-700 hover:bg-rose-800 text-white px-4 py-2.5 rounded-lg text-sm font-semibold w-full sm:w-auto transition">
                + Tambah Produk
            </button>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">
            {{ session('message') }}
        </div>
    @endif

    @if (!$showForm)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse ($daftarProduk as $item)
                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-sm transition">
                    @if ($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" class="w-full h-32 object-cover">
                    @else
                        <div class="w-full h-32 bg-slate-100 flex items-center justify-center text-slate-300 text-xs">
                            Tidak ada gambar
                        </div>
                    @endif
                    <div class="p-3">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $item->nama_produk }}</p>
                         <div class="mt-2 flex gap-3">
                            <button wire:click="edit({{ $item->id }})" class="text-rose-700 hover:underline text-xs font-medium">Edit</button>
                            <button wire:click="hapus({{ $item->id }})" wire:confirm="Yakin mau hapus?" class="text-slate-400 hover:text-red-600 text-xs font-medium">Hapus</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-slate-400 col-span-2 md:col-span-4 text-center py-10">Belum ada produk</p>
            @endforelse
        </div>
    @else
        <form wire:submit="simpan" class="bg-white border border-slate-200 rounded-xl p-6 space-y-4 max-w-md">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Produk</label>
                <input type="text" wire:model="nama_produk" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
                @error('nama_produk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                <select wire:model="kategori" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoriList as $kategoriItem)
                        <option value="{{ $kategoriItem }}">{{ $kategoriItem }}</option>
                    @endforeach
                </select>
                @error('kategori') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="3" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full focus:outline-none focus:ring-2 focus:ring-rose-700"></textarea>
                @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Gambar</label>
                <input type="file" wire:model="gambar" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full text-sm">
                @error('gambar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                <div wire:loading wire:target="gambar" class="text-xs text-slate-400 mt-1">Mengupload...</div>
                @if ($gambar)
                    <img src="{{ $gambar->temporaryUrl() }}" class="w-24 h-24 object-cover rounded-lg mt-2">
                @elseif ($gambar_lama)
                    <img src="{{ Storage::url($gambar_lama) }}" class="w-24 h-24 object-cover rounded-lg mt-2">
                @endif
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>
                <button type="button" wire:click="batal" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                    Batal
                </button>
            </div>
        </form>
    @endif
</div>