<?php

namespace App\Livewire;

use Livewire\Component;

class UnitUsaha extends Component
{
    public function render()
    {
        // Menampilkan halaman informasi unit usaha menggunakan layout utama.
        return view('livewire.unit-usaha')->layout('layouts.app');
    }
}