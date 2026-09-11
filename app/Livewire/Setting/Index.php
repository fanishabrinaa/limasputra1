<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\WithFileUploads;
use Livewire\Component;

class Index extends Component
{
    use WithFileUploads;

    public $nama_perusahaan;
    public $deskripsi;
    public $alamat;
    public $telepon;
    public $email;
    public $logo;
    public $instagram;
    public $tiktok;
    public $logo_lama;
    public $lokasi_peta;
    public $jam_sabtu_kamis;
    public $jam_jumat;

    public function mount()
    {
        $this->nama_perusahaan = Setting::get('nama_perusahaan');
        $this->deskripsi       = Setting::get('deskripsi');
        $this->alamat          = Setting::get('alamat');
        $this->telepon         = Setting::get('telepon');
        $this->email           = Setting::get('email');
        $this->logo_lama       = Setting::get('logo');
        $this->instagram = Setting::get('instagram');
        $this->tiktok    = Setting::get('tiktok');
        $this->lokasi_peta = Setting::get('lokasi_peta');
        $this->jam_sabtu_kamis = Setting::get('jam_sabtu_kamis', '08:00 - 17:00');
        $this->jam_jumat      = Setting::get('jam_jumat', 'Tutup');
    }

    public function render()
    {
        return view('livewire.setting.index')->layout('layouts.admin');
    }

    public function simpan()
    {
        $this->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'alamat'          => 'nullable|string',
            'telepon'         => 'nullable|string|max:20',
            'email'           => 'nullable|email',
            'logo'            => 'nullable|image|max:1024',
        ]);

        Setting::set('nama_perusahaan', $this->nama_perusahaan);
        Setting::set('deskripsi', $this->deskripsi);
        Setting::set('alamat', $this->alamat);
        Setting::set('telepon', $this->telepon);
        Setting::set('email', $this->email);
        Setting::set('instagram', $this->instagram);
        Setting::set('tiktok', $this->tiktok);
        Setting::set('lokasi_peta', $this->lokasi_peta);
        Setting::set('jam_sabtu_kamis', $this->jam_sabtu_kamis);
        Setting::set('jam_jumat', $this->jam_jumat);

        if ($this->logo) {
            $path = $this->logo->store('logo', 'public');
            Setting::set('logo', $path);
            $this->logo_lama = $path;
            $this->logo = null;
        }


        session()->flash('message', 'Pengaturan berhasil disimpan.');
    }
}