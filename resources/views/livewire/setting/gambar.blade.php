{{-- Form admin untuk mengganti gambar tunggal dan foto galeri website. --}}
<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Kelola Gambar Website</h1>
        <p class="text-slate-500 text-sm">Ganti gambar yang tampil di berbagai halaman publik.</p>
    </div>
    

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">{{ session('message') }}</div>
    @endif

    <!-- ====================================================== -->
    <!-- GAMBAR TUNGGAL (SATU FOTO PER SLOT) -->
    <!-- ====================================================== -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach ($slots as $key => $label)
            <div class="bg-white border border-slate-200 rounded-xl p-5">
                <p class="text-sm font-semibold text-slate-700 mb-3">{{ $label }}</p>

                @if (!empty($uploads[$key]))
                    <img src="{{ $uploads[$key]->temporaryUrl() }}" class="w-full h-40 object-cover rounded-lg mb-3">
                @elseif ($current[$key] ?? null)
                    <img src="{{ Storage::url($current[$key]) }}" class="w-full h-40 object-cover rounded-lg mb-3">
                @else
                    <div class="w-full h-40 bg-slate-100 rounded-lg mb-3 flex items-center justify-center text-slate-400 text-xs">
                        Belum ada gambar (pakai default)
                    </div>
                @endif

                <input type="file" wire:model="uploads.{{ $key }}" class="border border-slate-300 rounded-lg px-3 py-2 w-full text-xs mb-2">
                @error("uploads.$key") <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
                <div wire:loading wire:target="uploads.{{ $key }}" class="text-xs text-slate-400 mb-2">Mengupload...</div>

                <button wire:click="simpanSatu('{{ $key }}')"
                        class="bg-rose-700 hover:bg-rose-800 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                    Simpan Gambar Ini
                </button>
            </div>
        @endforeach
    </div>


    <!-- ====================================================== -->
    <!-- GALERI (BISA LEBIH DARI 1 FOTO PER UNIT USAHA) -->
    <!-- ====================================================== -->
    <div class="mt-10">
        <h2 class="text-lg font-bold text-slate-800 mb-1">Galeri Foto Unit Usaha</h2>
        <p class="text-slate-500 text-sm mb-4">Upload beberapa foto sekaligus untuk tiap unit usaha. Foto-foto ini akan tampil bergantian otomatis di halaman Unit Usaha.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach ($gallerySlots as $key => $label)
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <p class="text-sm font-semibold text-slate-700 mb-3">{{ $label }}</p>

                    <!-- Thumbnail foto yang sudah tersimpan -->
                    @if (!empty($galleryCurrent[$key]))
                        <div class="grid grid-cols-3 gap-2 mb-3">
                            @foreach ($galleryCurrent[$key] as $index => $path)
                                <div class="relative group">
                                    <img src="{{ Storage::url($path) }}" class="w-full h-16 object-cover rounded-lg">
                                    <button
                                        wire:click="hapusFotoGaleri('{{ $key }}', {{ $index }})"
                                        wire:confirm="Yakin mau hapus foto ini dari galeri?"
                                        type="button"
                                        class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-rose-700 text-white text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        ✕
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="w-full h-16 bg-slate-100 rounded-lg mb-3 flex items-center justify-center text-slate-400 text-xs">
                            Belum ada foto galeri
                        </div>
                    @endif

                    <!-- Preview foto baru yang mau diupload -->
                    @if (!empty($galleryUploads[$key]))
                        <div class="grid grid-cols-3 gap-2 mb-2">
                            @foreach ($galleryUploads[$key] as $file)
                                <img src="{{ $file->temporaryUrl() }}" class="w-full h-16 object-cover rounded-lg border-2 border-rose-300">
                            @endforeach
                        </div>
                    @endif

                    <input
                        type="file"
                        multiple
                        wire:model="galleryUploads.{{ $key }}"
                        class="border border-slate-300 rounded-lg px-3 py-2 w-full text-xs mb-2"
                    >
                    @error("galleryUploads.$key.*") <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
                    <div wire:loading wire:target="galleryUploads.{{ $key }}" class="text-xs text-slate-400 mb-2">Mengupload...</div>

                    <button wire:click="simpanGaleri('{{ $key }}')"
                            class="bg-rose-700 hover:bg-rose-800 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                        Tambahkan ke Galeri
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>