<?php

namespace App\Livewire\Dashboard;

use App\Models\Armada;
use App\Models\Galeri;
use App\Models\Pemesanan;
use App\Models\ProdukBangunan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // 1. Hitung total Pemesanan per bulan dari Januari (1) s/d Desember (12) di tahun ini
        $pemesananPerBulan = Pemesanan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // 2. Susun data 12 bulan (isi 0 jika bulan tersebut belum ada transaksi)
        $dataGrafik = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataGrafik[] = $pemesananPerBulan[$i] ?? 0;
        }

        return view('livewire.dashboard.index', [
            'totalArmada'    => Armada::count(),
            'totalPemesanan' => Pemesanan::count(),
            'totalProduk'    => ProdukBangunan::count(),
            'totalGaleri'    => Galeri::count(),
            'dataGrafik'     => json_encode($dataGrafik), // Data dikirim ke grafik
        ])->layout('layouts.admin');
    }
}