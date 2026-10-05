{{-- Halaman admin untuk mengelola, menyaring, dan menyetujui testimoni. --}}
<div class="p-6 md:p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kelola Testimoni</h1>
            <p class="text-slate-500 text-sm">Testimoni dari customer & yang tampil di halaman Detail Bus.</p>
        </div>
        @if (!$showForm)
            <button wire:click="bukaForm" class="bg-rose-700 hover:bg-rose-800 text-white px-4 py-2.5 rounded-lg text-sm font-semibold">
                + Tambah Testimoni
            </button>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">{{ session('message') }}</div>
    @endif

    @if (!$showForm)
        <!-- FILTER -->
        <div class="mb-4">
            <label class="text-sm font-medium text-slate-600 mr-2">Filter:</label>
            <select wire:model.live="filterTampilkan" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Semua</option>
                <option value="0">Menunggu Approval</option>
                <option value="1">Sudah Tayang</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($daftarTestimoni as $item)
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-bold text-slate-800">{{ $item->nama }}</p>
                            <p class="text-xs text-slate-500">{{ $item->jabatan }}{{ $item->perusahaan ? ', '.$item->perusahaan : '' }}</p>
                            <p class="text-xs text-rose-700 font-medium mt-0.5">
                                {{ $item->armada->nama_bus ?? 'Testimoni Umum' }}
                            </p>
                        </div>
                        @if (!$item->tampilkan)
                            <span class="bg-yellow-50 text-yellow-700 text-[10px] px-2 py-1 rounded-full">Menunggu Approval</span>
                        @endif
                    </div>
                    <p class="text-yellow-400 text-sm mb-2">{{ str_repeat('★', $item->rating) }}{{ str_repeat('☆', 5 - $item->rating) }}</p>
                    <p class="text-sm text-slate-600 italic mb-3">"{{ $item->pesan }}"</p>
                    <div class="space-x-2">
                        <button wire:click="toggleTampilkan({{ $item->id }})"
                                class="text-xs font-medium {{ $item->tampilkan ? 'text-slate-500' : 'text-green-600' }} hover:underline">
                            {{ $item->tampilkan ? 'Sembunyikan' : 'Tayangkan' }}
                        </button>
                        <button wire:click="edit({{ $item->id }})" class="text-rose-700 hover:underline text-xs font-medium">Edit</button>
                        <button wire:click="hapus({{ $item->id }})" wire:confirm="Yakin mau hapus?" class="text-slate-400 hover:text-red-600 text-xs font-medium">Hapus</button>
                    </div>
                </div>
            @empty
                <p class="text-slate-400 col-span-2 text-center py-10">Belum ada testimoni</p>
            @endforelse
        </div>
    @else
        <form wire:submit="simpan" class="bg-white border border-slate-200 rounded-xl p-6 space-y-4 max-w-lg">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Untuk Armada</label>
                <select wire:model="armada_id" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
                    <option value="">-- Umum (semua bus) --</option>
                    @foreach ($daftarArmada as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_bus }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                <input type="text" wire:model="nama" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
                @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan</label>
                    <input type="text" wire:model="jabatan" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Perusahaan</label>
                    <input type="text" wire:model="perusahaan" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Pesan Testimoni</label>
                <textarea wire:model="pesan" rows="4" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full"></textarea>
                @error('pesan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Rating</label>
                <select wire:model="rating" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full">
                    <option value="5">5 - Sangat Puas</option>
                    <option value="4">4 - Puas</option>
                    <option value="3">3 - Cukup</option>
                    <option value="2">2 - Kurang</option>
                    <option value="1">1 - Buruk</option>
                </select>
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" wire:model="tampilkan" class="rounded border-slate-300 text-rose-700">
                Tampilkan di Detail Bus
            </label>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white px-5 py-2.5 rounded-lg text-sm font-semibold">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>
                <button type="button" wire:click="batal" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-lg text-sm font-semibold">
                    Batal
                </button>
            </div>
        </form>
    @endif
</div>