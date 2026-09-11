<div class="p-6 md:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Kelola Fasilitas</h1>
        <p class="text-slate-500 text-sm">Fasilitas yang bisa dicentang di form Armada.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="simpan" class="mb-6 flex gap-2 max-w-lg">
        <input type="text" wire:model="nama_fasilitas" placeholder="Nama fasilitas (misal: AC, TV)"
               class="border border-slate-300 rounded-lg px-3 py-2.5 flex-1 focus:outline-none focus:ring-2 focus:ring-rose-700">
        <button type="submit" class="bg-rose-700 hover:bg-rose-800 text-white px-5 py-2.5 rounded-lg text-sm font-semibold whitespace-nowrap">
            {{ $isEdit ? 'Update' : 'Tambah' }}
        </button>
        @if ($isEdit)
            <button type="button" wire:click="batal" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-lg text-sm">Batal</button>
        @endif
    </form>
    @error('nama_fasilitas') <span class="text-red-500 text-sm block -mt-4 mb-4">{{ $message }}</span> @enderror

    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden max-w-lg">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase">
                    <th class="p-3 text-left">Nama Fasilitas</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($daftarFasilitas as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="p-3 text-slate-700">{{ $item->nama_fasilitas }}</td>
                        <td class="p-3 space-x-2">
                            <button wire:click="edit({{ $item->id }})" class="text-rose-700 hover:underline text-sm font-medium">Edit</button>
                            <button wire:click="hapus({{ $item->id }})" wire:confirm="Yakin mau hapus?" class="text-slate-400 hover:text-red-600 text-sm font-medium">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="p-6 text-center text-slate-400">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>