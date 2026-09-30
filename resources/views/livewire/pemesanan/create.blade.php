<div class="py-10 px-6 md:px-12 max-w-5xl mx-auto min-h-screen">

    <!-- HEADER -->
    <div class="mb-8">
        <nav class="text-xs text-slate-500 mb-3 flex items-center gap-2 font-medium">
            <a href="{{ route('armada.katalog') }}"
               class="hover:text-rose-700 transition">
                Unit Usaha
            </a>

            <span class="text-slate-300">/</span>

            <a href="{{ route('armada.detail', $armada->slug ?? $armada->id) }}"
               class="hover:text-rose-700 transition">
                {{ $armada->nama_bus }}
            </a>

            <span class="text-slate-300">/</span>

            <span class="font-bold text-rose-700">
                Form Pemesanan
            </span>
        </nav>

        <div class="bg-white border border-slate-200/80 rounded-3xl p-7 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

            <div>
                <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-600 text-[11px] font-bold px-3 py-1 rounded-full mb-3">
                    FORM RESERVASI ARMADA
                </span>

                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Form Pemesanan Bus
                </h1>

                <p class="text-slate-500 text-sm mt-1">
                    {{ $armada->nama_bus }}
                    &mdash;
                    <span class="font-semibold text-slate-700">
                        {{ $armada->kapasitas }} Kursi
                    </span>
                </p>
            </div>

            <span class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold px-3.5 py-1.5 rounded-full self-start md:self-auto">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Armada Tersedia
            </span>

        </div>
    </div>


    <!-- FORM CARD -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-7 md:p-10 shadow-sm">

        <!-- INFO BANNER -->
        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 mb-8 flex items-start gap-3">


            <p class="text-xs text-slate-600 leading-relaxed">
                Isi formulir di bawah ini dengan data yang benar dan lengkap.
                Tim kami akan menghubungi kamu untuk konfirmasi dan detail
                lebih lanjut mengenai pemesanan.
            </p>

        </div>


        <form wire:submit="simpan" class="space-y-6">

            <!-- ===================================================== -->
            <!-- SECTION 1 : DATA PEMESAN -->
            <!-- ===================================================== -->

            <div>

                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-5 flex items-center gap-2">

                    <span class="w-5 h-5 rounded-full bg-rose-700 text-white flex items-center justify-center text-[10px]">
                        1
                    </span>

                    Data Pemesan

                </h2>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- NAMA PEMESAN -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Nama Lengkap
                            <span class="text-rose-600">*</span>
                        </label>

                        <input
                            type="text"
                            wire:model="nama_pemesan"
                            placeholder="Masukkan nama lengkap pemesan..."
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                        @error('nama_pemesan')
                            <span class="text-rose-600 text-xs mt-1 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- INSTANSI -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Instansi / Perusahaan
                            <span class="text-slate-400 font-normal normal-case">
                                (opsional)
                            </span>
                        </label>

                        <input
                            type="text"
                            wire:model="instansi"
                            placeholder="Nama instansi atau perusahaan..."
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                    </div>


                    <!-- EMAIL -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Alamat Email
                            <span class="text-rose-600">*</span>
                        </label>

                        <input
                            type="email"
                            wire:model="email"
                            placeholder="contoh@email.com"
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                        @error('email')
                            <span class="text-rose-600 text-xs mt-1 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- NO HP -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            No. HP / WhatsApp
                            <span class="text-rose-600">*</span>
                        </label>

                        <input
                            type="text"
                            wire:model="no_hp"
                            placeholder="Contoh: 0812-3456-7890"
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                        @error('no_hp')
                            <span class="text-rose-600 text-xs mt-1 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

            </div>


            <div class="border-t border-slate-100"></div>


            <!-- ===================================================== -->
            <!-- SECTION 2 : DETAIL PERJALANAN -->
            <!-- ===================================================== -->

            <div>

                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-5 flex items-center gap-2">

                    <span class="w-5 h-5 rounded-full bg-rose-700 text-white flex items-center justify-center text-[10px]">
                        2
                    </span>

                    Detail Perjalanan

                </h2>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- TANGGAL BERANGKAT -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Tanggal Berangkat
                            <span class="text-rose-600">*</span>
                        </label>

                        <input
                            type="date"
                            wire:model.live="tanggal_berangkat"
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                        @error('tanggal_berangkat')
                            <span class="text-rose-600 text-xs mt-1 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- TANGGAL PULANG -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Tanggal Pulang
                            <span class="text-rose-600">*</span>
                        </label>

                        <input
                            type="date"
                            wire:model.live="tanggal_pulang"
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                        @error('tanggal_pulang')
                            <span class="text-rose-600 text-xs mt-1 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- LOKASI JEMPUTAN -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Lokasi Jemputan
                            <span class="text-rose-600">*</span>
                        </label>

                        <input
                            type="text"
                            wire:model="jemputan"
                            placeholder="Misal: Terminal Jepara"
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                        @error('jemputan')
                            <span class="text-rose-600 text-xs mt-1 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- TUJUAN PERJALANAN -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Tujuan Perjalanan
                            <span class="text-rose-600">*</span>
                        </label>

                        <input
                            type="text"
                            wire:model="tujuan"
                            placeholder="Misal: Yogyakarta - Malioboro"
                            class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
                        >

                        @error('tujuan')
                            <span class="text-rose-600 text-xs mt-1 block font-medium">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- JUMLAH PENUMPANG -->
