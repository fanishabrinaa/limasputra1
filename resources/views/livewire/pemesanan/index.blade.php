<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-[11px] font-bold px-3 py-1 rounded-full mb-2 backdrop-blur-md">
                MODUL DASHBOARD
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Kelola Pemesanan</h1>
            <p class="text-sm text-slate-500 mt-1">Riwayat transaksi dan status booking armada bus dari customer.</p>
        </div>

        {{-- Pilihan ini menyaring daftar pemesanan berdasarkan statusnya. --}}
        <!-- FILTER STATUS -->
        <div class="flex items-center gap-3 bg-slate-50 border border-slate-200/80 p-2 rounded-2xl">
            <label class="text-xs font-bold uppercase tracking-wider text-slate-500 pl-2">Filter Status:</label>
            <select wire:model.live="filterStatus" 
                    class="bg-white border border-slate-300 text-slate-800 text-xs font-bold rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition cursor-pointer">
                <option value="">Semua Status</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Selesai">Selesai</option>
                <option value="Ditolak"> Ditolak</option>
            </select>
        </div>
    </div>

    <!-- FLASH MESSAGE ALERT -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl flex items-center gap-3 shadow-sm animate-fade-in">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span class="text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

        <!-- DATA TABLE CONTAINER -->
    <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm overflow-hidden">

        <!-- MOBILE: CARD LIST (di bawah md) -->
        <div class="md:hidden divide-y divide-slate-100">
            @forelse ($daftarPemesanan as $item)
                <div class="p-4 space-y-3">
                    <div class="flex justify-between items-start gap-2">
                        <span class="bg-slate-100 text-slate-800 px-2.5 py-1 rounded-lg border border-slate-200 font-mono font-bold text-xs">
                            {{ $item->kode_pemesanan }}
                        </span>
                        <div class="flex flex-col items-end gap-1">
                            <span @class([
                                'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold border flex-shrink-0',
                                'bg-amber-50 text-amber-700 border-amber-200' => $item->status === 'Menunggu',
                                'bg-blue-50 text-blue-700 border-blue-200' => $item->status === 'Disetujui',
                                'bg-emerald-50 text-emerald-700 border-emerald-200' => $item->status === 'Selesai',
                                'bg-rose-50 text-rose-700 border-rose-200' => $item->status === 'Ditolak',
                            ])>
                                {{ $item->status }}
                            </span>
                            @if ($item->status === 'Menunggu' && $item->created_at->diffInHours(now()) > 24)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                    ⚠ Lama
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <p class="font-bold text-slate-900 text-sm">{{ $item->nama_pemesan }}</p>
                        <p class="text-[11px] text-slate-400 font-medium">{{ $item->no_hp }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs bg-slate-50 rounded-xl p-3">
                        <div class="col-span-2">
                            <div class="flex items-center gap-3">
                                @if ($item->armada && $item->armada->gambar)
                                    <img src="{{ Storage::url($item->armada->gambar) }}"
                                         alt="{{ $item->armada->nama_bus }}"
                                         class="w-12 h-9 object-cover rounded-lg border border-slate-200">
                                @else
                                    <div class="w-12 h-9 bg-slate-100 rounded-lg flex items-center justify-center text-lg">
                                        🚌
                                    </div>
                                @endif

                                <div>
                                    <p class="font-bold text-slate-800">
                                        {{ $item->armada->kode_bus ?? '-' }}
                                    </p>
                                    <p class="text-[11px] text-slate-500">
                                        {{ $item->armada->nama_bus ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase font-bold mb-0.5">Penumpang</span>
                            <span class="font-bold text-rose-700">{{ $item->jumlah_penumpang }} Orang</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold mb-0.5">Tanggal Sewa</span>
                            <span class="font-medium text-slate-600">
                                {{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }}
                                <span class="text-slate-300">→</span>
                                {{ \Carbon\Carbon::parse($item->tanggal_pulang)->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    @if ($item->status === 'Ditolak' && $item->alasan_penolakan)
                        <p class="text-[11px] text-rose-600 font-medium leading-tight bg-rose-50/50 p-2 rounded-lg border border-rose-100">
                            {{ $item->alasan_penolakan }}
                        </p>
                    @endif

                    <div class="flex items-center gap-2 pt-1">
                        @if ($item->status === 'Menunggu')
                            <button wire:click="ubahStatus({{ $item->id }}, 'Disetujui')"
                                    class="flex-1 px-3 py-2.5 bg-blue-50 text-blue-700 rounded-xl font-bold text-xs">
                                ✓ Konfirmasi
                            </button>
                            <button wire:click="bukaModalTolak({{ $item->id }})"
                                    class="flex-1 px-3 py-2.5 bg-rose-50 text-rose-700 rounded-xl font-bold text-xs">
                                ✕ Tolak
                            </button>
                        @elseif ($item->status === 'Disetujui')
                            <button wire:click="ubahStatus({{ $item->id }}, 'Selesai')"
                                    class="flex-1 px-3 py-2.5 bg-emerald-50 text-emerald-700 rounded-xl font-bold text-xs">
                                ✓ Selesai
                            </button>
                        @endif
                        <button
                        type="button"
                        onclick="document.getElementById('detail-{{ $item->id }}').showModal()"
                        class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition"
                        title="Lihat Detail">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z"/>
                            <circle cx="12" cy="12" r="2.5"/>
                        </svg>
                    </button>
                        <button wire:click="hapus({{ $item->id }})"
                                wire:confirm="Yakin mau hapus data pemesanan ini?"
                                class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-xl flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-3 text-xl">📋</div>
                    <h4 class="text-base font-bold text-slate-800">Belum Ada Data Pemesanan</h4>
                    <p class="text-xs text-slate-500 mt-1">Belum ada riwayat booking yang sesuai dengan filter ini.</p>
                </div>
            @endforelse
        </div>

        <!-- DESKTOP: TABEL (md ke atas) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                        <th class="p-4 pl-6">Kode Booking</th>
                        <th class="p-4">Pemesan</th>
                        <th class="p-4">Unit Armada</th>
                        <th class="p-4">Tanggal Sewa</th>
                        <th class="p-4">Jumlah</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right pr-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($daftarPemesanan as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="p-4 pl-6 font-mono font-bold text-slate-900 text-xs">
                                <span class="bg-slate-100 text-slate-800 px-2.5 py-1 rounded-lg border border-slate-200">
                                    {{ $item->kode_pemesanan }}
                                </span>
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-slate-900 text-sm mb-0.5">{{ $item->nama_pemesan }}</p>
                                <p class="text-[11px] text-slate-400 font-medium">{{ $item->no_hp }}</p>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    @if ($item->armada && $item->armada->gambar)
                                        <img src="{{ Storage::url($item->armada->gambar) }}"
                                             alt="{{ $item->armada->nama_bus }}"
                                             class="w-12 h-9 object-cover rounded-lg border border-slate-200">
                                    @else
                                        <div class="w-12 h-9 bg-slate-100 rounded-lg flex items-center justify-center text-lg">
                                            🚌
                                        </div>
                                    @endif

                                    <div>
                                        <p class="font-bold text-slate-800">
                                            {{ $item->armada->kode_bus ?? '-' }}
                                        </p>
                                        <p class="text-[11px] text-slate-500">
                                            {{ $item->armada->nama_bus ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-slate-600 font-medium whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }}</span>
                                    <span class="text-slate-300">→</span>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_pulang)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="bg-rose-50 text-rose-700 font-bold px-2.5 py-1 rounded-lg text-xs">
                                    {{ $item->jumlah_penumpang }} Orang
                                </span>
                            </td>
                            <td class="p-4">
                                <span @class([
                                    'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold border',
                                    'bg-amber-50 text-amber-700 border-amber-200' => $item->status === 'Menunggu',
                                    'bg-blue-50 text-blue-700 border-blue-200' => $item->status === 'Disetujui',
                                    'bg-emerald-50 text-emerald-700 border-emerald-200' => $item->status === 'Selesai',
                                    'bg-rose-50 text-rose-700 border-rose-200' => $item->status === 'Ditolak',
                                ])>
                                    @if ($item->status === 'Menunggu')
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    @elseif ($item->status === 'Disetujui')
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    @elseif ($item->status === 'Selesai')
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    @elseif ($item->status === 'Ditolak')
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    @endif
                                    {{ $item->status }}
                                </span>
                                @if ($item->status === 'Menunggu' && $item->created_at->diffInHours(now()) > 24)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200 mt-1.5">
                                        ⚠ Lama
                                    </span>
                                @endif
                                @if ($item->status === 'Ditolak' && $item->alasan_penolakan)
                                    <p class="text-[11px] text-rose-600 font-medium mt-1.5 leading-tight max-w-[160px] bg-rose-50/50 p-2 rounded-lg border border-rose-100">
                                        {{ $item->alasan_penolakan }}
                                    </p>
                                @endif
                            </td>
                            <td class="p-4 pr-6 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    @if ($item->status === 'Menunggu')
                                        <button wire:click="ubahStatus({{ $item->id }}, 'Disetujui')"
                                                class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl font-bold transition text-xs">
                                            ✓ Konfirmasi
                                        </button>
                                        <button wire:click="bukaModalTolak({{ $item->id }})"
                                                class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-xl font-bold transition text-xs">
                                            ✕ Tolak
                                        </button>
                                    @elseif ($item->status === 'Disetujui')
                                        <button wire:click="ubahStatus({{ $item->id }}, 'Selesai')"
                                                class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-xl font-bold transition text-xs">
                                            ✓ Selesai
                                        </button>
                                    @endif
                                    <button wire:click="hapus({{ $item->id }})"
                                            wire:confirm="Yakin mau hapus data pemesanan ini?"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-xl transition"
                                            title="Hapus Pemesanan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- MODAL DETAIL PEMESANAN -->
                        <dialog id="detail-{{ $item->id }}"
                                class="backdrop:bg-slate-950/60 backdrop:backdrop-blur-sm rounded-3xl p-0 w-full max-w-lg shadow-2xl">

                            <div class="bg-white rounded-3xl overflow-hidden">

                                <!-- FOTO BUS -->
                                <div class="relative h-56 bg-slate-100">
                                    @if ($item->armada && $item->armada->gambar)
                                        <img src="{{ Storage::url($item->armada->gambar) }}"
                                             alt="{{ $item->armada->nama_bus }}"
                                             class="w-full h-full object-cover">
                                    @else

                                    @endif

                                    <button
                                        onclick="document.getElementById('detail-{{ $item->id }}').close()"
                                        class="absolute top-4 right-4 w-9 h-9 bg-white/90 hover:bg-white rounded-full text-slate-600 font-bold shadow">
                                        ✕
                                    </button>
                                </div>

                                <!-- DETAIL -->
                                <div class="p-6">

                                    <div class="mb-5">
                                        <p class="text-[10px] uppercase tracking-wider font-bold text-rose-500">
                                            Detail Pemesanan
                                        </p>

                                        <h3 class="text-xl font-extrabold text-slate-900 mt-1">
                                            {{ $item->armada->nama_bus ?? 'Armada Tidak Ditemukan' }}
                                        </h3>

                                        <p class="text-xs text-slate-400 font-mono mt-1">
                                            {{ $item->kode_pemesanan }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">

                                        <div class="bg-slate-50 rounded-xl p-3">
                                            <p class="text-[10px] uppercase font-bold text-slate-400">
                                                Pemesan
                                            </p>
                                            <p class="text-sm font-bold text-slate-800 mt-1">
                                                {{ $item->nama_pemesan }}
                                            </p>
                                        </div>

                                        <div class="bg-slate-50 rounded-xl p-3">
                                            <p class="text-[10px] uppercase font-bold text-slate-400">
                                                WhatsApp
                                            </p>
                                            <p class="text-sm font-bold text-slate-800 mt-1">
                                                {{ $item->no_hp }}
                                            </p>
                                        </div>

                                        <div class="bg-slate-50 rounded-xl p-3">
                                            <p class="text-[10px] uppercase font-bold text-slate-400">
                                                Tanggal Sewa
                                            </p>
                                            <p class="text-sm font-bold text-slate-800 mt-1">
                                                {{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }}
                                                →
                                                {{ \Carbon\Carbon::parse($item->tanggal_pulang)->format('d M Y') }}
                                            </p>
                                        </div>

                                        <div class="bg-rose-50 rounded-xl p-3">
                                            <p class="text-[10px] uppercase font-bold text-rose-400">
                                                Penumpang
                                            </p>
                                            <p class="text-sm font-bold text-rose-700 mt-1">
                                                {{ $item->jumlah_penumpang }} Orang
                                            </p>
                                        </div>

                                    </div>

                                    <!-- STATUS -->
                                    <div class="mt-4 flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-400 uppercase">
                                            Status
                                        </span>

                                        <div class="flex flex-col items-end gap-1">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                                @if($item->status === 'Menunggu')
                                                    bg-amber-50 text-amber-700
                                                @elseif($item->status === 'Disetujui')
                                                    bg-blue-50 text-blue-700
                                                @elseif($item->status === 'Selesai')
                                                    bg-emerald-50 text-emerald-700
                                                @else
                                                    bg-rose-50 text-rose-700
                                                @endif">
                                                {{ $item->status }}
                                            </span>
                                            @if ($item->status === 'Menunggu' && $item->created_at->diffInHours(now()) > 24)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                                    ⚠ Lama
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($item->status === 'Ditolak' && $item->alasan_penolakan)
                                        <div class="mt-4 bg-rose-50 border border-rose-100 rounded-xl p-3">
                                            <p class="text-[10px] uppercase font-bold text-rose-400">
                                                Alasan Penolakan
                                            </p>
                                            <p class="text-xs text-rose-700 mt-1">
                                                {{ $item->alasan_penolakan }}
                                            </p>
                                        </div>
                                    @endif

                                    <button
                                        onclick="document.getElementById('detail-{{ $item->id }}').close()"
                                        class="w-full mt-6 bg-slate-900 hover:bg-slate-800 text-white py-3 rounded-xl text-xs font-bold transition">
                                        Tutup
                                    </button>

                                </div>
                            </div>
                        </dialog>
                    @empty
                        <tr>
                            <td colspan="7" class="p-12 text-center">
                                <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-3 text-xl">📋</div>
                                <h4 class="text-base font-bold text-slate-800">Belum Ada Data Pemesanan</h4>
                                <p class="text-xs text-slate-500 mt-1">Belum ada riwayat booking yang sesuai dengan filter ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

       <!-- MODAL PENOLAKAN PEMESANAN -->
    @if ($showModalTolak)
        <div x-data x-effect="document.body.style.overflow = 'hidden'" x-on:remove="document.body.style.overflow = ''">
            <template x-teleport="body">
                <div class="fixed inset-0 z-[100] flex items-center justify-center p-4">

                    {{-- Latar gelap --}}
                    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
                         wire:click="$set('showModalTolak', false)"></div>

                    {{-- Kotak modal --}}
                    <div class="relative bg-white rounded-3xl p-6 md:p-8 max-w-md w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-slate-100">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                            <h3 class="font-extrabold text-lg text-slate-900">Tolak Pemesanan</h3>
                            <button wire:click="$set('showModalTolak', false)" class="text-slate-400 hover:text-slate-600 text-sm">✕</button>
                        </div>

                        <p class="text-xs text-slate-500 mb-4">Tuliskan alasan penolakan untuk diinformasikan kepada pemesan.</p>

                        <div class="mb-5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Alasan Penolakan</label>
                            <textarea wire:model="alasanPenolakan"
                                      rows="3"
                                      class="w-full border border-slate-300 rounded-xl p-3 text-xs focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                                      placeholder="Contoh: Armada bus pada tanggal tersebut sudah penuh booked."></textarea>
                            @error('alasanPenolakan') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-3">
                            <button wire:click="konfirmasiTolak"
                                    class="bg-rose-700 hover:bg-rose-800 text-white px-5 py-3 rounded-xl flex-1 text-xs font-bold shadow-md transition">
                                Konfirmasi Penolakan
                            </button>
                            <button wire:click="$set('showModalTolak', false)"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-3 rounded-xl flex-1 text-xs font-bold transition">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    @endif
</div>