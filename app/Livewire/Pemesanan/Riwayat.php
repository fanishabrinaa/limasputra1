<?php

namespace App\Livewire\Pemesanan;

use App\Models\Pemesanan;
use App\Models\Testimoni;
use Livewire\Component;

class Riwayat extends Component
{
    public $showModalTestimoni = false;
    public $pemesananDipilih;
    public $rating = 5;
    public $pesan;

    // Menampilkan riwayat milik pengguna yang sedang login beserta armada dan testimoni.
    public function render()
    {
        return view('livewire.pemesanan.riwayat', [
            'daftarPemesanan' => Pemesanan::with(['armada', 'testimoni'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get(),
        ])->layout('layouts.app');
    }

    public function bukaModalTestimoni($pemesananId)
    {
        // Memilih pesanan yang akan diberi testimoni dan menyiapkan formulirnya.
        $this->pemesananDipilih = Pemesanan::findOrFail($pemesananId);
        $this->rating = 5;
        $this->pesan = '';
        $this->showModalTestimoni = true;
    }

    public function kirimTestimoni()
    {
        // Memastikan nilai rating dan isi testimoni sudah sesuai sebelum disimpan.
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'pesan'  => 'required|string|min:5',
        ]);

        // Menyimpan testimoni untuk armada dari pesanan yang dipilih.
        Testimoni::create([
            'armada_id'     => $this->pemesananDipilih->armada_id,
            'user_id'       => auth()->id(),
            'pemesanan_id'  => $this->pemesananDipilih->id,
            'nama'          => auth()->user()->name,
            'pesan'         => $this->pesan,
            'rating'        => $this->rating,
            'tampilkan'     => false, // nunggu approve admin dulu
        ]);

        $this->showModalTestimoni = false;
        session()->flash('message', 'Terima kasih! Testimoni kamu akan tampil setelah disetujui admin.');
    }
}