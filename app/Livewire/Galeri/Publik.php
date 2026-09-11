<?php

namespace App\Livewire\Galeri;

use App\Models\Galeri;
use Livewire\Component;

class Publik extends Component
{
    public $filterKategori = 'Semua';

    public function render()
    {
        $query = Galeri::latest();

        if ($this->filterKategori !== 'Semua') {
            $query->where('kategori', $this->filterKategori);
        }

        return view('livewire.galeri.publik', [
            'daftarGaleri' => $query->get(),
        ])->layout('layouts.app');
    }
}