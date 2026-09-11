<div>
    <!-- TAB UNIT USAHA PARTIAL -->
    @include('partials.tab-unit-usaha')

    <!-- 1. HERO HEADER SECTION -->
    <section class="relative bg-slate-950 text-white py-16 md:py-20 px-6 text-center overflow-hidden border-b border-slate-900 flex items-center justify-center min-h-[420px]">
        <!-- Ambient Glow Effect -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-rose-600/10 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="absolute inset-0">
            <img src="{{ \App\Models\Setting::get('img_unit_konstruksi') ? Storage::url(\App\Models\Setting::get('img_unit_konstruksi')) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400' }}"
                class="w-full h-full object-cover opacity-30 scale-105 transition-transform duration-1000">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-5 backdrop-blur-md">
                SOLUSI KONSTRUKSI & INFRASTRUKTUR
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-tight">
                Jasa Konstruksi <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">Limas Putra</span>
            </h1>
            <p class="text-slate-300 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-normal">
                {{ $hero_desc }}
            </p>
        </div>
    </section>

    <!-- 2. LAYANAN KAMI -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14">
                <span class="text-rose-700 text-xs font-bold tracking-widest uppercase mb-2 block">DIVISI KONSTRUKSI</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Layanan Unggulan Kami</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($layanan as $item)
                    <div class="bg-slate-50 hover:bg-white border border-slate-200/80 rounded-2xl p-7 shadow-sm hover:shadow-xl hover:border-rose-200 hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 bg-rose-100 text-rose-700 rounded-xl flex items-center justify-center mb-6 font-bold text-xl group-hover:bg-rose-700 group-hover:text-white transition-colors duration-300">
                                🏗️
                            </div>
                            <h3 class="font-bold text-slate-900 text-xl mb-3 group-hover:text-rose-700 transition-colors">{{ $item['title'] }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-slate-400">Belum ada data layanan konstruksi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 3. CTA BANNER -->
    <section class="py-20 bg-slate-950 text-white relative overflow-hidden">
        <!-- Glow Ambient Effect -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-rose-600/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap Membangun Bersama Kami?</h2>
            <p class="text-slate-300 text-base mb-8 max-w-lg mx-auto">Konsultasikan kebutuhan konstruksi, renovasi, atau infrastruktur Anda dengan tim teknis ahli kami.</p>
            <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-700 to-rose-600 hover:from-rose-600 hover:to-rose-500 text-white font-bold px-9 py-4 rounded-xl shadow-lg shadow-rose-950/50 transition-all duration-300 hover:scale-[1.03]">
                <span>Hubungi Kami Sekarang</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </section>
</div>