<?php

namespace App\Livewire\Pemesanan;

use App\Models\Pemesanan;
use Livewire\Component;

class Sukses extends Component
{
    public Pemesanan $pemesanan;

    public function mount($id)
    {
        $this->pemesanan = Pemesanan::with('armada')
            ->where('user_id', auth()->id())
            ->findOrFail($id);
    }

    public function getLinkWaProperty()
    {
        $armada = $this->pemesanan->armada;

        $keteranganKapasitas = '';
        if ($armada && $this->pemesanan->jumlah_penumpang > $armada->kapasitas) {
            $keteranganKapasitas =
                "\n\nPERMINTAAN KAPASITAS KHUSUS:"
                . "\nKapasitas standar bus: {$armada->kapasitas} orang"
                . "\nJumlah penumpang yang diminta: {$this->pemesanan->jumlah_penumpang} orang"
                . "\nBiaya tambahan akan dikonfirmasi oleh admin.";
        }

        $pesanWa =
            "Halo, saya ingin konfirmasi pemesanan armada berikut:\n\n"
            . "Kode Pemesanan: {$this->pemesanan->kode_pemesanan}\n"
            . "Nama: {$this->pemesanan->nama_pemesan}\n"
            . "Armada: " . ($armada->nama_bus ?? '-') . "\n"
            . "Tanggal Berangkat: " . \Carbon\Carbon::parse($this->pemesanan->tanggal_berangkat)->format('d M Y') . "\n"
            . "Tanggal Pulang: " . \Carbon\Carbon::parse($this->pemesanan->tanggal_pulang)->format('d M Y') . "\n"
            . "Tujuan: {$this->pemesanan->tujuan}\n"
            . "Jumlah Penumpang: {$this->pemesanan->jumlah_penumpang} orang\n"
            . "Jemputan: {$this->pemesanan->jemputan}"
            . $keteranganKapasitas
            . ($this->pemesanan->catatan ? "\nCatatan: {$this->pemesanan->catatan}" : "");

        $nomorWa = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('telepon', ''));

        return "https://wa.me/{$nomorWa}?text=" . urlencode($pesanWa);
    }

    public function render()
    {
        return view('livewire.pemesanan.sukses')->layout('layouts.app');
    }
}