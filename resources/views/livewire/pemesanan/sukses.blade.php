<div class="px-6 md:px-12 py-16 max-w-lg mx-auto text-center">
    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
        ✓
    </div>

    <h1 class="text-2xl font-bold text-slate-800 mb-2">Pemesanan Berhasil!</h1>
    <p class="text-slate-500 mb-8">Terima kasih, pesanan kamu sedang menunggu konfirmasi dari admin.</p>

    <div class="bg-white border border-slate-200 rounded-xl p-6 text-left space-y-3 mb-6">
        <div class="flex justify-between border-b border-slate-100 pb-3">
            <span class="text-sm text-slate-500">Kode Pemesanan</span>
            <span class="font-bold text-rose-700">{{ $pemesanan->kode_pemesanan }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-sm text-slate-500">Armada</span>
            <span class="font-medium">{{ $pemesanan->armada->nama_bus ?? '-' }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-sm text-slate-500">Tanggal</span>
            <span class="font-medium">
                {{ \Carbon\Carbon::parse($pemesanan->tanggal_berangkat)->format('d M Y') }} -
                {{ \Carbon\Carbon::parse($pemesanan->tanggal_pulang)->format('d M Y') }}
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-sm text-slate-500">Tujuan</span>
            <span class="font-medium">{{ $pemesanan->tujuan }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-sm text-slate-500">Status</span>
            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium">{{ $pemesanan->status }}</span>
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('pemesanan.riwayat') }}"
           class="flex-1 bg-rose-700 hover:bg-rose-800 text-white font-semibold py-3 rounded-lg">
            Lihat Pesanan Saya
        </a>
        <a href="{{ route('armada.katalog') }}"
           class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-lg">
            Booking Bus Lain
        </a>
    </div>
</div>