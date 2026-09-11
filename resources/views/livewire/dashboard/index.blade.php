<div class="space-y-8">

    <!-- WELCOME BANNER -->
    <div class="relative bg-slate-950 text-white rounded-3xl p-8 overflow-hidden shadow-xl border border-slate-900">
        <div class="absolute top-0 right-0 w-[400px] h-[250px] bg-rose-600/10 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-bold px-3.5 py-1 rounded-full mb-3 backdrop-blur-md">
                    PANEL KONTROL UTAMA
                </span>
                <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight mb-2">
                    Ringkasan Performa <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-rose-600">{{ \App\Models\Setting::get('nama_perusahaan', 'Limas Putra') }}</span>
                </h1>
                <p class="text-slate-400 text-sm max-w-xl leading-relaxed">
                    Pantau statistik pemesanan harian, statistik inventaris unit bisnis, dan aktivitas pesan terbaru dalam satu layar.
                </p>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ route('pemesanan.index') }}" class="bg-rose-700 hover:bg-rose-800 text-white text-xs font-bold px-5 py-3 rounded-xl shadow-lg shadow-rose-950/40 transition-all duration-300 hover:scale-[1.02] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Kelola Pemesanan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- STATS CARDS GRID -->
    <div>
        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">INDIKATOR KINERJA UTAMA (KPI)</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Card 1: Total Armada -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-rose-200 transition-all duration-300 flex flex-col justify-between group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Armada</span>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 group-hover:text-rose-700 transition-colors">
                        {{ $totalArmada }}
                    </h3>
                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100 text-xs">
                        <span class="text-slate-400">Unit Bus Aktif</span>
                        <span class="text-emerald-600 font-bold flex items-center gap-1">↑ 100% Ready</span>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Pemesanan -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-rose-200 transition-all duration-300 flex flex-col justify-between group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pemesanan</span>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 group-hover:text-rose-700 transition-colors">
                        {{ $totalPemesanan }}
                    </h3>
                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100 text-xs">
                        <span class="text-slate-400">Bulan Ini</span>
                        <span class="text-emerald-600 font-bold flex items-center gap-1">↑ +12.5%</span>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Produk -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-rose-200 transition-all duration-300 flex flex-col justify-between group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Produk</span>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 group-hover:text-rose-700 transition-colors">
                        {{ $totalProduk }}
                    </h3>
                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100 text-xs">
                        <span class="text-slate-400">Bahan Bangunan</span>
                        <span class="text-emerald-600 font-bold flex items-center gap-1">↑ Katalog Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Card 4: Total Galeri -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-rose-200 transition-all duration-300 flex flex-col justify-between group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Galeri</span>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 group-hover:text-rose-700 transition-colors">
                        {{ $totalGaleri }}
                    </h3>
                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100 text-xs">
                        <span class="text-slate-400">Dokumentasi</span>
                        <span class="text-blue-600 font-bold flex items-center gap-1">Public Gallery</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- CHARTS SECTION (GRAFIK STATISTIK TREN) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- LEFT CHART: TREN PEMESANAN (LINE CHART) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-7 border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Grafik Tren Pemesanan</h3>
                    <p class="text-xs text-slate-500">Statistik aktivitas pemesanan armada & layanan per bulan</p>
                </div>
                <span class="bg-slate-100 text-slate-700 text-xs font-bold px-3 py-1 rounded-lg">Tahun {{ date('Y') }}</span>
            </div>
            <div class="h-72 w-full relative">
                <canvas id="bookingTrendChart"></canvas>
            </div>
        </div>

        <!-- RIGHT CHART: DISTRIBUSI LAYANAN (DONUT CHART) -->
        <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-sm flex flex-col justify-between">
            <div class="mb-4">
                <h3 class="text-lg font-extrabold text-slate-900">Distribusi Layanan</h3>
                <p class="text-xs text-slate-500">Persentase permintaan per unit bisnis</p>
            </div>
            <div class="h-56 w-full relative flex items-center justify-center">
                <canvas id="businessDistributionChart"></canvas>
            </div>
            <div class="grid grid-cols-3 gap-2 pt-4 border-t border-slate-100 text-center text-xs">
                <div>
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-rose-600 mb-1"></span>
                    <p class="text-[10px] text-slate-400 font-bold uppercase">BUS</p>
                    <p class="font-bold text-slate-800">55%</p>
                </div>
                <div>
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-slate-900 mb-1"></span>
                    <p class="text-[10px] text-slate-400 font-bold uppercase">MATERIAL</p>
                    <p class="font-bold text-slate-800">30%</p>
                </div>
                <div>
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-rose-400 mb-1"></span>
                    <p class="text-[10px] text-slate-400 font-bold uppercase">KONSTRUKSI</p>
                    <p class="font-bold text-slate-800">15%</p>
                </div>
            </div>
        </div>

    </div>

    <!-- AKSI CEPAK ADMIN -->
    <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-sm">
        <h3 class="text-lg font-extrabold text-slate-900 mb-1">Aksi Cepat Admin</h3>
        <p class="text-xs text-slate-500 mb-6">Pintasan praktis kelola modul operasional</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('armada') }}" class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 hover:bg-rose-50/50 hover:border-rose-200 transition-all duration-300 flex items-center justify-between group">
                <div class="flex items-center gap-3">
                    <span class="text-xl"></span>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-rose-700 transition-colors">Bus Pariwisata</h4>
                        <p class="text-[11px] text-slate-500">Tambah / Edit Armada</p>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-rose-700 text-sm">→</span>
            </a>

            <a href="{{ route('pemesanan.index') }}" class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 hover:bg-rose-50/50 hover:border-rose-200 transition-all duration-300 flex items-center justify-between group">
                <div class="flex items-center gap-3">
                    <span class="text-xl"></span>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-rose-700 transition-colors">Kelola Pemesanan</h4>
                        <p class="text-[11px] text-slate-500">Cek Status Booking</p>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-rose-700 text-sm">→</span>
            </a>

            <a href="{{ route('produk.index') }}" class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 hover:bg-rose-50/50 hover:border-rose-200 transition-all duration-300 flex items-center justify-between group">
                <div class="flex items-center gap-3">
                    <span class="text-xl"></span>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-rose-700 transition-colors">Bahan Bangunan</h4>
                        <p class="text-[11px] text-slate-500">Katalog Produk</p>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-rose-700 text-sm">→</span>
            </a>

            <a href="{{ route('galeri.index') }}" class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 hover:bg-rose-50/50 hover:border-rose-200 transition-all duration-300 flex items-center justify-between group">
                <div class="flex items-center gap-3">
                    <span class="text-xl"></span>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-rose-700 transition-colors">Galeri Foto</h4>
                        <p class="text-[11px] text-slate-500">Dokumentasi</p>
                    </div>
                </div>
                <span class="text-slate-400 group-hover:text-rose-700 text-sm">→</span>
            </a>
        </div>
    </div>

