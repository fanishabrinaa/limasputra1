<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gambar extends Component
{
    use WithFileUploads;

    // Daftar semua slot gambar tunggal yang bisa diedit
    public $slots = [
        'img_beranda_hero'      => 'Beranda - Background Hero',
        'img_unit_bus'          => 'Beranda/Unit Usaha - Foto Bus Pariwisata',
        'img_unit_bangunan'     => 'Beranda/Unit Usaha - Foto Toko Bangunan',
        'img_unit_konstruksi'   => 'Beranda/Unit Usaha - Foto Toko Konstruksi',
        'img_katalog_hero'      => 'Katalog Armada - Background Hero',
        'img_katalog_interior'  => 'Katalog Armada - Foto Interior Bus',
        'img_katalog_supir'     => 'Katalog Armada - Foto Supir/Eksterior',
        'img_tentang_sejarah'   => 'Tentang Kami - Foto Kantor/Sejarah',
        'img_leader_1'          => 'Tentang Kami - Foto Pimpinan 1',
        'img_halaman_hero'      => 'Hero Unit Usaha, Galeri, Tentang Kami & Kontak',
        'img_bangunan_hero'      => 'Hero Bangunan',

    ];

    // Daftar slot GALERI (bisa lebih dari 1 foto per unit usaha), disimpan sebagai JSON array
    public $gallerySlots = [
        'img_unit_bus_gallery'        => 'Unit Usaha - Galeri Foto Bus Pariwisata (bisa banyak foto)',
        'img_unit_bangunan_gallery'   => 'Unit Usaha - Galeri Foto Toko Bangunan (bisa banyak foto)',
        'img_unit_konstruksi_gallery' => 'Unit Usaha - Galeri Foto Jasa Konstruksi (bisa banyak foto)',
    ];

    public $uploads = []; // file baru yang dipilih per slot (single)
    public $current = []; // path gambar yang sekarang tersimpan (single)

    public $galleryUploads = []; // file-file baru yang dipilih per slot galeri (array of files)
    public $galleryCurrent = []; // array path foto yang sekarang tersimpan per slot galeri

    public function mount()
    {
        // Memuat gambar yang tersimpan agar admin dapat melihat kondisi saat ini.
        foreach ($this->slots as $key => $label) {
            $this->current[$key] = $key === 'img_halaman_hero'
                ? Setting::get($key, Setting::get('img_unit_usaha_hero'))
                : Setting::get($key);
        }

        foreach ($this->gallerySlots as $key => $label) {
            $raw = Setting::get($key);
            $this->galleryCurrent[$key] = $raw ? (json_decode($raw, true) ?: []) : [];
        }
    }

    public function render()
    {
        return view('livewire.setting.gambar')->layout('layouts.admin');
    }

    public function simpanSatu($key)
    {
        // Memeriksa file lalu menyimpan gambar untuk satu bagian website.
        $this->validate([
            "uploads.$key" => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if (!empty($this->uploads[$key])) {
            // Menyimpan file dan memperbarui lokasi gambarnya di pengaturan.
            $path = $this->uploads[$key]->store('site', 'public');
            Setting::set($key, $path);
            $this->current[$key] = $path;
            $this->uploads[$key] = null;
        }

        $this->dispatch('toast', message: 'Gambar "' . $this->slots[$key] . '" berhasil diperbarui.');
    }

    /**
     * Simpan foto baru ke galeri (ditambahkan ke foto yang sudah ada, bukan menimpa).
     */
    public function simpanGaleri($key)
    {
        // Memeriksa kumpulan file gambar sebelum ditambahkan ke galeri.
        $this->validate([
            "galleryUploads.$key.*" => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if (!empty($this->galleryUploads[$key])) {
            $existing = $this->galleryCurrent[$key] ?? [];

            foreach ($this->galleryUploads[$key] as $file) {
                $path = $file->store('site', 'public');
                $existing[] = $path;
            }

            Setting::set($key, json_encode(array_values($existing)));
            $this->galleryCurrent[$key] = $existing;
            $this->galleryUploads[$key] = [];
        }

        $this->dispatch('toast', message: 'Galeri "' . $this->gallerySlots[$key] . '" berhasil diperbarui.');
    }

    /**
     * Hapus satu foto tertentu dari galeri berdasarkan index-nya.
     */
    public function hapusFotoGaleri($key, $index)
    {
        // Menghapus foto terpilih dari daftar galeri yang tersimpan.
        $existing = $this->galleryCurrent[$key] ?? [];

        if (isset($existing[$index])) {
            unset($existing[$index]);
            $existing = array_values($existing);

            Setting::set($key, json_encode($existing));
            $this->galleryCurrent[$key] = $existing;
        }

        $this->dispatch('toast', message: 'Foto dihapus dari galeri "' . $this->gallerySlots[$key] . '".');
    }
}