<?php

namespace App\Livewire\Armada;

use App\Models\Armada;
use Livewire\Component;
use App\Models\Testimoni;

class Detail extends Component
{
    public Armada $armada;
    public $testimoni;

    public function mount($id)
    {
        $this->armada = Armada::with('fasilitas')->findOrFail($id);
        $this->testimoni = Testimoni::where('tampilkan', true)
        ->where('armada_id', $id)
        ->latest()
        ->get();
    }

    public function render()
    {
        return view('livewire.armada.detail')->layout('layouts.app');
    }
}