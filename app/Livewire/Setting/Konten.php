<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Konten extends Component
{
    // BERANDA
    public $stat_tahun_pengalaman;
    public $stat_pelanggan_puas;

    // KATALOG ARMADA
    public $katalog_judul;
    public $katalog_deskripsi;

    // UNIT USAHA
    public $unit_usaha_judul;
    public $unit_usaha_deskripsi;

    // KONSTRUKSI
    public $konstruksi_hero_desc;

    // GALERI
    public $galeri_judul;
    public $galeri_deskripsi;

    // TENTANG KAMI
    public $tentang_hero_desc;
    public $tentang_sejarah_1;
    public $tentang_sejarah_2;

    // FIELD JSON (list/array item)
    public $mengapa_kami;
    public $tentang_milestones;
    public $tentang_leaders;
    public $tentang_values;

    public function mount()
    {
        $this->stat_tahun_pengalaman = Setting::get('stat_tahun_pengalaman', '15+');
        $this->stat_pelanggan_puas   = Setting::get('stat_pelanggan_puas', '2.5k');

        $this->katalog_judul     = Setting::get('katalog_judul', 'Layanan Sewa Bus Pariwisata Profesional');
        $this->katalog_deskripsi = Setting::get('katalog_deskripsi', 'Limas Putra telah berpengalaman lebih dari satu dekade dalam menyediakan jasa transportasi pariwisata.');

        $this->unit_usaha_judul     = Setting::get('unit_usaha_judul', 'Unit Usaha Limas Putra');
        $this->unit_usaha_deskripsi = Setting::get('unit_usaha_deskripsi', 'Temukan berbagai layanan unggulan kami melalui tiga bidang usaha utama yang mengutamakan kualitas, profesionalisme, dan kepercayaan pelanggan.');

        $this->konstruksi_hero_desc = Setting::get('konstruksi_hero_desc', 'Layanan pemborong & kontraktor profesional untuk pembangunan struktur, gedung, dan infrastruktur.');

        $this->galeri_judul     = Setting::get('galeri_judul', 'Galeri Dokumentasi');
        $this->galeri_deskripsi = Setting::get('galeri_deskripsi', 'Jelajahi kumpulan foto kegiatan, armada bus pariwisata, material toko bangunan, dan pengerjaan proyek konstruksi Limas Putra.');

        $this->tentang_hero_desc = Setting::get('tentang_hero_desc', 'Mengenal lebih dekat perjalanan, nilai-nilai, dan komitmen kami dalam melayani masyarakat Indonesia.');
        $this->tentang_sejarah_1 = Setting::get('tentang_sejarah_1', 'Berdiri sejak puluhan tahun lalu, kami tumbuh dari sebuah unit usaha kecil menjadi grup bisnis terpadu.');
        $this->tentang_sejarah_2 = Setting::get('tentang_sejarah_2', 'Seiring berjalannya waktu, komitmen kami pada kualitas membuat kami dipercaya oleh ratusan mitra bisnis.');

        $this->mengapa_kami = json_encode(Setting::getJson('mengapa_kami', [
            ['icon' => 'shield', 'title' => 'Reliability', 'desc' => 'Kepercayaan adalah pondasi utama kami dalam setiap layanan yang kami berikan.'],
            ['icon' => 'bolt', 'title' => 'Strength', 'desc' => 'Kekuatan sumber daya dan infrastruktur kami menjamin kualitas hasil kerja.'],
            ['icon' => 'briefcase', 'title' => 'Professionalism', 'desc' => 'Dikelola oleh tenaga ahli berpengalaman yang mengutamakan ketepatan waktu.'],
            ['icon' => 'trending-up', 'title' => 'Growth', 'desc' => 'Terus berinovasi untuk memberikan nilai tambah bagi bisnis dan pelanggan kami.'],
        ]), JSON_PRETTY_PRINT);

        $this->tentang_milestones = json_encode(Setting::getJson('tentang_milestones', [
            ['year' => '2010', 'desc' => 'Perusahaan didirikan dengan fokus awal pada bisnis armada transportasi bus pariwisata.'],
            ['year' => '2015', 'desc' => 'Ekspansi bisnis ke sektor retail material bangunan dan perlengkapan konstruksi.'],
            ['year' => '2019', 'desc' => 'Pembentukan divisi jasa konstruksi profesional untuk melayani proyek-proyek skala nasional.'],
            ['year' => '2023', 'desc' => 'Telah melayani lebih dari 500+ klien aktif dan terus berkembang menjadi grup usaha terintegrasi.'],
        ]), JSON_PRETTY_PRINT);

        $this->tentang_leaders = json_encode(Setting::getJson('tentang_leaders', [
            ['name' => 'H. Bambang S.', 'role' => 'Pendiri & Komisaris Utama', 'desc' => 'Memiliki pengalaman lebih dari 20 tahun dalam memimpin arah strategis perusahaan.'],
            ['name' => 'Ardi Wijaya', 'role' => 'Direktur Utama', 'desc' => 'Fokus pada inovasi, operasional berkelanjutan, dan ekspansi pasar bisnis grup.'],
        ]), JSON_PRETTY_PRINT);

        $this->tentang_values = json_encode(Setting::getJson('tentang_values', [
            ['title' => 'Integritas', 'desc' => 'Mengutamakan kejujuran, transparansi, dan komitmen penuh dalam setiap lini bisnis.'],
            ['title' => 'Kualitas', 'desc' => 'Selalu memberikan produk dan layanan terbaik dengan standar keamanan dan mutu tinggi.'],
            ['title' => 'Pelayanan', 'desc' => 'Kepuasan pelanggan adalah prioritas utama melalui respon cepat dan solusi yang tepat.'],
        ]), JSON_PRETTY_PRINT);
    }

    public function render()
    {
        return view('livewire.setting.konten')->layout('layouts.admin');
    }

    public function simpan()
    {
        $this->validate([
            'stat_tahun_pengalaman' => 'required|string',
            'stat_pelanggan_puas'   => 'required|string',
            'katalog_judul'         => 'required|string',
            'katalog_deskripsi'     => 'required|string',
            'unit_usaha_judul'      => 'required|string',
            'unit_usaha_deskripsi'  => 'required|string',
            'konstruksi_hero_desc'  => 'required|string',
            'galeri_judul'          => 'required|string',
            'galeri_deskripsi'      => 'required|string',
            'tentang_hero_desc'     => 'required|string',
            'tentang_sejarah_1'     => 'required|string',
            'tentang_sejarah_2'     => 'required|string',
            'mengapa_kami'          => 'required|json',
            'tentang_milestones'    => 'required|json',
            'tentang_leaders'       => 'required|json',
            'tentang_values'        => 'required|json',
        ]);

        Setting::set('stat_tahun_pengalaman', $this->stat_tahun_pengalaman);
        Setting::set('stat_pelanggan_puas', $this->stat_pelanggan_puas);
        Setting::set('katalog_judul', $this->katalog_judul);
        Setting::set('katalog_deskripsi', $this->katalog_deskripsi);
        Setting::set('unit_usaha_judul', $this->unit_usaha_judul);
        Setting::set('unit_usaha_deskripsi', $this->unit_usaha_deskripsi);
        Setting::set('konstruksi_hero_desc', $this->konstruksi_hero_desc);
        Setting::set('galeri_judul', $this->galeri_judul);
        Setting::set('galeri_deskripsi', $this->galeri_deskripsi);
        Setting::set('tentang_hero_desc', $this->tentang_hero_desc);
        Setting::set('tentang_sejarah_1', $this->tentang_sejarah_1);
        Setting::set('tentang_sejarah_2', $this->tentang_sejarah_2);
        Setting::set('mengapa_kami', $this->mengapa_kami);
        Setting::set('tentang_milestones', $this->tentang_milestones);
        Setting::set('tentang_leaders', $this->tentang_leaders);
        Setting::set('tentang_values', $this->tentang_values);

    $this->dispatch('toast', message: 'Konten berhasil disimpan.');    }
}