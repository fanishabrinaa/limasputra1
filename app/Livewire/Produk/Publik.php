<?php

namespace App\Livewire\Produk;

use App\Models\ProdukBangunan;
use Livewire\Component;

class Publik extends Component
{
    public string $kategoriAktif = 'Semua Produk';

    public array $kategoriList = [
        'Semua Produk', 'Material Bangunan',
        'Struktur & Konstruksi',
        'Atap & Plafon',
        'Lantai & Dinding',
        'Cat & Finishing',
        'Perlengkapan & Perkakas',
    ];

    public function setKategori(string $kategori)
    {
        $this->kategoriAktif = $kategori;
    }

    public function render()
    {
        $query = ProdukBangunan::query();

        if ($this->kategoriAktif !== 'Semua Produk') {
            $query->where('kategori', $this->kategoriAktif);
        }

        return view('livewire.produk.publik', [
            'daftarProduk' => $query->latest()->get(),
        ])->layout('layouts.app');
    }
}