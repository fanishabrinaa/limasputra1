<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class KontenKonstruksi extends Component
{
    public $konstruksi_hero_desc;
    public $konstruksi_layanan;

    public function mount()
    {
        $this->konstruksi_hero_desc = Setting::get('konstruksi_hero_desc', 'Solusi pembangunan gedung, rumah, jalan, dan berbagai proyek konstruksi dengan tenaga profesional dan material berkualitas.');

        $this->konstruksi_layanan = json_encode(Setting::getJson('konstruksi_layanan', [
            ['title' => 'Pembangunan Gedung', 'desc' => 'Melayani pembangunan gedung, ruko, sekolah, dan perkantoran.'],
        ]), JSON_PRETTY_PRINT);
    }

    public function render()
    {
        return view('livewire.setting.konten-konstruksi')->layout('layouts.admin');
    }

    public function simpan()
    {
        $this->validate([
            'konstruksi_hero_desc'   => 'required|string',
            'konstruksi_layanan'     => 'required|json',
        ]);

        Setting::set('konstruksi_hero_desc', $this->konstruksi_hero_desc);
        Setting::set('konstruksi_layanan', $this->konstruksi_layanan);

        session()->flash('message', 'Konten Konstruksi berhasil disimpan.');
    }
}