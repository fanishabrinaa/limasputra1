<?php

namespace App\Livewire\Produk;

use App\Models\ProdukBangunan;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $produk_id;
    public $nama_produk, $kategori, $deskripsi;
    public $gambar;
    public $gambar_lama;
    public $isEdit = false;
    public $showForm = false;

    public array $kategoriList = [
        'Material Bangunan',
        'Struktur & Konstruksi',
        'Atap & Plafon',
        'Lantai & Dinding',
        'Cat & Finishing',
        'Perlengkapan & Perkakas',
    ];

    protected function rules()
    {
        return [
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function render()
    {
        return view('livewire.produk.index', [
            'daftarProduk' => ProdukBangunan::latest()->get(),
        ])->layout('layouts.admin');
    }

    public function bukaForm()
    {
        $this->reset([
            'produk_id',
            'nama_produk',
            'kategori',
            'deskripsi',
            'gambar',
            'gambar_lama',
            'isEdit'
        ]);

        $this->showForm = true;
    }

    public function simpan()
    {
        $this->validate();

        $path = $this->gambar_lama;

        if ($this->gambar) {
            $path = $this->gambar->store('produk', 'public');
        }

        ProdukBangunan::updateOrCreate(
            ['id' => $this->produk_id],
            [
                'nama_produk' => $this->nama_produk,
                'kategori'    => $this->kategori,
                'deskripsi'   => $this->deskripsi,
                'gambar'      => $path,
            ]
        );

        $this->showForm = false;

        session()->flash('message', 'Produk berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = ProdukBangunan::findOrFail($id);

        $this->produk_id   = $data->id;
        $this->nama_produk = $data->nama_produk;
        $this->kategori    = $data->kategori;
        $this->deskripsi   = $data->deskripsi;
        $this->gambar_lama = $data->gambar;

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function hapus($id)
    {
        ProdukBangunan::findOrFail($id)->delete();

        session()->flash('message', 'Produk berhasil dihapus.');
    }

    public function batal()
    {
        $this->showForm = false;
    }
}