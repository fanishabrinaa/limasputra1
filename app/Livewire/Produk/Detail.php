<?php

namespace App\Livewire\Produk;

use App\Models\ProdukBangunan;
use Livewire\Component;

class Detail extends Component
{
    public ProdukBangunan $produk;

    public function mount($id)
    {
        // Mengambil detail produk berdasarkan ID dari alamat halaman.
        $this->produk = ProdukBangunan::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.produk.detail')->layout('layouts.app');
    }
}