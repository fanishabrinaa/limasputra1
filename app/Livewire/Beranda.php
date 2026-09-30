<?php

namespace App\Livewire;

use App\Models\Armada;
use App\Models\ProdukBangunan;
use App\Models\Setting;
use Livewire\Component;

class Beranda extends Component
{
    public function render()
    {
        return view('livewire.beranda', [
            'nama_perusahaan' => Setting::get('nama_perusahaan', 'Limas Putra'),
            'deskripsi'       => Setting::get('deskripsi', 'Menghadirkan solusi terpadu dalam sektor konstruksi, retail material bangunan, dan transportasi pariwisata dengan standar profesionalisme tertinggi.'),
            'jumlahArmada'    => Armada::count(),
            'jumlahProduk'    => ProdukBangunan::count(),
            'statTahunPengalaman' => Setting::get('stat_tahun_pengalaman', '20+'),
            'statPelangganPuas'   => Setting::get('stat_pelanggan_puas', '2.5k'),
            'mengapaKami'         => Setting::getJson('mengapa_kami', []),
        ])->layout('layouts.app');
    }
}