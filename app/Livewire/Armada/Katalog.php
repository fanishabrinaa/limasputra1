<?php

namespace App\Livewire\Armada;

use App\Models\Armada;
use Livewire\Component;

class Katalog extends Component
{
    public function render()
    {
        // Menampilkan armada yang tersedia beserta fasilitasnya.
        return view('livewire.armada.katalog', [
            'daftarArmada' => Armada::with('fasilitas')->where('status', 'tersedia')->get(),
        ])->layout('layouts.app');
    }
}