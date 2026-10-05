{{-- Menampilkan informasi kontak perusahaan dan formulir pesan pengunjung. --}}
<div>
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- HERO HEADER SECTION -->
    <div class="relative bg-slate-950 text-white py-20 px-6 md:px-12 text-center overflow-hidden border-b border-slate-900">
        <div class="absolute inset-0 z-0">
        @php
            $hero = \App\Models\Setting::get('img_halaman_hero', \App\Models\Setting::get('img_unit_usaha_hero'));
        @endphp

        @if ($hero)
            <img src="{{ Storage::url($hero) }}"
                alt=""
                class="lp-hero-image w-full h-full object-cover opacity-90 brightness-110 scale-105 transition-transform duration-700">
        @endif

        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/40 via-slate-950/50 to-slate-950"></div>
    </div>  
    
    <!-- Ambient Glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-rose-600/10 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-5 backdrop-blur-md">
                LAYANAN PELANGGAN
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                Hubungi <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">Putra Limas</span>
            </h1>
            <p class="text-slate-300 text-base max-w-xl mx-auto leading-relaxed">
                Kami siap melayani kebutuhan transportasi pariwisata, material bangunan, dan proyek konstruksi Anda dengan profesionalisme tinggi.
            </p>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <main class="py-16 max-w-7xl mx-auto px-6 lg:px-8 bg-slate-50 min-h-screen">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LEFT COLUMN: INFORMASI KONTAK -->
            <div class="lg:col-span-5 space-y-5">

                <!-- Card 1: Alamat -->
                <div class="lp-scroll-zoom lp-motion-card bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 mb-1">Alamat Kantor Pusat</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ $alamat ?: 'Alamat belum diisi' }}
                        </p>
                    </div>
                </div>

                <!-- Card 2: Telepon & Email -->
                <div class="lp-scroll-zoom lp-motion-card bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-sm font-bold text-slate-900 mb-1">Telepon & Email</h3>
                        <p class="text-sm text-slate-600">Office: <span class="font-semibold text-slate-800">{{ $telepon ?: '-' }}</span></p>
                        <p class="text-sm text-slate-600">Email: <span class="font-semibold text-slate-800">{{ $email_perusahaan ?: '-' }}</span></p>
                    </div>
                </div>

                <!-- Card 3: Jam Operasional -->
                <div class="lp-scroll-zoom lp-motion-card bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="w-full">
                        <h3 class="text-sm font-bold text-slate-900 mb-3">Jam Operasional</h3>
                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between border-b border-slate-100 pb-1.5">
                                <span class="text-slate-500 font-medium">Sabtu - Kamis</span>
                                <span class="font-bold text-slate-800">{{ $jam_sabtu_kamis }}</span>
                            </div>
                            <div class="flex justify-between pt-0.5">
                                <span class="text-rose-600 font-semibold">Jumat</span>
                                <span class="font-bold text-rose-600">{{ $jam_jumat }}</span>
                            </div>
                        </div>
                    </div>
                </div>

               <!-- Card 4: Ikuti Kami (Sosial Media) -->
                <div class="lp-scroll-zoom lp-motion-card bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Sosial Media Resmi</h3>

                    <div class="flex flex-col gap-2.5">

                        @if (\App\Models\Setting::get('instagram'))
                            <a href="{{ \App\Models\Setting::get('instagram') }}"
                            target="_blank"
                            class="flex items-center gap-3 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-xl px-4 py-2.5 text-xs font-semibold transition">

                                <i class="fa-brands fa-instagram text-lg"></i>

                                <span>Instagram: @po_putra_limas</span>
                            </a>
                        @endif

                        @if (\App\Models\Setting::get('tiktok'))
                            <a href="{{ \App\Models\Setting::get('tiktok') }}"
                            target="_blank"
                            class="flex items-center gap-3 bg-slate-100 hover:bg-slate-200 text-slate-800 rounded-xl px-4 py-2.5 text-xs font-semibold transition">

                                <i class="fa-brands fa-tiktok text-lg"></i>

                                <span>TikTok: PO PUTRA LIMAS</span>
                            </a>
                        @endif

                        @if (!\App\Models\Setting::get('instagram') && !\App\Models\Setting::get('tiktok'))
                            <p class="text-xs text-slate-400">
                                Belum ada link sosial media yang ditambahkan.
                            </p>
                        @endif

                    </div>
                </div>

               <!-- Unit Bisnis Badges -->
                <div class="pt-2">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-3">DIVISI LAYANAN KAMI</span>
                    <div class="grid grid-cols-3 gap-2">
                        <span class="bg-slate-900 text-white text-[11px] sm:text-xs px-2 py-2 rounded-full font-semibold text-center leading-tight whitespace-nowrap">Bus Pariwisata</span>
                        <span class="bg-rose-700 text-white text-[11px] sm:text-xs px-2 py-2 rounded-full font-semibold text-center leading-tight whitespace-nowrap">Bahan Bangunan</span>
                        <span class="bg-slate-700 text-white text-[11px] sm:text-xs px-2 py-2 rounded-full font-semibold text-center leading-tight whitespace-nowrap">Jasa Konstruksi</span>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: FORMULIR PESAN -->
            <div class="lg:col-span-7">
                <div class="lp-scroll-zoom lp-motion-card bg-white p-8 rounded-3xl border-t-4 border-t-rose-700 border-x border-b border-slate-200/80 shadow-md">
                    <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Kirim Pesan</h2>
                    <p class="text-sm text-slate-500 mb-6">Isi formulir di bawah ini untuk berkonsultasi atau mengajukan pertanyaan.</p>

                    @if ($terkirim)
                        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Pesan Anda berhasil terkirim! Tim kami akan segera menghubungi Anda melalui WhatsApp atau Email.</span>
                        </div>
                    @endif

                    <form wire:submit="kirim" class="space-y-5">
                        <!-- Honeypot Security Field -->
                        <input type="text" wire:model="website" style="position:absolute; left:-9999px;" tabindex="-1" autocomplete="off">
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Lengkap</label>
                                <input type="text" 
                                       wire:model="nama" 
                                       placeholder="Masukkan nama Anda"
                                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition">
                                @error('nama') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nomor WhatsApp</label>
                                <input type="tel" 
                                       wire:model="whatsapp" 
                                       placeholder="Contoh: 08123456789"
                                       class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition">
                                @error('whatsapp') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Alamat Email</label>
                            <input type="email" 
                                   wire:model="email" 
                                   placeholder="nama@email.com"
                                   class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition">
                            @error('email') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pilih Layanan</label>
                            <select wire:model="layanan"
                                    class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition text-slate-800">
                                <option>Sewa Bus Pariwisata</option>
                                <option>Pembelian Bahan Bangunan</option>
                                <option>Jasa Konstruksi</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pesan Anda</label>
                            <textarea wire:model="pesan" 
                                      rows="4" 
                                      placeholder="Tuliskan detail kebutuhan atau pertanyaan Anda di sini..."
                                      class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition"></textarea>
                            @error('pesan') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" 
                                class="w-full bg-rose-700 hover:bg-rose-800 text-white text-sm font-bold py-4 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg shadow-rose-950/20 hover:scale-[1.01]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                            <span>Kirim Pesan Sekarang</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- GOOGLE MAPS + STREET VIEW 360 (SATU BOX, TOGGLE) -->
        <div class="mt-14 relative rounded-3xl overflow-hidden border border-slate-200 shadow-md"
             x-data="{ tampilan: 'peta' }">

            <!-- Header + Toggle -->
            <div class="bg-slate-900 text-white text-xs font-bold px-5 py-3.5 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot"></i>
                    Lokasi Kantor Kami
                </span>

                <div class="flex bg-white/10 rounded-full p-1 gap-1">
                    <button type="button" @click="tampilan = 'peta'"
                            :class="tampilan === 'peta' ? 'bg-rose-600 text-white' : 'text-slate-300 hover:text-white'"
                            class="text-[11px] font-bold px-3.5 py-1.5 rounded-full transition">
                        Peta
                    </button>
                    <button type="button" @click="tampilan = '360'"
                            :class="tampilan === '360' ? 'bg-rose-600 text-white' : 'text-slate-300 hover:text-white'"
                            class="text-[11px] font-bold px-3.5 py-1.5 rounded-full transition">
                        360°
                    </button>
                </div>
            </div>

            <div class="relative h-96">
                <!-- Peta biasa -->
                <iframe x-show="tampilan === 'peta'"
                    class="w-full h-full border-0 filter opacity-95 contrast-110"
                    src="https://www.google.com/maps?q={{ urlencode($lokasi_peta ?: $alamat ?: 'Indonesia') }}&output=embed"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>

                <!-- Street View 360 -->
                <iframe x-show="tampilan === '360'"
                    class="w-full h-full border-0"
                    src="https://www.google.com/maps/embed?pb=!4v1790150378912!6m8!1m7!1sSdOwCGwbaMI4nBDfyIvuMQ!2m2!1d-6.526724263666305!2d110.7172761595802!3f155.99275!4f0!5f0.7820865974627469"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>
        </div>

    </main>
</div>