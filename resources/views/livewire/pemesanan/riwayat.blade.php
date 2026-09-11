<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Pesanan Saya</h1>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">{{ session('message') }}</div>
    @endif

    <div class="space-y-3">
        @forelse ($daftarPemesanan as $item)
            <div class="border rounded p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{ $item->armada->nama_bus ?? '-' }}</p>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($item->tanggal_pulang)->format('d M Y') }}
                        </p>
                        <p class="text-xs text-gray-400">Kode: {{ $item->kode_pemesanan }}</p>
                    </div>
                    <span @class([
                        'px-2 py-1 rounded text-xs',
                        'bg-yellow-100 text-yellow-700' => $item->status === 'Menunggu',
                        'bg-blue-100 text-blue-700' => $item->status === 'Disetujui',
                        'bg-green-100 text-green-700' => $item->status === 'Selesai',
                        'bg-red-100 text-red-700' => $item->status === 'Ditolak',
                    ])>
                        {{ $item->status }}
                    </span>
                </div>

                @if ($item->status === 'Ditolak' && $item->alasan_penolakan)
                    <p class="text-xs text-red-600 mt-2 bg-red-50 p-2 rounded">
                        <strong>Alasan:</strong> {{ $item->alasan_penolakan }}
                    </p>
                @endif

                @if ($item->status === 'Selesai')
                    @if ($item->testimoni)
                        <div class="mt-3 bg-slate-50 border border-slate-200 rounded-lg p-3">
                            <p class="text-xs text-slate-500 mb-1">
                                Testimonimu {{ $item->testimoni->tampilkan ? '(sudah tayang)' : '(menunggu persetujuan admin)' }}:
                            </p>
                            <p class="text-yellow-400 text-sm">{{ str_repeat('★', $item->testimoni->rating) }}{{ str_repeat('☆', 5 - $item->testimoni->rating) }}</p>
                            <p class="text-sm text-slate-600 italic">"{{ $item->testimoni->pesan }}"</p>
                        </div>
                    @else
                        <button wire:click="bukaModalTestimoni({{ $item->id }})"
                                class="mt-3 bg-rose-700 hover:bg-rose-800 text-white text-xs font-semibold px-4 py-2 rounded-lg">
                            ⭐ Beri Testimoni
                        </button>
                    @endif
                @endif
            </div>
        @empty
            <p class="text-gray-400">Kamu belum pernah memesan.</p>
        @endforelse
    </div>

    @if ($showModalTestimoni)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
                <h3 class="font-bold text-lg mb-1">Beri Testimoni</h3>
                <p class="text-sm text-slate-500 mb-4">{{ $pemesananDipilih->armada->nama_bus ?? '' }}</p>

                <label class="block text-sm font-medium mb-1">Rating</label>
                <select wire:model="rating" class="border border-slate-300 rounded-lg px-3 py-2.5 w-full mb-3">
                    <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                    <option value="4">⭐⭐⭐⭐ Puas</option>
                    <option value="3">⭐⭐⭐ Cukup</option>
                    <option value="2">⭐⭐ Kurang</option>
                    <option value="1">⭐ Buruk</option>
                </select>

                <label class="block text-sm font-medium mb-1">Pesan Testimoni</label>
                <textarea wire:model="pesan" rows="4" placeholder="Ceritakan pengalamanmu naik bus ini..."
                          class="border border-slate-300 rounded-lg px-3 py-2.5 w-full"></textarea>
                @error('pesan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <div class="flex gap-2 mt-4">
                    <button wire:click="kirimTestimoni" class="bg-rose-700 hover:bg-rose-800 text-white px-4 py-2.5 rounded-lg flex-1 text-sm font-semibold">
                        Kirim Testimoni
                    </button>
                    <button wire:click="$set('showModalTestimoni', false)" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-lg flex-1 text-sm font-semibold">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>