<?php

namespace App\Livewire\Galeri;

use App\Models\Galeri;
use App\Models\Setting;
use Livewire\Component;

class Publik extends Component
{
    public $filterKategori = 'Semua';

    public function setFilter(string $kategori)
    {
        $this->filterKategori = $kategori;
    }

    public function render()
    {
        $query = Galeri::latest();

        if ($this->filterKategori !== 'Semua') {
            $query->where('kategori', $this->filterKategori);
        }

        return view('livewire.galeri.publik', [
            'daftarGaleri'     => $query->get(),
            'galeri_judul'     => Setting::get('galeri_judul', 'Galeri Dokumentasi'),
            'galeri_deskripsi' => Setting::get('galeri_deskripsi', 'Jelajahi kumpulan foto kegiatan, armada bus pariwisata, material toko bangunan, dan pengerjaan proyek konstruksi Limas Putra.'),
        ])->layout('layouts.app');
    }
}