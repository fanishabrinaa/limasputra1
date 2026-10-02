<?php

namespace App\Livewire\Armada;

use App\Models\Armada;
use App\Models\Testimoni;
use Livewire\Component;

class Detail extends Component
{
    public Armada $armada;
    public $testimoni;

    public function mount($id)
    {
        $this->armada = Armada::with('fasilitas')->findOrFail($id);

        $this->testimoni = Testimoni::where('tampilkan', true)
            ->where('armada_id', $id)
            ->latest()
            ->get();
    }

    public function render()
    {
        $armadaLain = Armada::with('fasilitas')
            ->where('id', '!=', $this->armada->id)
            ->where('status', 'tersedia')
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.armada.detail', [
            'armadaLain' => $armadaLain,
        ])->layout('layouts.app', [
            'title'           => $this->armada->nama_bus,
            'metaDescription' => 'Sewa bus pariwisata ' . $this->armada->nama_bus
                . ' kapasitas ' . $this->armada->kapasitas
                . ' kursi dari Putra Limas, Jepara. Cek fasilitas dan konsultasikan penawaran harga sewa.',
            'ogImage'         => $this->armada->gambar
                ? asset('storage/' . $this->armada->gambar)
                : null,
        ]);
    }
}