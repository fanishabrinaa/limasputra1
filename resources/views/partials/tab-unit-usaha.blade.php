<div class="bg-slate-950 border-b border-slate-800 px-6 md:px-12 py-4 flex justify-center items-center gap-3 overflow-x-auto relative z-20 shadow-md">
    <!-- TAB 1: BUS PARIWISATA -->
    <a href="{{ route('armada.katalog') }}"
       class="px-5 py-2.5 rounded-full text-xs md:text-sm font-semibold whitespace-nowrap transition-all duration-300 border flex items-center gap-2
       {{ request()->routeIs('armada.katalog', 'armada.detail') ? 'bg-rose-700 text-white border-rose-700 shadow-lg shadow-rose-950/50 scale-105' : 'bg-slate-900/80 text-slate-300 border-slate-800 hover:bg-slate-800 hover:text-white' }}">
        <span>Bus Pariwisata</span>
    </a>

    <!-- TAB 2: TOKO BANGUNAN -->
    <a href="{{ route('produk.publik') }}"
       class="px-5 py-2.5 rounded-full text-xs md:text-sm font-semibold whitespace-nowrap transition-all duration-300 border flex items-center gap-2
       {{ request()->routeIs('produk.publik', 'produk.detail') ? 'bg-rose-700 text-white border-rose-700 shadow-lg shadow-rose-950/50 scale-105' : 'bg-slate-900/80 text-slate-300 border-slate-800 hover:bg-slate-800 hover:text-white' }}">
        <span>Toko Bahan Bangunan</span>
    </a>

    <!-- TAB 3: JASA KONSTRUKSI -->
    <a href="{{ route('konstruksi') }}"
       class="px-5 py-2.5 rounded-full text-xs md:text-sm font-semibold whitespace-nowrap transition-all duration-300 border flex items-center gap-2
       {{ request()->routeIs('konstruksi') ? 'bg-rose-700 text-white border-rose-700 shadow-lg shadow-rose-950/50 scale-105' : 'bg-slate-900/80 text-slate-300 border-slate-800 hover:bg-slate-800 hover:text-white' }}">
        <span>Jasa Konstruksi</span>
    </a>

</div>