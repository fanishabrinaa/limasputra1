<?php

namespace App\Livewire\Galeri;

use App\Models\Galeri;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $galeri_id;
    public $judul, $deskripsi;
    public $kategori = 'Bus Pariwisata';
    public $gambar;
    public $gambar_lama;
    public $isEdit = false;
    public $showForm = false;

    protected function rules()
    {
        return [
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:Bus Pariwisata,Toko Bangunan,Konstruksi',
            'deskripsi' => 'nullable|string',
           'gambar'      => $this->isEdit ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048' : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function render()
    {
        return view('livewire.galeri.index', [
            'daftarGaleri' => Galeri::latest()->get(),
        ])->layout('layouts.admin');
    }

    public function bukaForm()
    {
        $this->reset(['galeri_id', 'judul', 'deskripsi', 'gambar', 'gambar_lama', 'isEdit']);
        $this->kategori = 'Bus Pariwisata';
        $this->showForm = true;
    }

    public function simpan()
    {
        $this->validate();

        $path = $this->gambar_lama;
        if ($this->gambar) {
            $path = $this->gambar->store('galeri', 'public');
        }

        Galeri::updateOrCreate(
            ['id' => $this->galeri_id],
            [
                'judul' => $this->judul,
                'kategori' => $this->kategori,
                'deskripsi' => $this->deskripsi,
                'gambar' => $path,
            ]
        );

        $this->showForm = false;
        session()->flash('message', 'Galeri berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = Galeri::findOrFail($id);
        $this->galeri_id   = $data->id;
        $this->judul       = $data->judul;
        $this->kategori    = $data->kategori;
        $this->deskripsi   = $data->deskripsi;
        $this->gambar_lama = $data->gambar;
        $this->isEdit = true;
        $this->showForm = true;
    }

    public function hapus($id)
    {
        Galeri::findOrFail($id)->delete();
        session()->flash('message', 'Galeri berhasil dihapus.');
    }

    public function batal()
    {
        $this->showForm = false;
    }
}