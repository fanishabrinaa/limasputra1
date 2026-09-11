<?php
namespace App\Livewire;

use Livewire\Component;

class UnitUsahaIndex extends Component
{
    public function render()
    {
        return view('livewire.unit-usaha-index')
            ->layout('layouts.app'); // Sesuaikan dengan layout utama Laravel kamu
    }
}