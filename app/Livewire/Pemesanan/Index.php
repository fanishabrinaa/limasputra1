<?php

namespace App\Livewire\Pemesanan;

use App\Models\Pemesanan;
use Livewire\Component;

class Index extends Component
{
    // Status yang dipilih untuk menyaring daftar pemesanan.
    public $filterStatus = '';

    // Mengambil daftar pemesanan beserta data armada untuk ditampilkan di halaman admin.
    public function render()
    {
        $query = Pemesanan::with('armada')->latest();

        // Jika status dipilih, tampilkan hanya pemesanan dengan status tersebut.
        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.pemesanan.index', [
            'daftarPemesanan' => $query->get(),
        ])->layout('layouts.admin');
    }

    public function ubahStatus($id, $status)
    {
        // Mengambil pemesanan, memperbarui statusnya, lalu menyimpan perubahan.
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = $status;
        $pemesanan->save();

        session()->flash('message', "Status pemesanan berhasil diubah ke '{$status}'.");
    }
    public $showModalTolak = false;
public $pemesananDitolakId;
public $alasanPenolakan = '';

public function bukaModalTolak($id)
{
    // Menyiapkan pemesanan dan alasan sebelum formulir penolakan ditampilkan.
    $this->pemesananDitolakId = $id;
    $this->alasanPenolakan = '';
    $this->showModalTolak = true;
}

public function konfirmasiTolak()
    {
        // Memastikan alasan penolakan diisi dengan panjang minimal lima karakter.
        $this->validate([
            'alasanPenolakan' => 'required|string|min:5',
        ]);

        // Menyimpan status penolakan dan alasannya pada data pemesanan.
        $pemesanan = Pemesanan::findOrFail($this->pemesananDitolakId);
        $pemesanan->status = 'Ditolak';
        $pemesanan->alasan_penolakan = $this->alasanPenolakan;
        $pemesanan->save();

        $this->showModalTolak = false;
        session()->flash('message', 'Pemesanan ditolak dengan alasan tercatat.');
    }
    public function hapus($id)
    {
        // Menghapus pemesanan yang dipilih dari database.
        Pemesanan::findOrFail($id)->delete();
        session()->flash('message', 'Pemesanan berhasil dihapus.');
    }
}