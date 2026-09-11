<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gambar extends Component
{
    use WithFileUploads;

    // Daftar semua slot gambar yang bisa diedit
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

    ];

    public $uploads = []; // file baru yang dipilih per slot
    public $current = []; // path gambar yang sekarang tersimpan

    public function mount()
    {
        foreach ($this->slots as $key => $label) {
            $this->current[$key] = $key === 'img_halaman_hero'
                ? Setting::get($key, Setting::get('img_unit_usaha_hero'))
                : Setting::get($key);
        }
    }

    public function render()
    {
        return view('livewire.setting.gambar')->layout('layouts.admin');
    }

    public function simpanSatu($key)
    {
        $this->validate([
            "uploads.$key" => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if (!empty($this->uploads[$key])) {
            $path = $this->uploads[$key]->store('site', 'public');
            Setting::set($key, $path);
            $this->current[$key] = $path;
            $this->uploads[$key] = null;
        }

       $this->dispatch('toast', message: 'Gambar "' . $this->slots[$key] . '" berhasil diperbarui.');
    }
}