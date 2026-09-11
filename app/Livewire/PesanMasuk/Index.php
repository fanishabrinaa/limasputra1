<?php

namespace App\Livewire\PesanMasuk;

use App\Models\PesanMasuk;
use Livewire\Component;

class Index extends Component
{
    public $filterDibaca = '';

    public function render()
    {
        $query = PesanMasuk::latest();

        if ($this->filterDibaca !== '') {
            $query->where('dibaca', $this->filterDibaca);
        }

        return view('livewire.pesan-masuk.index', [
            'daftarPesan' => $query->get(),
            'totalBelumDibaca' => PesanMasuk::where('dibaca', false)->count(),
        ])->layout('layouts.admin');
    }

    public function tandaiDibaca($id)
    {
        PesanMasuk::findOrFail($id)->update(['dibaca' => true]);
    }

    public function hapus($id)
    {
        PesanMasuk::findOrFail($id)->delete();
        session()->flash('message', 'Pesan berhasil dihapus.');
    }
}