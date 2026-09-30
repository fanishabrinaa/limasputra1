<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class KontenUnitUsaha extends Component
{
    public $unit_usaha_judul;
    public $unit_usaha_deskripsi;

    public function mount()
    {
        $this->unit_usaha_judul     = Setting::get('unit_usaha_judul', 'Unit Usaha **Limas Putra**');
        $this->unit_usaha_deskripsi = Setting::get('unit_usaha_deskripsi', 'Temukan berbagai layanan unggulan kami melalui tiga bidang usaha utama yang mengutamakan kualitas, profesionalisme, dan kepercayaan pelanggan.');
    }

    public function simpan()
    {
        $this->validate([
            'unit_usaha_judul'     => 'required|string',
            'unit_usaha_deskripsi' => 'required|string',
        ]);

        Setting::set('unit_usaha_judul', $this->unit_usaha_judul);
        Setting::set('unit_usaha_deskripsi', $this->unit_usaha_deskripsi);

        $this->dispatch('toast', message: 'Konten Unit Usaha berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.setting.konten-unit-usaha')->layout('layouts.admin');
    }
}