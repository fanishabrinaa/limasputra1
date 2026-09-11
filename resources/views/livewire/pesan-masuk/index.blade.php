<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Pesan Masuk</h1>
        <p class="text-slate-500 text-sm">
            Pesan dari form Kontak website.
            @if ($totalBelumDibaca > 0)
                <span class="text-rose-700 font-semibold">({{ $totalBelumDibaca }} belum dibaca)</span>
            @endif
        </p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">{{ session('message') }}</div>
    @endif

    <div class="mb-4">
        <label class="text-sm font-medium text-slate-600 mr-2">Filter:</label>
        <select wire:model.live="filterDibaca" class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua</option>
            <option value="0">Belum Dibaca</option>
            <option value="1">Sudah Dibaca</option>
        </select>
    </div>

    <div class="space-y-3">
        @forelse ($daftarPesan as $item)
            <div @class([
                'bg-white border rounded-xl p-5',
                'border-rose-200 bg-rose-50/30' => !$item->dibaca,
                'border-slate-200' => $item->dibaca,
            ])>
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-slate-800">{{ $item->nama }}</h3>
                            @if (!$item->dibaca)
                                <span class="bg-rose-700 text-white text-[10px] px-2 py-0.5 rounded-full font-semibold">BARU</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500">
                            {{ $item->whatsapp }}
                            @if ($item->email) • {{ $item->email }} @endif
                            • {{ $item->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                        {{ $item->layanan }}
                    </span>
                </div>

                <p class="text-sm text-slate-700 mb-3">{{ $item->pesan }}</p>

                <div class="flex gap-3 text-xs">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->whatsapp) }}" target="_blank"
                       class="text-green-600 font-medium hover:underline">Balas via WhatsApp</a>
                    @if (!$item->dibaca)
                        <button wire:click="tandaiDibaca({{ $item->id }})" class="text-blue-600 font-medium hover:underline">
                            Tandai Dibaca
                        </button>
                    @endif
                    <button wire:click="hapus({{ $item->id }})" wire:confirm="Yakin mau hapus pesan ini?"
                            class="text-slate-400 hover:text-red-600 font-medium">
                        Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-slate-400">Belum ada pesan masuk.</div>
        @endforelse
    </div>
</div>