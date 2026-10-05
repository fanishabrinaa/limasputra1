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
        // Mengambil daftar fasilitas untuk ditampilkan di halaman admin.
        return view('livewire.fasilitas.index', [
            'daftarFasilitas' => Fasilitas::latest()->get(),
        ])->layout('layouts.admin');
    }

    public function simpan()
    {
        // Memeriksa nama fasilitas lalu membuat atau memperbarui datanya.
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
        // Mengambil fasilitas yang dipilih untuk mengisi formulir edit.
        $data = Fasilitas::findOrFail($id);
        $this->fasilitas_id = $data->id;
        $this->nama_fasilitas = $data->nama_fasilitas;
        $this->isEdit = true;
    }

    public function hapus($id)
    {
        // Menghapus fasilitas yang dipilih dari database.
        Fasilitas::findOrFail($id)->delete();
        session()->flash('message', 'Fasilitas berhasil dihapus.');
    }

    public function batal()
    {
        $this->reset(['nama_fasilitas', 'fasilitas_id', 'isEdit']);
    }
}