<div>
    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
        Jumlah Penumpang <span class="text-rose-600">*</span>
    </label>

    <input
        type="number"
        wire:model.live="jumlah_penumpang"
        placeholder="Contoh: 40"
        min="1"
        class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition"
    >

    <p class="text-xs text-slate-400 mt-1.5">
        Kapasitas standar bus:
        <strong class="text-slate-600">{{ $armada->kapasitas }} kursi</strong>
    </p>

    <!-- INFO PEMESANAN LEBIH DARI 40 KURSI -->
    <div class="mt-3 bg-rose-50 border border-rose-200 rounded-xl p-3">
        <div class="flex items-start gap-2">

            <p class="text-[11px] text-rose-700 leading-relaxed">
                <strong>Bisa pesan lebih dari 40 kursi.</strong>
                Untuk jumlah penumpang lebih dari kapasitas standar,
                silakan masukkan sesuai kebutuhan. Permintaan akan
                dikonfirmasi oleh admin dan dapat dikenakan biaya tambahan.
            </p>
        </div>
    </div>

    <!-- PERINGATAN JIKA MELEBIHI KAPASITAS BUS -->
    @if ($jumlah_penumpang && $jumlah_penumpang > $armada->kapasitas)
        <div class="mt-3 bg-amber-50 border border-amber-200 rounded-xl p-3">
            <div class="flex items-start gap-2">

                <div>
                    <p class="text-xs font-bold text-amber-800">
                        Permintaan Kapasitas Khusus
                    </p>

                    <p class="text-[11px] text-amber-700 mt-1 leading-relaxed">
                        Jumlah penumpang yang kamu masukkan melebihi
                        kapasitas standar bus
                        ({{ $armada->kapasitas }} kursi).
                        Admin akan mengonfirmasi ketersediaan dan
                        biaya tambahan.
                    </p>
                </div>

            </div>
        </div>
    @endif

    @error('jumlah_penumpang')
        <span class="text-rose-600 text-xs mt-1 block font-medium">
            {{ $message }}
        </span>
    @enderror
</div>
                </div>

            </div>


            <div class="border-t border-slate-100"></div>


            <!-- ===================================================== -->
            <!-- SECTION 3 : CATATAN TAMBAHAN -->
            <!-- ===================================================== -->

            <div>

                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-5 flex items-center gap-2">

                    <span class="w-5 h-5 rounded-full bg-rose-700 text-white flex items-center justify-center text-[10px]">
                        3
                    </span>

                    Catatan Tambahan

                </h2>


                <div>

                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Catatan / Permintaan Khusus

                        <span class="text-slate-400 font-normal normal-case">
                            (opsional)
                        </span>
                    </label>

                    <textarea
                        wire:model="catatan"
                        rows="4"
                        placeholder="Tuliskan permintaan khusus, kebutuhan tambahan, atau informasi lain yang perlu diketahui tim kami..."
                        class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 outline-none transition resize-none"
                    ></textarea>

                </div>

            </div>


            <!-- ===================================================== -->
            <!-- SUBMIT -->
            <!-- ===================================================== -->

            <div class="pt-2">

                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 bg-rose-700 hover:bg-rose-800 text-white font-bold py-4 px-8 rounded-xl text-sm shadow-md shadow-rose-950/20 transition-all hover:scale-[1.01]"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                        />
                    </svg>

                    <span>
                        Kirim Formulir Pemesanan
                    </span>

                </button>

                <p class="text-center text-xs text-slate-400 mt-3">
                    Tim kami akan menghubungi kamu melalui WhatsApp / Email dalam 1×24 jam.
                </p>

            </div>

        </form>

    </div>

</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('redirect-wa', (event) => {
            let url = Array.isArray(event) ? event[0].url : event.url;
            window.location.href = url;
        });
    });
</script>