</div>

<!-- SINGLE UNIFIED SCRIPT UNTUK DUA GRAFIK -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.trendChartInstance = null;
    window.distChartInstance = null;

    function renderDashboardCharts() {
        // 1. TREN PEMESANAN (LINE CHART)
        const canvasTrend = document.getElementById('bookingTrendChart');
        if (canvasTrend) {
            if (window.trendChartInstance) {
                window.trendChartInstance.destroy();
            }
            window.trendChartInstance = new Chart(canvasTrend.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jumlah Pemesanan',
                        data: {!! $dataGrafik ?? '[0,0,0,0,0,0,0,0,0,0,0,0]' !!},
                        borderColor: '#be123c',
                        backgroundColor: 'rgba(190, 18, 60, 0.08)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#be123c',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { 
                            grid: { color: '#f1f5f9' }, 
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        }

        // 2. DISTRIBUSI LAYANAN (DONUT CHART)
        const canvasDist = document.getElementById('businessDistributionChart');
        if (canvasDist) {
            if (window.distChartInstance) {
                window.distChartInstance.destroy();
            }
            window.distChartInstance = new Chart(canvasDist.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Bus Pariwisata', 'Toko Bangunan', 'Jasa Konstruksi'],
                    datasets: [{
                        data: [55, 30, 15],
                        backgroundColor: ['#be123c', '#0f172a', '#fb7185'],
                        borderWidth: 0,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    cutout: '72%'
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', renderDashboardCharts);
    document.addEventListener('livewire:navigated', renderDashboardCharts);
    document.addEventListener('livewire:initialized', renderDashboardCharts);
</script>