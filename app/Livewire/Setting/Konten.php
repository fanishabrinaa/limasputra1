<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Konten extends Component
{
    // TENTANG KAMI
    public $tentang_hero_desc;
    public $tentang_sejarah_1;
    public $tentang_sejarah_2;

    // TENTANG KAMI - TAMBAHAN BARU
    public $tentang_h1_judul;
    public $tentang_sejarah_judul;
    public $tentang_sejarah_badge_angka;
    public $tentang_visi;
    public $tentang_misi;
    public $tentang_values_intro;
    public $tentang_unit_bus_desc;
    public $tentang_unit_bangunan_desc;
    public $tentang_unit_konstruksi_desc;
    public $tentang_cta_judul;
    public $tentang_cta_desc;

    // FIELD JSON (list/array item) — array, bukan string
    public $mengapa_kami = [];
    public $tentang_milestones = [];
    public $tentang_leaders = [];
    public $tentang_values = [];

    public function mount()
    {
        $this->tentang_hero_desc = Setting::get('tentang_hero_desc', 'Mengenal lebih dekat perjalanan, nilai-nilai, dan komitmen kami dalam melayani masyarakat Indonesia.');
        $this->tentang_sejarah_1 = Setting::get('tentang_sejarah_1', 'Berdiri sejak puluhan tahun lalu, kami tumbuh dari sebuah unit usaha kecil menjadi grup bisnis terpadu.');
        $this->tentang_sejarah_2 = Setting::get('tentang_sejarah_2', 'Seiring berjalannya waktu, komitmen kami pada kualitas membuat kami dipercaya oleh ratusan mitra bisnis.');

        $this->tentang_h1_judul            = Setting::get('tentang_h1_judul', 'Mengenal Lebih Dekat');
        $this->tentang_sejarah_judul       = Setting::get('tentang_sejarah_judul', 'Dedikasi Puluhan Tahun dalam Membangun Negeri');
        $this->tentang_sejarah_badge_angka = Setting::get('tentang_sejarah_badge_angka', '20+');
        $this->tentang_visi                = Setting::get('tentang_visi', 'Menjadi perusahaan pilihan utama berbasis solusi terpadu di Indonesia, menghubungkan kebutuhan transportasi, pembangunan, dan infrastruktur secara tepercaya dan berkelanjutan.');
        $this->tentang_values_intro        = Setting::get('tentang_values_intro', 'Prinsip yang mengarahkan setiap keputusan dan tindakan kami dalam melayani Anda.');
        $this->tentang_unit_bus_desc        = Setting::get('tentang_unit_bus_desc', 'Armada bus modern dan nyaman untuk perjalanan wisata maupun perjalanan dinas perusahaan.');
        $this->tentang_unit_bangunan_desc   = Setting::get('tentang_unit_bangunan_desc', 'Menyediakan bahan bangunan berkualitas tinggi untuk kebutuhan proyek skala kecil hingga besar.');
        $this->tentang_unit_konstruksi_desc = Setting::get('tentang_unit_konstruksi_desc', 'Layanan pemborong & kontraktor profesional untuk pembangunan struktur, gedung, dan infrastruktur.');
        $this->tentang_cta_judul            = Setting::get('tentang_cta_judul', 'Punya Pertanyaan atau Butuh Solusi?');
        $this->tentang_cta_desc             = Setting::get('tentang_cta_desc', 'Tim profesional kami siap membantu menjawab pertanyaan Anda mengenai layanan armada bus, kebutuhan bahan bangunan, maupun konsultasi proyek konstruksi.');

        $this->tentang_misi = json_encode(Setting::getJson('tentang_misi', [
            'Memberikan layanan transportasi aman, nyaman, dan tepat waktu bagi seluruh pelanggan nasional.',
            'Menyediakan material bangunan berkualitas tinggi dengan harga kompetitif untuk mendukung konstruksi.',
            'Mengembangkan sumber daya manusia yang profesional dan adopsi teknologi tepat guna.',
        ]), JSON_PRETTY_PRINT);

        $this->mengapa_kami = Setting::getJson('mengapa_kami', [
            ['icon' => 'shield', 'title' => 'Reliability', 'desc' => 'Kepercayaan adalah pondasi utama kami dalam setiap layanan yang kami berikan.'],
            ['icon' => 'bolt', 'title' => 'Strength', 'desc' => 'Kekuatan sumber daya dan infrastruktur kami menjamin kualitas hasil kerja.'],
            ['icon' => 'briefcase', 'title' => 'Professionalism', 'desc' => 'Dikelola oleh tenaga ahli berpengalaman yang mengutamakan ketepatan waktu.'],
            ['icon' => 'trending-up', 'title' => 'Growth', 'desc' => 'Terus berinovasi untuk memberikan nilai tambah bagi bisnis dan pelanggan kami.'],
        ]);

        $this->tentang_milestones = Setting::getJson('tentang_milestones', [
            ['year' => '2010', 'desc' => 'Perusahaan didirikan dengan fokus awal pada bisnis armada transportasi bus pariwisata.'],
            ['year' => '2015', 'desc' => 'Ekspansi bisnis ke sektor retail material bangunan dan perlengkapan konstruksi.'],
            ['year' => '2019', 'desc' => 'Pembentukan divisi jasa konstruksi profesional untuk melayani proyek-proyek skala nasional.'],
            ['year' => '2023', 'desc' => 'Telah melayani lebih dari 500+ klien aktif dan terus berkembang menjadi grup usaha terintegrasi.'],
        ]);

        $this->tentang_leaders = Setting::getJson('tentang_leaders', [
            ['name' => 'H. Bambang S.', 'role' => 'Pendiri & Komisaris Utama', 'desc' => 'Memiliki pengalaman lebih dari 20 tahun dalam memimpin arah strategis perusahaan.'],
            ['name' => 'Ardi Wijaya', 'role' => 'Direktur Utama', 'desc' => 'Fokus pada inovasi, operasional berkelanjutan, dan ekspansi pasar bisnis grup.'],
        ]);

        $this->tentang_values = Setting::getJson('tentang_values', [
            ['title' => 'Integritas', 'desc' => 'Mengutamakan kejujuran, transparansi, dan komitmen penuh dalam setiap lini bisnis.'],
            ['title' => 'Kualitas', 'desc' => 'Selalu memberikan produk dan layanan terbaik dengan standar keamanan dan mutu tinggi.'],
            ['title' => 'Pelayanan', 'desc' => 'Kepuasan pelanggan adalah prioritas utama melalui respon cepat dan solusi yang tepat.'],
        ]);
    }

    public function tambahItem($field)
    {
        $template = match ($field) {
            'mengapa_kami'       => ['icon' => 'shield', 'title' => '', 'desc' => ''],
            'tentang_milestones' => ['year' => '', 'desc' => ''],
            'tentang_leaders'    => ['name' => '', 'role' => '', 'desc' => ''],
            'tentang_values'     => ['title' => '', 'desc' => ''],
            default              => [],
        };

        $this->{$field}[] = $template;
    }

    public function hapusItem($field, $index)
    {
        unset($this->{$field}[$index]);
        $this->{$field} = array_values($this->{$field});
    }

    public function render()
    {
        return view('livewire.setting.konten')->layout('layouts.admin');
    }

    public function simpan()
    {
        $this->validate([
            'tentang_hero_desc'     => 'required|string',
            'tentang_sejarah_1'     => 'required|string',
            'tentang_sejarah_2'     => 'required|string',

            'tentang_h1_judul'              => 'required|string',
            'tentang_sejarah_judul'         => 'required|string',
            'tentang_sejarah_badge_angka'   => 'required|string',
            'tentang_visi'                  => 'required|string',
            'tentang_misi'                  => 'required|json',
            'tentang_values_intro'          => 'required|string',
            'tentang_unit_bus_desc'         => 'required|string',
            'tentang_unit_bangunan_desc'    => 'required|string',
            'tentang_unit_konstruksi_desc'  => 'required|string',
            'tentang_cta_judul'             => 'required|string',
            'tentang_cta_desc'              => 'required|string',

            'mengapa_kami'          => 'required|array',
            'mengapa_kami.*.icon'   => 'required|string',
            'mengapa_kami.*.title'  => 'required|string',
            'mengapa_kami.*.desc'   => 'required|string',

            'tentang_milestones'         => 'required|array',
            'tentang_milestones.*.year'  => 'required|string',
            'tentang_milestones.*.desc'  => 'required|string',

            'tentang_leaders'        => 'required|array',
            'tentang_leaders.*.name' => 'required|string',
            'tentang_leaders.*.role' => 'required|string',
            'tentang_leaders.*.desc' => 'required|string',

            'tentang_values'        => 'required|array',
            'tentang_values.*.title'=> 'required|string',
            'tentang_values.*.desc' => 'required|string',
        ]);

        Setting::set('tentang_hero_desc', $this->tentang_hero_desc);
        Setting::set('tentang_sejarah_1', $this->tentang_sejarah_1);
        Setting::set('tentang_sejarah_2', $this->tentang_sejarah_2);

        Setting::set('tentang_h1_judul', $this->tentang_h1_judul);
        Setting::set('tentang_sejarah_judul', $this->tentang_sejarah_judul);
        Setting::set('tentang_sejarah_badge_angka', $this->tentang_sejarah_badge_angka);
        Setting::set('tentang_visi', $this->tentang_visi);
        Setting::set('tentang_misi', $this->tentang_misi);
        Setting::set('tentang_values_intro', $this->tentang_values_intro);
        Setting::set('tentang_unit_bus_desc', $this->tentang_unit_bus_desc);
        Setting::set('tentang_unit_bangunan_desc', $this->tentang_unit_bangunan_desc);
        Setting::set('tentang_unit_konstruksi_desc', $this->tentang_unit_konstruksi_desc);
        Setting::set('tentang_cta_judul', $this->tentang_cta_judul);
        Setting::set('tentang_cta_desc', $this->tentang_cta_desc);

        Setting::set('mengapa_kami', json_encode($this->mengapa_kami));
        Setting::set('tentang_milestones', json_encode($this->tentang_milestones));
        Setting::set('tentang_leaders', json_encode($this->tentang_leaders));
        Setting::set('tentang_values', json_encode($this->tentang_values));

        $this->dispatch('toast', message: 'Konten Tentang Kami berhasil disimpan.');
    }
}