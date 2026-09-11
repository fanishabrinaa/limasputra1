<?php

namespace App\Livewire\Pemesanan;

use App\Models\Pemesanan;
use Livewire\Component;

class Sukses extends Component
{
    public Pemesanan $pemesanan;

    public function mount($id)
    {
        $this->pemesanan = Pemesanan::with('armada')
            ->where('user_id', auth()->id())
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pemesanan.sukses')->layout('layouts.app');
    }
}