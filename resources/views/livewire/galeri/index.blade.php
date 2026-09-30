<div class="space-y-6">
    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-600 text-[11px] font-bold px-3 py-1 rounded-full mb-2">
                ADMIN PANEL
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Kelola Halaman Galeri</h1>
            <p class="text-sm text-slate-500 mt-1">Edit teks hero dan kelola dokumentasi foto armada bus, toko bangunan, dan proyek konstruksi.</p>
        </div>

        @if (!$showForm)
            <button wire:click="bukaForm"
                    class="inline-flex items-center gap-2 bg-rose-700 hover:bg-rose-800 text-white text-sm font-semibold px-5 py-3 rounded-2xl shadow-md shadow-rose-950/20 transition-all duration-200 hover:scale-[1.02] self-start md:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Foto Baru</span>
            </button>
        @endif
    </div>

    <!-- FLASH MESSAGE -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="text-sm font-semibold">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <!-- ====================================================== -->
    <!-- KONTEN TEKS HERO GALERI -->
    <!-- ====================================================== -->
    @if (!$showForm)
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Konten Teks Hero</h2>
            <div class="space-y-4 max-w-2xl">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Judul Hero</label>
                    <input type="text" wire:model="galeri_judul" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                    @error('galeri_judul') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi Hero</label>
                    <textarea wire:model="galeri_deskripsi" rows="3" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none"></textarea>
                    @error('galeri_deskripsi') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-4 mt-2">
                <button wire:click="simpanTeks" class="bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold px-6 py-3 rounded-xl shadow-md">
                    Simpan Perubahan Teks
                </button>
            </div>
        </div>
    @endif

    <!-- ====================================================== -->
    <!-- DAFTAR GALERI / FORM FOTO -->
    <!-- ====================================================== -->
    @if (!$showForm)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($daftarGaleri as $item)
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:border-rose-200 transition-all duration-300 flex flex-col justify-between group">
                    <div class="relative overflow-hidden bg-slate-950 h-48">
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 opacity-95">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">Tanpa Gambar</div>
                        @endif
                        <span class="absolute top-3 left-3 bg-slate-900/80 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full backdrop-blur-md border border-slate-800">
                            {{ $item->kategori }}
                        </span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <p class="text-sm font-bold text-slate-900 line-clamp-2 mb-4 leading-snug">{{ $item->judul }}</p>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                            <button wire:click="edit({{ $item->id }})" class="px-3.5 py-2 text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-xl transition">Edit</button>
                            <button wire:click="hapus({{ $item->id }})" wire:confirm="Yakin hapus foto ini?" class="px-3.5 py-2 text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl transition">Hapus</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white border border-slate-200/80 rounded-3xl p-12 text-center shadow-sm">
                    <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">📷</div>
                    <h3 class="text-base font-bold text-slate-900">Belum Ada Foto Dokumentasi</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-6">Galeri foto masih kosong. Klik tombol di bawah untuk menambahkan foto pertama.</p>
                    <button wire:click="bukaForm" class="bg-rose-700 text-white text-xs font-bold px-5 py-3 rounded-xl">+ Tambah Foto Pertama</button>
                </div>
            @endforelse
        </div>
    @else
        <!-- TAMPILAN FORM -->
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm max-w-2xl mx-auto">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <h2 class="text-lg font-bold text-slate-900">{{ $isEdit ? 'Edit Data Galeri' : 'Tambah Foto Galeri Baru' }}</h2>
                <button type="button" wire:click="batal" class="text-slate-400 hover:text-slate-600 text-sm font-bold">✕</button>
            </div>

            <form wire:submit="simpan" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Judul Foto</label>
                    <input type="text" wire:model="judul" placeholder="Contoh: Unit Bus Pariwisata Jetbus 5" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                    @error('judul') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kategori Unit</label>
                    <select wire:model="kategori" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                        <option value="Bus Pariwisata">Bus Pariwisata</option>
                        <option value="Toko Bangunan">Toko Bangunan</option>
                        <option value="Konstruksi">Konstruksi</option>
                    </select>
                    @error('kategori') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea wire:model="deskripsi" rows="3" placeholder="Tuliskan deskripsi singkat..." class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">File Gambar</label>
                    <input type="file" wire:model="gambar" class="w-full text-sm text-slate-500 border border-slate-300 rounded-xl p-1 bg-slate-50">
                    @error('gambar') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror

                    @if ($gambar)
                        <div class="mt-3">
                            <span class="text-[11px] text-slate-400 mb-1 block font-semibold">Preview Gambar Baru:</span>
                            <img src="{{ $gambar->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-2xl border border-slate-200 shadow-md">
                        </div>
                    @elseif ($gambar_lama)
                        <div class="mt-3">
                            <span class="text-[11px] text-slate-400 mb-1 block font-semibold">Gambar Sekarang:</span>
                            <img src="{{ Storage::url($gambar_lama) }}" class="w-32 h-32 object-cover rounded-2xl border border-slate-200 shadow-md">
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" wire:click="batal" class="px-5 py-3 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50">Batal</button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold shadow-md">{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Foto' }}</button>
                </div>
            </form>
        </div>
    @endif
</div>