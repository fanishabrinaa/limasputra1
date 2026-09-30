<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class KontenKonstruksi extends Component
{
    // Deskripsi hero halaman Konstruksi
    public $konstruksi_hero_desc;

    // Daftar layanan, disimpan sebagai array asosiatif
    // supaya bisa di-render sebagai form dinamis (bukan textarea JSON mentah)
    public $konstruksi_layanan = [];

    public function mount()
    {
        $this->konstruksi_hero_desc = Setting::get(
            'konstruksi_hero_desc',
            'Solusi pembangunan gedung, rumah, jalan, dan berbagai proyek konstruksi dengan tenaga profesional dan material berkualitas.'
        );

        $this->konstruksi_layanan = Setting::getJson('konstruksi_layanan', [
            ['title' => 'Pembangunan Gedung', 'desc' => 'Melayani pembangunan gedung, ruko, sekolah, dan perkantoran.'],
        ]);
    }

    protected function rules()
    {
        return [
            'konstruksi_hero_desc'        => 'required|string',
            'konstruksi_layanan'          => 'required|array|min:1',
            'konstruksi_layanan.*.title'  => 'required|string|max:255',
            'konstruksi_layanan.*.desc'   => 'required|string',
        ];
    }

    public function render()
    {
        return view('livewire.setting.konten-konstruksi')->layout('layouts.admin');
    }

    public function tambahLayanan()
    {
        $this->konstruksi_layanan[] = ['title' => '', 'desc' => ''];
    }

    public function hapusLayanan($index)
    {
        unset($this->konstruksi_layanan[$index]);
        $this->konstruksi_layanan = array_values($this->konstruksi_layanan);
    }

    public function simpan()
    {
        $this->validate();

        Setting::set('konstruksi_hero_desc', $this->konstruksi_hero_desc);
        Setting::setJson('konstruksi_layanan', $this->konstruksi_layanan);

        session()->flash('message', 'Konten Konstruksi berhasil disimpan.');
    }
}