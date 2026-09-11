<?php

namespace App\Livewire\Fasilitas;

use App\Models\Fasilitas;
use Livewire\Component;

class Index extends Component
{
    public $nama_fasilitas;
    public $fasilitas_id;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.fasilitas.index', [
            'daftarFasilitas' => Fasilitas::latest()->get(),
        ])->layout('layouts.admin');
    }

    public function simpan()
    {
        $this->validate([
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        Fasilitas::updateOrCreate(
            ['id' => $this->fasilitas_id],
            ['nama_fasilitas' => $this->nama_fasilitas]
        );

        $this->reset(['nama_fasilitas', 'fasilitas_id', 'isEdit']);
        session()->flash('message', 'Fasilitas berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = Fasilitas::findOrFail($id);
        $this->fasilitas_id = $data->id;
        $this->nama_fasilitas = $data->nama_fasilitas;
        $this->isEdit = true;
    }

    public function hapus($id)
    {
        Fasilitas::findOrFail($id)->delete();
        session()->flash('message', 'Fasilitas berhasil dihapus.');
    }

    public function batal()
    {
        $this->reset(['nama_fasilitas', 'fasilitas_id', 'isEdit']);
    }
}