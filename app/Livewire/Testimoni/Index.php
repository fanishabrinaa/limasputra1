<?php

namespace App\Livewire\Testimoni;

use App\Models\Armada;
use App\Models\Testimoni;
use Livewire\Component;

class Index extends Component
{
    public $testimoni_id;
    public $armada_id;
    public $nama, $jabatan, $perusahaan, $pesan, $rating = 5, $tampilkan = true;
    public $isEdit = false;
    public $showForm = false;
    public $filterTampilkan = '';

    protected $rules = [
        'armada_id'   => 'nullable|exists:armadas,id',
        'nama'        => 'required|string|max:255',
        'jabatan'     => 'nullable|string|max:255',
        'perusahaan'  => 'nullable|string|max:255',
        'pesan'       => 'required|string',
        'rating'      => 'required|integer|min:1|max:5',
    ];

    public function render()
    {
        // Mengambil testimoni sesuai filter dan daftar armada untuk formulir admin.
        $query = Testimoni::with(['armada', 'user'])->latest();

        if ($this->filterTampilkan !== '') {
            $query->where('tampilkan', $this->filterTampilkan);
        }

        return view('livewire.testimoni.index', [
            'daftarTestimoni' => $query->get(),
            'daftarArmada' => Armada::orderBy('nama_bus')->get(),
        ])->layout('layouts.admin');
    }

    public function toggleTampilkan($id)
    {
        // Mengubah apakah testimoni ditampilkan kepada pengunjung.
        $t = Testimoni::findOrFail($id);
        $t->tampilkan = !$t->tampilkan;
        $t->save();
    }

    public function bukaForm()
    {
        $this->reset(['testimoni_id', 'armada_id', 'nama', 'jabatan', 'perusahaan', 'pesan', 'isEdit']);
        $this->rating = 5;
        $this->tampilkan = true;
        $this->showForm = true;
    }

    public function simpan()
    {
        // Memeriksa lalu membuat atau memperbarui data testimoni.
        $this->validate();

        Testimoni::updateOrCreate(
            ['id' => $this->testimoni_id],
            [
                'armada_id' => $this->armada_id,
                'nama' => $this->nama,
                'jabatan' => $this->jabatan,
                'perusahaan' => $this->perusahaan,
                'pesan' => $this->pesan,
                'rating' => $this->rating,
                'tampilkan' => $this->tampilkan,
            ]
        );

        $this->showForm = false;
        session()->flash('message', 'Testimoni berhasil disimpan.');
    }

    public function edit($id)
    {
        // Mengambil data testimoni untuk mengisi formulir edit.
        $data = Testimoni::findOrFail($id);
        $this->testimoni_id = $data->id;
        $this->armada_id = $data->armada_id;
        $this->nama = $data->nama;
        $this->jabatan = $data->jabatan;
        $this->perusahaan = $data->perusahaan;
        $this->pesan = $data->pesan;
        $this->rating = $data->rating;
        $this->tampilkan = $data->tampilkan;
        $this->isEdit = true;
        $this->showForm = true;
    }

    public function hapus($id)
    {
        // Menghapus testimoni yang dipilih dari database.
        Testimoni::findOrFail($id)->delete();
        session()->flash('message', 'Testimoni berhasil dihapus.');
    }

    public function batal()
    {
        $this->showForm = false;
    }
}