<?php

namespace App\Livewire\Pemesanan;

use App\Models\Armada;
use App\Models\Pemesanan;
use Livewire\Component;

class Create extends Component
{
    public $armada_id;
    public $armada;

    public $nama_pemesan;
    public $email;
    public $no_hp;
    public $instansi;

    public $tanggal_berangkat;
    public $tanggal_pulang;
    public $tujuan;
    public $jumlah_penumpang;
    public $catatan;
    public $jemputan;

    // Mengambil armada yang dipilih dan mengisi nama serta email dari akun pengguna.
    public function mount($armadaId)
    {
        $this->armada_id = $armadaId;
        $this->armada = Armada::findOrFail($armadaId);

        $this->nama_pemesan = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    // Aturan untuk memastikan data pemesanan sudah lengkap dan sesuai.
    protected $rules = [
        'nama_pemesan'      => 'required|string|max:255',
        'email'             => 'required|email',
        'no_hp'             => 'required|string|max:20',
        'instansi'          => 'nullable|string|max:255',
        'tanggal_berangkat' => 'required|date|after_or_equal:today',
        'tanggal_pulang'    => 'required|date|after_or_equal:tanggal_berangkat',
        'tujuan'            => 'required|string|max:255',
        'jumlah_penumpang'  => 'required|integer|min:1',
        'catatan'           => 'nullable|string',
        'jemputan'          => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.pemesanan.create')
            ->layout('layouts.app');
    }

    public function getJumlahHariProperty()
    {
        // Menghitung lama sewa dari tanggal berangkat sampai tanggal pulang.
        if (!$this->tanggal_berangkat || !$this->tanggal_pulang) {
            return 0;
        }

        $mulai = \Carbon\Carbon::parse($this->tanggal_berangkat);
        $selesai = \Carbon\Carbon::parse($this->tanggal_pulang);

        return max(1, $mulai->diffInDays($selesai) + 1);
    }

    public function simpan()
    {
        // Memeriksa data sebelum proses pemesanan dilanjutkan.
        $this->validate();

        // Cek apakah jumlah penumpang melebihi
        // kapasitas standar bus.
        $permintaanKhusus = (int) $this->jumlah_penumpang > (int) $this->armada->kapasitas;

        // Cek bentrok jadwal / double booking
        // Memeriksa apakah armada sudah dipesan pada rentang tanggal yang sama.
        $bentrok = Pemesanan::where('armada_id', $this->armada_id)
            ->whereIn('status', ['Menunggu', 'Disetujui'])
            ->where(function ($query) {
                $query->whereBetween(
                    'tanggal_berangkat',
                    [$this->tanggal_berangkat, $this->tanggal_pulang]
                )
                ->orWhereBetween(
                    'tanggal_pulang',
                    [$this->tanggal_berangkat, $this->tanggal_pulang]
                )
                ->orWhere(function ($q) {
                    $q->where(
                        'tanggal_berangkat',
                        '<=',
                        $this->tanggal_berangkat
                    )
                    ->where(
                        'tanggal_pulang',
                        '>=',
                        $this->tanggal_pulang
                    );
                });
            })
            ->exists();

        if ($bentrok) {
            $this->addError(
                'tanggal_berangkat',
                'Maaf, armada ini sudah dipesan di rentang tanggal tersebut. Silakan pilih tanggal lain.'
            );

            return;
        }

        // Simpan pemesanan
        // Menyimpan data pemesanan baru dengan status awal menunggu.
        $pemesanan = Pemesanan::create([
            'kode_pemesanan'    => 'BOOK-' . strtoupper(uniqid()),
            'user_id'           => auth()->id(),
            'armada_id'         => $this->armada_id,
            'nama_pemesan'      => $this->nama_pemesan,
            'email'             => $this->email,
            'no_hp'             => $this->no_hp,
            'instansi'          => $this->instansi,
            'tanggal_berangkat' => $this->tanggal_berangkat,
            'tanggal_pulang'    => $this->tanggal_pulang,
            'tujuan'            => $this->tujuan,
            'jumlah_penumpang'  => $this->jumlah_penumpang,
            'catatan'           => $this->catatan,
            'status'            => 'Menunggu',
            'jemputan'          => $this->jemputan,
        ]);

        // Keterangan jika melebihi kapasitas standar
        $keteranganKapasitas = '';

        if ($permintaanKhusus) {
            $keteranganKapasitas =
                "\n\nPERMINTAAN KAPASITAS KHUSUS:"
                . "\nKapasitas standar bus: {$this->armada->kapasitas} orang"
                . "\nJumlah penumpang yang diminta: {$this->jumlah_penumpang} orang"
                . "\nBiaya tambahan akan dikonfirmasi oleh admin.";
        }


        // Membuka halaman sukses setelah data pemesanan tersimpan.
return redirect()->route('pemesanan.sukses', $pemesanan->id);    }
}