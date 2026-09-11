<?php

namespace App\Livewire\Armada;

use App\Models\Armada;
use App\Models\Fasilitas;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $armada_id;
    public $nama_bus;
    public $plat_nomor;
    public $kapasitas;
    public $deskripsi;
    public $status = 'tersedia';

    public $gambar;
    public $gambar_lama;

    public $selectedFasilitas = [];

    public $galeriBaru = [];
    public $galeri_lama = [];

    public $isEdit = false;
    public $showForm = false;

    protected function rules()
    {
        return [
            'nama_bus'   => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:50',
            'kapasitas'  => 'required|integer|min:1',
            'deskripsi'  => 'required|string',
            'status'     => 'required|string',

            'gambar' => $this->isEdit
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'galeriBaru.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function render()
    {
        return view('livewire.armada.index', [
            'daftarArmada' => Armada::with('fasilitas')->latest()->get(),
            'daftarFasilitas' => Fasilitas::all(),
        ])->layout('layouts.admin');
    }

    public function bukaForm()
    {
        $this->reset([
            'armada_id',
            'nama_bus',
            'plat_nomor',
            'kapasitas',
            'deskripsi',
            'gambar',
            'gambar_lama',
            'selectedFasilitas',
            'galeriBaru',
            'galeri_lama',
            'isEdit',
        ]);

        $this->status = 'tersedia';
        $this->showForm = true;
    }

    public function simpan()
    {
        $this->validate();

        // =========================
        // GAMBAR UTAMA
        // =========================

        $path = $this->gambar_lama;

        if ($this->gambar) {
            $path = $this->gambar->store('armada', 'public');
        }

        // =========================
        // GALERI
        // =========================

        $pathsGaleri = $this->galeri_lama ?? [];

        if ($this->galeriBaru) {
            foreach ($this->galeriBaru as $file) {
                $pathsGaleri[] = $file->store('armada', 'public');
            }
        }

        // =========================
        // SIMPAN DATA ARMADA
        // =========================

        $armada = Armada::updateOrCreate(
            ['id' => $this->armada_id],
            [
                'nama_bus'   => $this->nama_bus,
                'plat_nomor' => $this->plat_nomor,
                'kapasitas'  => $this->kapasitas,
                'deskripsi'  => $this->deskripsi,
                'status'     => $this->status,
                'gambar'     => $path,
                'galeri'     => $pathsGaleri,
            ]
        );

        // =========================
        // FASILITAS
        // =========================

        $armada->fasilitas()->sync($this->selectedFasilitas);

        $this->showForm = false;

        session()->flash(
            'message',
            'Data armada berhasil disimpan.'
        );
    }

    public function edit($id)
    {
        $data = Armada::with('fasilitas')->findOrFail($id);

        $this->armada_id = $data->id;
        $this->nama_bus = $data->nama_bus;
        $this->plat_nomor = $data->plat_nomor;
        $this->kapasitas = $data->kapasitas;
        $this->deskripsi = $data->deskripsi;
        $this->status = $data->status;

        $this->gambar_lama = $data->gambar;

        $this->galeri_lama = $data->galeri ?? [];

        $this->selectedFasilitas = $data->fasilitas
            ->pluck('id')
            ->toArray();

        $this->gambar = null;
        $this->galeriBaru = [];

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function hapus($id)
    {
        Armada::findOrFail($id)->delete();

        session()->flash(
            'message',
            'Data armada berhasil dihapus.'
        );
    }

    public function batal()
    {
        $this->showForm = false;
    }
}