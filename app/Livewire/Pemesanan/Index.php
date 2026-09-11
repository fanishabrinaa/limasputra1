<?php

namespace App\Livewire\Pemesanan;

use App\Models\Pemesanan;
use Livewire\Component;

class Index extends Component
{
    public $filterStatus = '';

    public function render()
    {
        $query = Pemesanan::with('armada')->latest();

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.pemesanan.index', [
            'daftarPemesanan' => $query->get(),
        ])->layout('layouts.admin');
    }

    public function ubahStatus($id, $status)
    {
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
    $this->pemesananDitolakId = $id;
    $this->alasanPenolakan = '';
    $this->showModalTolak = true;
}

public function konfirmasiTolak()
    {
        $this->validate([
            'alasanPenolakan' => 'required|string|min:5',
        ]);

        $pemesanan = Pemesanan::findOrFail($this->pemesananDitolakId);
        $pemesanan->status = 'Ditolak';
        $pemesanan->alasan_penolakan = $this->alasanPenolakan;
        $pemesanan->save();

        $this->showModalTolak = false;
        session()->flash('message', 'Pemesanan ditolak dengan alasan tercatat.');
    }
    public function hapus($id)
    {
        Pemesanan::findOrFail($id)->delete();
        session()->flash('message', 'Pemesanan berhasil dihapus.');
    }
}