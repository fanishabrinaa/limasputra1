<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class Konstruksi extends Component
{
    public function render()
    {
        return view('livewire.konstruksi', [
            'hero_desc' => Setting::get(
                'konstruksi_hero_desc',
                'Layanan pemborong & kontraktor profesional untuk pembangunan struktur, gedung, dan infrastruktur skala kecil hingga besar.'
            ),
            'layanan' => Setting::getJson('konstruksi_layanan', [
                ['title' => 'Konstruksi Bangunan', 'desc' => 'Pembangunan struktur baru mulai dari rumah tinggal hingga gedung komersial.'],
                ['title' => 'Renovasi & Perbaikan', 'desc' => 'Perbaikan dan peningkatan kualitas bangunan yang sudah ada agar lebih fungsional.'],
                ['title' => 'Konsultasi Teknis', 'desc' => 'Pendampingan perencanaan dan estimasi biaya proyek oleh tim ahli kami.'],
            ]),
        ])->layout('layouts.app');
    }
}