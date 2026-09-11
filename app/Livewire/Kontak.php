<?php

namespace App\Livewire;

use App\Models\PesanMasuk;
use App\Models\Setting;
use Livewire\Component;

class Kontak extends Component
{
   public $nama, $whatsapp, $email, $layanan = 'Sewa Bus Pariwisata', $pesan;
    public $terkirim = false;
    public $website; // honeypot - field tersembunyi, harus tetap kosong


    protected $rules = [
        'nama'      => 'required|string|max:255',
        'whatsapp'  => 'required|string|max:20',
        'email'     => 'nullable|email',
        'layanan'   => 'required|string',
        'pesan'     => 'required|string|min:5',
    ];

    public function render()
    {
        return view('livewire.kontak', [
            'alamat'  => Setting::get('alamat'),
            'telepon' => Setting::get('telepon'),
            'email_perusahaan' => Setting::get('email'),
            'lokasi_peta' => Setting::get('lokasi_peta'),
            'jam_sabtu_kamis' => Setting::get('jam_sabtu_kamis', '08:00 - 17:00'),
            'jam_jumat'      => Setting::get('jam_jumat', 'Tutup'),
        ])->layout('layouts.app');
    }

    public function kirim()
    {
        if (!empty($this->website)) {
        $this->reset(['nama', 'whatsapp', 'email', 'pesan']);
        $this->terkirim = true;
        return;
        }
        
        $this->validate();

        PesanMasuk::create([
            'nama' => $this->nama,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'layanan' => $this->layanan,
            'pesan' => $this->pesan,
        ]);

        $this->reset(['nama', 'whatsapp', 'email', 'pesan']);
        $this->layanan = 'Sewa Bus Pariwisata';
        $this->terkirim = true;
    }
}