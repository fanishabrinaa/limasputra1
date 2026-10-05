{{-- Halaman admin untuk mengelola data armada, fasilitas, dan gambar katalog. --}}
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-[11px] font-bold px-3 py-1 rounded-full mb-2">
                MODUL DASHBOARD
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Kelola Armada</h1>
            <p class="text-sm text-slate-500 mt-1">Data unit bus pariwisata: plat nomor, kapasitas, status, dan fasilitas.</p>
        </div>

        @if (!$showForm)
            <button wire:click="bukaForm"
                    class="bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold px-5 py-3 rounded-xl shadow-md transition-all duration-300 hover:scale-[1.02] flex items-center justify-center gap-2 w-full md:w-auto">
                + Tambah Armada
            </button>
        @endif
    </div>

    <!-- FLASH MESSAGE -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span class="text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <!-- ====================================================== -->
    <!-- KONTEN TEKS HERO KATALOG -->
    <!-- ====================================================== -->
    @if (!$showForm)
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Konten Teks Hero Katalog</h2>
            <div class="space-y-4 max-w-2xl">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Judul Hero</label>
                    <input type="text" wire:model="katalog_judul" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                    @error('katalog_judul') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi Hero</label>
                    <textarea wire:model="katalog_deskripsi" rows="3" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none"></textarea>
                    @error('katalog_deskripsi') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-4 mt-2">
                <button wire:click="simpanTeks" class="bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold px-6 py-3 rounded-xl shadow-md">
                    Simpan Perubahan Teks
                </button>
            </div>
        </div>
    @endif
    <!-- FLASH MESSAGE -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span class="text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    @if (!$showForm)
        <!-- DATA TABLE CONTAINER -->
        <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm overflow-hidden">

            <!-- MOBILE: CARD LIST -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse ($daftarArmada as $item)
                    <div class="p-4 flex gap-4">
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" class="w-20 h-20 object-cover rounded-xl flex-shrink-0">
                        @else
                            <div class="w-20 h-20 rounded-xl bg-slate-100 flex-shrink-0"></div>
                        @endif

                        <div class="flex-1 min-w-0 space-y-1.5">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-bold text-slate-900 text-sm">{{ $item->nama_bus }}</h3>
                                <span @class([
                                    'text-[10px] font-bold uppercase px-2 py-0.5 rounded-full flex-shrink-0',
                                    'bg-emerald-50 text-emerald-700' => $item->status === 'tersedia',
                                    'bg-amber-50 text-amber-700' => $item->status === 'disewa',
                                    'bg-slate-100 text-slate-600' => $item->status === 'perbaikan',
                                ])>
                                    {{ $item->status }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-500">{{ $item->plat_nomor }} &middot; {{ $item->kapasitas }} orang</p>
                            <p class="text-[11px] text-slate-400 line-clamp-1">
                                {{ $item->fasilitas->pluck('nama_fasilitas')->join(', ') ?: 'Belum ada fasilitas' }}
                            </p>
                            <div class="flex gap-2 pt-1.5">
                                <button wire:click="edit({{ $item->id }})"
                                        class="flex-1 px-3 py-2 bg-blue-50 text-blue-700 rounded-lg font-bold text-xs">
                                    Edit
                                </button>
                                <button wire:click="hapus({{ $item->id }})"
                                        wire:confirm="Yakin mau hapus?"
                                        class="flex-1 px-3 py-2 bg-rose-50 text-rose-700 rounded-lg font-bold text-xs">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center text-slate-400 text-sm">Belum ada data</div>
                @endforelse
            </div>

            <!-- DESKTOP: TABEL -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                            <th class="p-4 pl-6">Gambar</th>
                            <th class="p-4">Nama Bus</th>
                            <th class="p-4">Plat Nomor</th>
                            <th class="p-4">Kapasitas</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Fasilitas</th>
                            <th class="p-4 text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($daftarArmada as $item)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="p-4 pl-6">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}" class="w-16 h-16 object-cover rounded-xl">
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-slate-100"></div>
                                    @endif
                                </td>
                                <td class="p-4 font-bold text-slate-900">{{ $item->nama_bus }}</td>
                                <td class="p-4 text-slate-600">{{ $item->plat_nomor }}</td>
                                <td class="p-4 text-slate-600">{{ $item->kapasitas }} orang</td>
                                <td class="p-4">
                                    <span @class([
                                        'text-[10px] font-bold uppercase px-2.5 py-1 rounded-full',
                                        'bg-emerald-50 text-emerald-700' => $item->status === 'tersedia',
                                        'bg-amber-50 text-amber-700' => $item->status === 'disewa',
                                        'bg-slate-100 text-slate-600' => $item->status === 'perbaikan',
                                    ])>
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-slate-500 max-w-[220px] truncate">
                                    {{ $item->fasilitas->pluck('nama_fasilitas')->join(', ') ?: '-' }}
                                </td>
                                <td class="p-4 pr-6 text-right whitespace-nowrap">
                                    <button wire:click="edit({{ $item->id }})" class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg font-bold text-xs">Edit</button>
                                    <button wire:click="hapus({{ $item->id }})" wire:confirm="Yakin mau hapus?" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg font-bold text-xs ml-1.5">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="p-12 text-center text-slate-400">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- FORM TAMBAH/EDIT -->
        <form wire:submit="simpan" class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm space-y-4 max-w-xl">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Bus</label>
                <input type="text" wire:model="nama_bus" class="border border-slate-300 rounded-xl px-3 py-2.5 w-full">
                @error('nama_bus') <span class="text-rose-600 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Plat Nomor</label>
                <input type="text" wire:model="plat_nomor" class="border border-slate-300 rounded-xl px-3 py-2.5 w-full">
                @error('plat_nomor') <span class="text-rose-600 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
    <label class="block text-sm font-semibold text-slate-700 mb-1">
        Kapasitas Bus (orang)
    </label>

    <input
        type="number"
        wire:model="kapasitas"
        min="40"
        max="60"
        class="border border-slate-300 rounded-xl px-3 py-2.5 w-full"
        placeholder="Contoh: 40"
    >

    <p class="text-xs text-slate-400 mt-1">
        Kapasitas standar bus adalah 40–60 orang.
    </p>

    @error('kapasitas')
        <span class="text-rose-600 text-xs">{{ $message }}</span>
    @enderror
</div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Status</label>
                <select wire:model="status" class="border border-slate-300 rounded-xl px-3 py-2.5 w-full">
                    <option value="tersedia">Tersedia</option>
                    <option value="disewa">Disewa</option>
                    <option value="perbaikan">Perbaikan</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="3" class="border border-slate-300 rounded-xl px-3 py-2.5 w-full"></textarea>
                @error('deskripsi') <span class="text-rose-600 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Gambar</label>
                <input type="file" wire:model="gambar" class="border border-slate-300 rounded-xl px-3 py-2.5 w-full text-sm">
                @error('gambar') <span class="text-rose-600 text-xs">{{ $message }}</span> @enderror
                <div wire:loading wire:target="gambar" class="text-xs text-slate-400 mt-1">Mengupload...</div>
                @if ($gambar)
                    <img src="{{ $gambar->temporaryUrl() }}" class="w-24 h-24 object-cover rounded-xl mt-2">
                @elseif ($gambar_lama)
                    <img src="{{ Storage::url($gambar_lama) }}" class="w-24 h-24 object-cover rounded-xl mt-2">
                @endif
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Galeri Foto Tambahan (boleh pilih banyak)</label>
                <input type="file" wire:model="galeriBaru" multiple class="border border-slate-300 rounded-xl px-3 py-2.5 w-full text-sm">
                <div class="flex gap-3 mt-2 flex-wrap">
    @foreach ($galeri_lama ?? [] as $index => $g)
        <div class="relative">
            <img
                src="{{ Storage::url($g) }}"
                class="w-20 h-20 object-cover rounded-xl"
            >

            <button
                type="button"
                wire:click="hapusGaleri({{ $index }})"
                wire:confirm="Yakin mau menghapus foto ini?"
                class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-md"
                title="Hapus foto"
            >
                ×
            </button>
        </div>
    @endforeach
</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Fasilitas</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach ($daftarFasilitas as $f)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" wire:model="selectedFasilitas" value="{{ $f->id }}">
                            {{ $f->nama_fasilitas }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white px-5 py-3 rounded-xl font-bold text-sm">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>
                <button type="button" wire:click="batal" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-3 rounded-xl font-bold text-sm">
                    Batal
                </button>
            </div>
        </form>
    @endif
</div>