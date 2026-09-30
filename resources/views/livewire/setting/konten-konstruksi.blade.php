<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm">
        <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-600 text-[11px] font-bold px-3 py-1 rounded-full mb-2">
            MODUL DASHBOARD
        </span>
        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Kelola Halaman Konstruksi</h1>
        <p class="text-sm text-slate-500 mt-1">Edit deskripsi hero dan daftar layanan yang tampil di halaman Konstruksi.</p>
    </div>

    <!-- FLASH MESSAGE -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span class="text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit="simpan" class="space-y-6">

        <!-- ====================================================== -->
        <!-- DESKRIPSI HERO -->
        <!-- ====================================================== -->
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm max-w-2xl">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Deskripsi Hero</h2>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi</label>
                <textarea wire:model="konstruksi_hero_desc" rows="3"
                          class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none"></textarea>
                @error('konstruksi_hero_desc') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- ====================================================== -->
        <!-- DAFTAR LAYANAN (DINAMIS) -->
        <!-- ====================================================== -->
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-900">Daftar Layanan</h2>
                <button type="button" wire:click="tambahLayanan"
                        class="inline-flex items-center gap-2 bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-md transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Tambah Layanan
                </button>
            </div>

            @error('konstruksi_layanan') <span class="text-rose-600 text-xs mb-3 block font-medium">{{ $message }}</span> @enderror

            <div class="space-y-4">
                @forelse ($konstruksi_layanan as $index => $layanan)
                    <div wire:key="layanan-{{ $index }}" class="border border-slate-200 rounded-2xl p-5 relative bg-slate-50/50">
                        <button type="button" wire:click="hapusLayanan({{ $index }})"
                                wire:confirm="Yakin mau hapus layanan ini?"
                                class="absolute top-4 right-4 w-7 h-7 rounded-full bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold flex items-center justify-center transition"
                                title="Hapus layanan">
                            ✕
                        </button>

                        <div class="grid grid-cols-1 gap-4 pr-10">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Judul Layanan</label>
                                <input type="text" wire:model="konstruksi_layanan.{{ $index }}.title"
                                       placeholder="Contoh: Pembangunan Gedung"
                                       class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none">
                                @error("konstruksi_layanan.$index.title") <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi Layanan</label>
                                <textarea wire:model="konstruksi_layanan.{{ $index }}.desc" rows="2"
                                          placeholder="Jelaskan singkat layanan ini..."
                                          class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none"></textarea>
                                @error("konstruksi_layanan.$index.desc") <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 text-sm py-10">
                        Belum ada layanan. Klik "Tambah Layanan" untuk menambahkan.
                    </div>
                @endforelse
            </div>
        </div>

        <div>
            <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white font-bold px-6 py-3 rounded-xl shadow-md text-sm">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>