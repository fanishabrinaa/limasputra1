<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class KontenBeranda extends Component
{
    // Unit Bisnis
    public $unitbisnis_judul;
    public $unitbisnis_paragraf;
    public $desc_bus;
    public $desc_bangunan;
    public $desc_konstruksi;

    // Kemitraan
    public $kemitraan_badge;
    public $kemitraan_judul;
    public $kemitraan_paragraf;
    public $logo1;
    public $logo2;
    public $logo3;
    public $logo4;

    // CTA Akhir
    public $cta_judul;
    public $cta_paragraf;

    public function mount()
    {
        // Mengambil konten beranda yang tersimpan untuk mengisi formulir admin.
        $this->unitbisnis_judul   = Setting::get('beranda_unitbisnis_judul', 'Unit Bisnis Strategis Kami');
        $this->unitbisnis_paragraf = Setting::get('beranda_unitbisnis_paragraf', 'Putra Limas mengintegrasikan tiga pilar bisnis utama untuk mendukung kebutuhan mobilitas dan pembangunan infrastruktur di Indonesia.');

        $this->desc_bus         = Setting::get('beranda_desc_bus', 'Layanan transportasi eksekutif dengan armada modern untuk perjalanan wisata, bisnis, maupun keperluan grup.');
        $this->desc_bangunan    = Setting::get('beranda_desc_bangunan', 'Pusat retail bahan bangunan terlengkap yang menyediakan material berkualitas dengan harga kompetitif.');
        $this->desc_konstruksi  = Setting::get('beranda_desc_konstruksi', 'Solusi konstruksi profesional untuk proyek skala besar, infrastruktur, dan perumahan dengan dukungan tim teknis handal.');

        $this->kemitraan_badge     = Setting::get('beranda_kemitraan_badge', 'DIPERCAYA BANYAK PIHAK');
        $this->kemitraan_judul     = Setting::get('beranda_kemitraan_judul', 'Kemitraan Strategis');
        $this->kemitraan_paragraf  = Setting::get('beranda_kemitraan_paragraf', 'Telah dipercaya oleh berbagai institusi pemerintah dan perusahaan swasta nasional dalam menyediakan solusi transportasi dan material konstruksi berkualitas tinggi.');

        $this->logo1 = Setting::get('beranda_logo1', 'INSTITUSI PEMERINTAH');
        $this->logo2 = Setting::get('beranda_logo2', 'BUMN KONTRAKTOR');
        $this->logo3 = Setting::get('beranda_logo3', 'SWASTA NASIONAL');
        $this->logo4 = Setting::get('beranda_logo4', 'PROYEK INFRASTRUKTUR');

        $this->cta_judul    = Setting::get('beranda_cta_judul', 'Siap Membangun Bersama Kami?');
        $this->cta_paragraf = Setting::get('beranda_cta_paragraf', 'Konsultasikan kebutuhan konstruksi atau transportasi Anda dengan tim ahli kami sekarang juga.');
    }

    public function simpan()
    {
        // Memeriksa data konten sebelum menyimpan perubahan beranda.
        $this->validate([
            'unitbisnis_judul'    => 'required|string|max:255',
            'unitbisnis_paragraf' => 'required|string',
            'desc_bus'            => 'required|string',
            'desc_bangunan'       => 'required|string',
            'desc_konstruksi'     => 'required|string',
            'kemitraan_badge'     => 'required|string|max:255',
            'kemitraan_judul'     => 'required|string|max:255',
            'kemitraan_paragraf'  => 'required|string',
            'logo1' => 'required|string|max:255',
            'logo2' => 'required|string|max:255',
            'logo3' => 'required|string|max:255',
            'logo4' => 'required|string|max:255',
            'cta_judul'    => 'required|string|max:255',
            'cta_paragraf' => 'required|string',
        ]);

        // Menyimpan bagian unit bisnis, kemitraan, dan ajakan pada halaman beranda.
        Setting::set('beranda_unitbisnis_judul', $this->unitbisnis_judul);
        Setting::set('beranda_unitbisnis_paragraf', $this->unitbisnis_paragraf);
        Setting::set('beranda_desc_bus', $this->desc_bus);
        Setting::set('beranda_desc_bangunan', $this->desc_bangunan);
        Setting::set('beranda_desc_konstruksi', $this->desc_konstruksi);
        Setting::set('beranda_kemitraan_badge', $this->kemitraan_badge);
        Setting::set('beranda_kemitraan_judul', $this->kemitraan_judul);
        Setting::set('beranda_kemitraan_paragraf', $this->kemitraan_paragraf);
        Setting::set('beranda_logo1', $this->logo1);
        Setting::set('beranda_logo2', $this->logo2);
        Setting::set('beranda_logo3', $this->logo3);
        Setting::set('beranda_logo4', $this->logo4);
        Setting::set('beranda_cta_judul', $this->cta_judul);
        Setting::set('beranda_cta_paragraf', $this->cta_paragraf);

        session()->flash('message', 'Konten Beranda berhasil disimpan.');
    }

    public function render()
{
    return view('livewire.setting.konten-beranda')->layout('layouts.admin');
}
}