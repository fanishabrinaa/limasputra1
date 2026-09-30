<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class KontenGaleri extends Component
{
    public $galeri_judul;
    public $galeri_deskripsi;

    public function mount()
    {
        $this->galeri_judul     = Setting::get('galeri_judul', 'Galeri Dokumentasi');
        $this->galeri_deskripsi = Setting::get('galeri_deskripsi', 'Jelajahi kumpulan foto kegiatan, armada bus pariwisata, material toko bangunan, dan pengerjaan proyek konstruksi Limas Putra.');
    }

    public function simpan()
    {
        $this->validate([
            'galeri_judul'     => 'required|string',
            'galeri_deskripsi' => 'required|string',
        ]);

        Setting::set('galeri_judul', $this->galeri_judul);
        Setting::set('galeri_deskripsi', $this->galeri_deskripsi);

        $this->dispatch('toast', message: 'Konten Galeri berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.setting.konten-galeri')->layout('layouts.admin');
    }
}