<?php

namespace App\Livewire\Armada;

use App\Models\Armada;
use App\Models\Fasilitas;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    // ===== Konten Teks Hero Katalog =====
    public $katalog_judul;
    public $katalog_deskripsi;

    // ===== Form Armada =====
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

    public function mount()
    {
        $this->katalog_judul     = Setting::get('katalog_judul', 'Layanan Sewa Bus Pariwisata Profesional');
        $this->katalog_deskripsi = Setting::get('katalog_deskripsi', 'Limas Putra telah berpengalaman lebih dari satu dekade dalam menyediakan jasa transportasi pariwisata.');
    }

    protected function rules()
    {
        return [
            'nama_bus'   => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:50',
            'kapasitas'  => 'required|integer|min:40|max:60',
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

    // ===== Aksi: Konten Teks Hero Katalog =====
    public function simpanTeks()
    {
        $this->validate([
            'katalog_judul'     => 'required|string',
            'katalog_deskripsi' => 'required|string',
        ]);

        Setting::set('katalog_judul', $this->katalog_judul);
        Setting::set('katalog_deskripsi', $this->katalog_deskripsi);

        session()->flash('message', 'Konten Katalog Armada berhasil disimpan.');
    }

    // ===== Aksi: Form Armada =====
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

        $path = $this->gambar_lama;

        if ($this->gambar) {
            $path = $this->gambar->store('armada', 'public');
        }

        $pathsGaleri = $this->galeri_lama ?? [];

        if ($this->galeriBaru) {
            foreach ($this->galeriBaru as $file) {
                $pathsGaleri[] = $file->store('armada', 'public');
            }
        }

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

        $armada->fasilitas()->sync($this->selectedFasilitas);

        $this->showForm = false;

        session()->flash('message', 'Data armada berhasil disimpan.');
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

    public function hapusGaleri($index)
    {
        if (!$this->armada_id) {
            return;
        }

        $armada = Armada::findOrFail($this->armada_id);

        $galeri = $armada->galeri ?? [];

        if (!isset($galeri[$index])) {
            return;
        }

        $gambar = $galeri[$index];

        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }

        unset($galeri[$index]);

        $galeri = array_values($galeri);

        $armada->update([
            'galeri' => $galeri,
        ]);

        $this->galeri_lama = $galeri;

        session()->flash('message', 'Foto galeri berhasil dihapus.');
    }

    public function hapus($id)
    {
        Armada::findOrFail($id)->delete();

        session()->flash('message', 'Data armada berhasil dihapus.');
    }

    public function batal()
    {
        $this->showForm = false;
    }
}