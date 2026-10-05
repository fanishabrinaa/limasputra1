<?php

namespace App\Livewire\PesanMasuk;

use App\Models\PesanMasuk;
use Livewire\Component;

class Index extends Component
{
    public $filterDibaca = '';

    // Menampilkan daftar pesan sesuai filter dan jumlah pesan yang belum dibaca.
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
        // Mengubah status pesan yang dipilih menjadi sudah dibaca.
        PesanMasuk::findOrFail($id)->update(['dibaca' => true]);
    }

    public function hapus($id)
    {
        // Menghapus pesan yang dipilih dari database.
        PesanMasuk::findOrFail($id)->delete();
        session()->flash('message', 'Pesan berhasil dihapus.');
    }
}