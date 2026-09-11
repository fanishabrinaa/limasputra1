<div>
    <!-- 2. MAIN CONTENT AREA -->
    <main class="pt-24 pb-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <div class="mb-6">
            <nav class="text-[11px] text-gray-500 mb-2 flex items-center gap-1.5">
                <a href="#" class="hover:text-slate-800">Unit Usaha</a>
                <span>&rsaquo;</span>
                <a href="#" class="hover:text-slate-800">Bahan Bangunan</a>
                <span>&rsaquo;</span>
                <span class="font-bold text-slate-900">Semen Portland 50kg</span>
            </nav>
        </div>

        <!-- 3. TOP SECTION: Product Images & Buy Box -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
            
            <!-- Left: Product Images -->
            <div class="lg:col-span-7 space-y-3">
                <!-- Main Image -->
                <div class="border border-gray-100 bg-white rounded-xl overflow-hidden relative h-[350px] md:h-[450px] flex items-center justify-center p-8">
                    <span class="absolute top-4 left-4 bg-rose-700 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        Premium Grade
                    </span>
                    src="{{ $produk->gambar ? Storage::url($produk->gambar) : '' }}"
                </div>
                
                <!-- Thumbnails -->
                <div class="grid grid-cols-4 gap-3">
                    <div class="border-2 border-rose-700 rounded-lg overflow-hidden h-20 bg-white cursor-pointer p-1">
                        <img src="https://images.unsplash.com/photo-1621619856624-42fd193a0661?auto=format&fit=crop&q=80&w=200" alt="Thumb 1" class="w-full h-full object-contain opacity-90">
                    </div>
                    <div class="border border-gray-200 rounded-lg overflow-hidden h-20 bg-white cursor-pointer hover:border-gray-300 transition">
                        <img src="https://images.unsplash.com/photo-1541888086425-d81bb19240f5?auto=format&fit=crop&q=80&w=200" alt="Thumb 2" class="w-full h-full object-cover">
                    </div>
                    <div class="border border-gray-200 rounded-lg overflow-hidden h-20 bg-white cursor-pointer hover:border-gray-300 transition">
                        <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=200" alt="Thumb 3" class="w-full h-full object-cover">
                    </div>
                    <div class="border border-gray-200 rounded-lg overflow-hidden h-20 bg-white cursor-pointer hover:border-gray-300 transition">
                        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=200" alt="Thumb 4" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Right: Product Information Box -->
            <div class="lg:col-span-5">
                <div class="border border-gray-200 bg-white rounded-xl p-6 shadow-sm">
                    <h1 class="text-2xl font-bold text-slate-900 mb-2">{{ $produk->nama_produk }}</h1>
                    
                    <div class="flex items-center gap-2 mb-6">
                        <span class="bg-blue-50 text-blue-700 text-[10px] px-2 py-0.5 rounded font-medium">{{ $produk->kategori }}</span>
                        <span class="text-gray-300">&bull;</span>
                        <span class="text-[11px] text-gray-500">SKU: {{ $produk->sku }}</span>
                    </div>


                    <!-- Info List -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-rose-700 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            <div class="text-xs text-slate-700"><span class="font-bold">Stok Tersedia:</span> 1,200+ Sak</div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-rose-700 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <div class="text-xs text-slate-700">Pengiriman armada sendiri atau ambil di gudang</div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-rose-700 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            <div class="text-xs text-slate-700">Standar Nasional Indonesia (SNI) Teruji</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-xs text-gray-500 leading-relaxed mb-6">
                        Semen Portland Tipe I berkualitas premium, dirancang khusus untuk proyek konstruksi umum dengan durabilitas tinggi. Ideal untuk pengerjaan beton struktural, pemasangan bata, plesteran, dan acian dengan hasil akhir yang halus dan kuat.
                    </p>

                    <!-- Buttons -->
                    <div class="space-y-3">
                        <div class="flex gap-2">
                            <button class="flex-1 bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold py-3 rounded-lg transition flex justify-center items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Pesan Sekarang
                            </button>
                            <button class="w-12 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-lg flex items-center justify-center transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            </button>
                        </div>
                        <button class="w-full bg-[#0f172a] hover:bg-slate-800 text-white text-xs font-bold py-3 rounded-lg transition flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            Hubungi Marketing (WhatsApp)
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. BOTTOM SECTION: Specs & Sidebars -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Specifications & Features -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Spesifikasi Teknis -->
                <div class="border border-gray-200 bg-white rounded-xl p-6">
                    <h2 class="text-xs font-bold text-slate-900 border-b border-gray-100 pb-3 mb-4">Spesifikasi Teknis</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                            <span class="text-[11px] text-gray-500">Tipe Semen</span>
                            <span class="text-[11px] font-bold text-slate-900">Portland Type I</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                            <span class="text-[11px] text-gray-500">Berat Bersih</span>
                            <span class="text-[11px] font-bold text-slate-900">50 kg / sak</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                            <span class="text-[11px] text-gray-500">Kuat Tekan 3 Hari</span>
                            <span class="text-[11px] font-bold text-slate-900">170 kg/cm&sup2;</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                            <span class="text-[11px] text-gray-500">Kuat Tekan 28 Hari</span>
                            <span class="text-[11px] font-bold text-slate-900">400 kg/cm&sup2;</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                            <span class="text-[11px] text-gray-500">Setting Time (Initial)</span>
                            <span class="text-[11px] font-bold text-slate-900">120 Menit</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                            <span class="text-[11px] text-gray-500">Sertifikasi</span>
                            <span class="text-[11px] font-bold text-slate-900">SNI 2049:2015</span>
                        </div>
                    </div>
                </div>

                <!-- Keunggulan Produk -->
                <div class="border border-gray-200 bg-white rounded-xl p-6">
                    <h2 class="text-xs font-bold text-slate-900 border-b border-gray-100 pb-3 mb-4">Keunggulan Produk</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-rose-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[11px] text-gray-600 leading-snug">Mudah diaplikasikan dengan plastisitas tinggi</span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-rose-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[11px] text-gray-600 leading-snug">Hasil akhir permukaan lebih halus & minim retak rambut</span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-rose-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[11px] text-gray-600 leading-snug">Lebih cepat kering & mencapai kekuatan maksimal</span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-rose-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[11px] text-gray-600 leading-snug">Diformulasikan untuk ketahanan cuaca tropis</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right: Extra Cards -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Beli Grosir Card -->
                <div class="bg-[#0f172a] rounded-xl p-6 relative overflow-hidden text-white shadow-md">
                    <!-- Subtle pattern simulation -->
                    <div class="absolute bottom-0 right-0 opacity-10">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-2h2v2zm0-4H7v-2h2v2zm0-4H7V7h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2z"/></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <h3 class="text-sm font-bold mb-2">Beli Grosir?</h3>
                        <p class="text-[11px] text-gray-300 mb-5 leading-relaxed">
                            Dapatkan harga khusus untuk proyek konstruksi dan pembelian dalam jumlah besar (tonase).
                        </p>
                        <button class="w-full bg-white text-slate-900 text-xs font-bold py-2.5 rounded-lg hover:bg-gray-100 transition">
                            Minta Penawaran Proyek
                        </button>
                    </div>
                </div>

                <!-- Lokasi Pengiriman -->
                <div class="border border-gray-200 bg-white rounded-xl p-5">
                    <h3 class="text-xs font-bold text-slate-900 mb-4">Lokasi Pengiriman</h3>
                    
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-[11px] text-slate-800 font-medium">Depo Limas Putra - Purwakarta</span>
                    </div>

                    <div class="bg-gray-100 rounded-lg h-24 w-full mb-3 overflow-hidden">
                        <!-- Placeholder for Map -->
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&q=80&w=400" alt="Map Location" class="w-full h-full object-cover opacity-60">
                    </div>

                    <p class="text-[10px] text-gray-500 leading-relaxed">
                        Estimasi pengiriman 1-2 hari kerja untuk wilayah Jabodetabek & Jawa Barat.
                    </p>
                </div>

            </div>
        </div>
    </main>
</div>