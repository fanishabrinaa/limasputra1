<?php

namespace App\Livewire\Galeri;

use App\Models\Galeri;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    // ===== Konten Teks Hero =====
    public $galeri_judul;
    public $galeri_deskripsi;

    // ===== Form Foto Galeri =====
    public $galeri_id;
    public $judul, $deskripsi;
    public $kategori = 'Bus Pariwisata';
    public $gambar;
    public $gambar_lama;
    public $isEdit = false;
    public $showForm = false;

    public function mount()
    {
        // Mengambil judul dan deskripsi galeri dari tabel pengaturan.
        $this->galeri_judul     = Setting::get('galeri_judul', 'Galeri Dokumentasi');
        $this->galeri_deskripsi = Setting::get('galeri_deskripsi', 'Jelajahi kumpulan foto kegiatan, armada bus pariwisata, material toko bangunan, dan pengerjaan proyek konstruksi Putra Limas.');
    }

    protected function rules()
    {
        // Memeriksa judul, kategori, dan gambar sebelum galeri disimpan.
        return [
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:Bus Pariwisata,Toko Bangunan,Konstruksi',
            'deskripsi' => 'nullable|string',
            'gambar'    => $this->isEdit ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048' : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function render()
    {
        // Mengambil seluruh foto galeri, dimulai dari data terbaru.
        return view('livewire.galeri.index', [
            'daftarGaleri' => Galeri::latest()->get(),
        ])->layout('layouts.admin');
    }

    // ===== Aksi: Konten Teks Hero =====
    public function simpanTeks()
    {
        $this->validate([
            'galeri_judul'     => 'required|string',
            'galeri_deskripsi' => 'required|string',
        ]);

        Setting::set('galeri_judul', $this->galeri_judul);
        Setting::set('galeri_deskripsi', $this->galeri_deskripsi);

        session()->flash('message', 'Konten Galeri berhasil disimpan.');
    }

    // ===== Aksi: Form Foto Galeri =====
    public function bukaForm()
    {
        $this->reset(['galeri_id', 'judul', 'deskripsi', 'gambar', 'gambar_lama', 'isEdit']);
        $this->kategori = 'Bus Pariwisata';
        $this->showForm = true;
    }

    public function simpan()
    {
        // Memeriksa isian sebelum menyimpan data galeri.
        $this->validate();

        $path = $this->gambar_lama;
        if ($this->gambar) {
            // Menyimpan gambar galeri ke penyimpanan publik.
            $path = $this->gambar->store('galeri', 'public');
        }

        // Membuat foto baru atau memperbarui foto yang sedang diedit.
        Galeri::updateOrCreate(
            ['id' => $this->galeri_id],
            [
                'judul'     => $this->judul,
                'kategori'  => $this->kategori,
                'deskripsi' => $this->deskripsi,
                'gambar'    => $path,
            ]
        );

        $this->showForm = false;
        session()->flash('message', 'Galeri berhasil disimpan.');
    }

    public function edit($id)
    {
        // Mengambil data galeri untuk mengisi formulir edit.
        $data = Galeri::findOrFail($id);
        $this->galeri_id   = $data->id;
        $this->judul       = $data->judul;
        $this->kategori    = $data->kategori;
        $this->deskripsi   = $data->deskripsi;
        $this->gambar_lama = $data->gambar;
        $this->isEdit      = true;
        $this->showForm    = true;
    }

    public function hapus($id)
    {
        // Menghapus foto galeri yang dipilih dari database.
        Galeri::findOrFail($id)->delete();
        session()->flash('message', 'Galeri berhasil dihapus.');
    }

    public function batal()
    {
        $this->showForm = false;
    }
}