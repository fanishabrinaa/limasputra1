<?php
namespace App\Livewire;

use Livewire\Component;

class UnitUsahaIndex extends Component
{
    public function render()
    {
        // Menampilkan daftar unit usaha menggunakan layout utama website.
        return view('livewire.unit-usaha-index')
            ->layout('layouts.app'); // Sesuaikan dengan layout utama Laravel kamu
    }
}