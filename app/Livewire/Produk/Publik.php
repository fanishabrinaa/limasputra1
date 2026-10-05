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
        // Mengubah kategori yang dipakai untuk menyaring daftar produk.
        $this->kategoriAktif = $kategori;
    }

    public function render()
    {
        // Mengambil produk sesuai kategori yang sedang dipilih pengunjung.
        $query = ProdukBangunan::query();

        if ($this->kategoriAktif !== 'Semua Produk') {
            $query->where('kategori', $this->kategoriAktif);
        }

        return view('livewire.produk.publik', [
            'daftarProduk' => $query->latest()->get(),
        ])->layout('layouts.app');
    }
}