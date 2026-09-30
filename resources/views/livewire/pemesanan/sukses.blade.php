<div class="px-6 md:px-12 py-16 max-w-lg mx-auto text-center">
    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
        ✓
    </div>

    <h1 class="text-2xl font-bold text-slate-800 mb-2">Pemesanan Berhasil!</h1>
    <p class="text-slate-500 mb-6">Terima kasih, pesanan kamu sedang menunggu konfirmasi dari admin.</p>

    <!-- BANNER PENTING: WAJIB KONFIRMASI WA -->
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 text-left flex items-start gap-3">
        <span class="text-amber-600 text-xl leading-none">!</span>
        <div>
            <p class="text-sm font-bold text-amber-800">
                Pemesanan belum diproses!
            </p>
            <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                Pesanan kamu <strong>belum akan ditindaklanjuti admin</strong> sebelum kamu konfirmasi via WhatsApp. Mohon jangan tutup halaman ini sebelum klik tombol konfirmasi di bawah.
            </p>
        </div>
    </div>

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

    <!-- TOMBOL WA - dibikin menonjol -->
    <a href="{{ $this->linkWa }}"
       target="_blank"
       class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-lg mb-2 shadow-lg shadow-green-500/30 animate-pulse">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12.001 2C6.478 2 2 6.478 2 12c0 1.788.472 3.51 1.363 5.024L2 22l5.108-1.34A9.955 9.955 0 0012.001 22C17.523 22 22 17.522 22 12S17.523 2 12.001 2zm0 18.001c-1.62 0-3.208-.436-4.593-1.262l-.33-.196-3.03.795.81-2.955-.215-.34A7.977 7.977 0 014 12c0-4.411 3.589-8 8.001-8C16.412 4 20 7.589 20 12s-3.588 8.001-7.999 8.001z"/>
        </svg>
        Konfirmasi Sekarang via WhatsApp
    </a>
    <p class="text-xs text-slate-400 mb-6">Klik tombol di atas untuk melanjutkan konfirmasi ke admin kami</p>

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