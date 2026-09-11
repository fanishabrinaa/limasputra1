<div>
    <!-- 2. MAIN CONTENT AREA -->
    <main class="pt-28 pb-20 max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- Breadcrumbs & Header -->
        <div class="mb-8">
            <nav class="text-xs text-slate-500 mb-3 flex items-center gap-2 font-medium">
                <a href="{{ route('unit-usaha') }}" class="hover:text-rose-700 transition">Unit Usaha</a>
                <span class="text-slate-300">&rsaquo;</span>
                <a href="#" class="hover:text-rose-700 transition">Bus Pariwisata</a>
                <span class="text-slate-300">&rsaquo;</span>
                <span class="font-bold text-slate-900"><?php echo $bus_name; ?></span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2 tracking-tight"><?php echo $bus_name; ?></h1>
                    <p class="text-sm text-slate-500 max-w-2xl">Kenyamanan eksklusif untuk perjalanan grup jarak jauh dengan standar keamanan tertinggi dan fasilitas armada modern.</p>
                </div>
                <span class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold px-3.5 py-1.5 rounded-full self-start md:self-auto">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Armada Ready
                </span>
            </div>
        </div>

        <!-- 3. PHOTO GALLERY GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12 h-auto md:h-[440px]">
            <!-- Main Large Image -->
            <div class="md:col-span-2 relative rounded-3xl overflow-hidden group h-72 md:h-full bg-slate-900 shadow-md">
                <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=1000" 
                     alt="Bus Eksterior" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-95">
                <div class="absolute bottom-4 left-4 bg-slate-950/80 backdrop-blur-md border border-slate-800 text-white text-xs font-medium px-4 py-2 rounded-xl flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Tampak Eksterior Depan
                </div>
            </div>

            <!-- Side Small Images -->
            <div class="grid grid-cols-2 md:grid-cols-1 md:grid-rows-2 gap-4 h-40 md:h-full">
                <div class="rounded-3xl overflow-hidden bg-slate-900 relative group shadow-md">
                    <img src="https://images.unsplash.com/photo-1464219789935-c2d9d9aba644?auto=format&fit=crop&q=80&w=500" 
                         alt="Interior Bus" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-95">
                </div>
                <div class="rounded-3xl overflow-hidden relative group bg-slate-900 shadow-md">
                    <img src="https://images.unsplash.com/photo-1516733968668-dbdce39c4651?auto=format&fit=crop&q=80&w=500" 
                         alt="Dashboard Bus" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90">
                    <!-- Overlay Button -->
                    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] flex items-center justify-center">
                        <button class="bg-white/90 hover:bg-white text-slate-900 text-xs font-bold px-5 py-2.5 rounded-xl shadow-xl transition-all duration-300 hover:scale-105">
                            Lihat Semua Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. CONTENT & SIDEBAR SPLIT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- LEFT CONTENT -->
            <div class="lg:col-span-2 space-y-10">
                
                <!-- Quick Specs Grid -->
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Spesifikasi Singkat</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors">
                            <div class="w-10 h-10 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14v5a2 2 0 01-2 2H7a2 2 0 01-2-2v-5m14 0c0-1.1-.9-2-2-2h-2m4 2a2 2 0 00-2-2m-10 2c0-1.1.9-2 2-2h2m-4 2a2 2 0 012-2m6 0h-6m6 0a2 2 0 012 2"></path></svg>
                            </div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Kapasitas</div>
                            <div class="text-sm font-extrabold text-slate-900">50 KURSI</div>
                        </div>

                        <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors">
                            <div class="w-10 h-10 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            </div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Konfigurasi</div>
                            <div class="text-sm font-extrabold text-slate-900">2 - 2</div>
                        </div>

                        <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors">
                            <div class="w-10 h-10 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Pendingin</div>
                            <div class="text-sm font-extrabold text-slate-900">FULL AC</div>
                        </div>

                        <div class="border border-slate-200/80 bg-white rounded-2xl p-5 text-center shadow-sm hover:border-rose-200 transition-colors">
                            <div class="w-10 h-10 bg-rose-50 text-rose-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Keamanan</div>
                            <div class="text-sm font-extrabold text-slate-900">GPS & CCTV</div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Armada -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                        Deskripsi Armada
                    </h2>
                    <div class="text-slate-600 text-sm space-y-4 leading-relaxed">
                        <p><strong>Executive Jetbus 5</strong> merupakan standar terbaru dalam layanan transportasi pariwisata kami. Dengan desain bodi aerodinamis garapan karoseri ternama, unit ini tidak hanya menawarkan tampilan luar yang elegan namun juga memberikan stabilitas berkendara yang mumpuni saat melaju di jalan tol maupun jalan menanjak.</p>
                        <p>Interior dirancang khusus untuk kenyamanan maksimal grup besar, menggunakan material *leather seat* berkualitas tinggi dan pencahayaan *ambient lighting* yang dapat disesuaikan. Sangat cocok untuk keperluan perjalanan dinas instansi, *study tour* sekolah, maupun agenda liburan keluarga besar antar kota antar provinsi.</p>
                    </div>
                </div>

                <!-- Fasilitas Unggulan -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                        Fasilitas Unggulan
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Item 1 -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-rose-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 mb-1">Entertainment System</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">LED TV, Karaoke set, dan Sound System audio hiburan kualitas tinggi.</p>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-rose-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 mb-1">USB Charger Port</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Port pengisian daya smartphone tersedia di setiap baris kursi penumpang.</p>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-rose-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 mb-1">Bagasi Ekstra Luas</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Ruang bagasi kompartemen samping dan kabin atas yang sangat lega.</p>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-rose-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 mb-1">Reclining Ergonomic Seats</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Kursi fleksibel yang dapat direbahkan sesuai tingkat kenyamanan Anda.</p>
                            </div>
                        </div>
                        <!-- Item 5 -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-rose-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 mb-1">Cool Box / Minuman</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Fasilitas dispenser air dan tempat pendingin minuman segar.</p>
                            </div>
                        </div>
                        <!-- Item 6 -->
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-rose-50/50 transition-colors">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 mb-1">Free Wi-Fi Onboard</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Koneksi internet nirkabel sepanjang perjalanan grup.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paket Sewa -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-rose-700 rounded-full"></span>
                        Pilihan Paket Sewa
                    </h2>
                    <div class="space-y-4">
                        <!-- Paket 1 -->
                        <div class="border-l-4 border-l-rose-700 border border-slate-200 bg-slate-50/50 p-5 rounded-2xl flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 hover:bg-white transition-colors">
                            <div>
                                <h4 class="text-base font-bold text-slate-900">City Tour (Dalam Kota)</h4>
                                <p class="text-xs text-slate-500 mt-1">Durasi 12 Jam (Termasuk Layanan Driver Professional & BBM).</p>
                            </div>
                            <div class="text-left sm:text-right">
                                <div class="text-[11px] text-slate-400 uppercase font-bold tracking-wider mb-0.5">Mulai dari</div>
                                <div class="text-lg font-extrabold text-rose-700">Rp 2.500.000</div>
                            </div>
                        </div>
                        <!-- Paket 2 -->
                        <div class="border-l-4 border-l-slate-700 border border-slate-200 bg-slate-50/50 p-5 rounded-2xl flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 hover:bg-white transition-colors">
                            <div>
                                <h4 class="text-base font-bold text-slate-900">Antar Kota (One Way / PP)</h4>
                                <p class="text-xs text-slate-500 mt-1">Paket Perjalanan Harian (Termasuk Driver & BBM Utama).</p>
                            </div>
                            <div class="text-left sm:text-right">
                                <div class="text-[11px] text-slate-400 uppercase font-bold tracking-wider mb-0.5">Mulai dari</div>
                                <div class="text-lg font-extrabold text-rose-700">Rp 3.800.000</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDEBAR (BOOKING WIDGET) -->
            <div class="lg:col-span-1">
                <!-- Sticky Widget Container -->
                <div class="sticky top-28 bg-white rounded-3xl shadow-xl border border-slate-200/80 overflow-hidden">
                    
                    <!-- Widget Header -->
                    <div class="bg-slate-950 text-white p-6 relative overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-rose-600/20 blur-xl rounded-full"></div>
                        <div class="text-[11px] text-rose-400 font-bold uppercase tracking-wider mb-1">ESTIMASI SEWA</div>
                        <div class="text-3xl font-extrabold">Rp <?php echo $price_label; ?> <span class="text-xs font-normal text-slate-400">/ hari</span></div>
                    </div>

                    <!-- Widget Form -->
                    <div class="p-6">
                        <form action="" method="POST" class="space-y-5">
                            <!-- Tanggal Keberangkatan -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tanggal Keberangkatan</label>
                                <div class="relative">
                                    <input type="date" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition" required>
                                </div>
                            </div>

                            <!-- Tujuan Perjalanan -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tujuan Perjalanan</label>
                                <div class="relative">
                                    <select class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-700 transition" required>
                                        <option value="" disabled selected>Pilih Kota Tujuan</option>
                                        <option value="jakarta">Jakarta (City Tour)</option>
                                        <option value="bandung">Bandung</option>
                                        <option value="jogja">Yogyakarta</option>
                                        <option value="bali">Bali</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Price Breakdown Box -->
                            <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-4 space-y-2">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-slate-500">Sewa Armada (1 Hari)</span>
                                    <span class="font-bold text-slate-900">Rp <?php echo $base_price; ?></span>
                                </div>
                                <div class="flex justify-between items-center text-xs pb-2 border-b border-slate-200">
                                    <span class="text-slate-500">Driver & Layanan BBM</span>
                                    <span class="font-bold text-rose-700">Termasuk</span>
                                </div>
                                <div class="flex justify-between items-center pt-1 text-sm">
                                    <span class="font-extrabold text-slate-900">Total Estimasi</span>
                                    <span class="font-extrabold text-slate-900">Rp <?php echo $base_price; ?></span>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <button type="button" class="w-full bg-rose-700 hover:bg-rose-800 text-white text-sm font-bold py-4 rounded-xl transition-all duration-300 flex justify-center items-center gap-2 shadow-lg shadow-rose-950/20 hover:scale-[1.02]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span>Booking Sekarang</span>
                            </button>
                            
                            <!-- Help Note -->
                            <div class="text-center pt-2">
                                <span class="text-xs text-slate-500">Butuh bantuan konsultasi? </span>
                                <a href="{{ route('kontak') }}" class="text-xs text-rose-700 font-bold hover:underline">Hubungi Tim CS</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>