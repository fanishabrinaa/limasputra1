<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Index as Dashboard;
use App\Livewire\Setting\Index as Setting;
use App\Livewire\Armada\Index as Armada;
use App\Livewire\Fasilitas\Index as Fasilitas;
use App\Livewire\Produk\Index as Produk;
use App\Livewire\Galeri\Index as Galeri;
use App\Livewire\Pemesanan\Index as Pemesanan;
use App\Livewire\Armada\Katalog as ArmadaKatalog;
use App\Livewire\Pemesanan\Index as PemesananIndex;
use App\Livewire\Pemesanan\Create as PemesananCreate;
use App\Livewire\Beranda;
use App\Livewire\Kontak;
use App\Livewire\TentangKami;
use App\Livewire\UnitUsahaIndex;
use App\Livewire\Konstruksi;
use App\Livewire\UnitUsaha;
use App\Livewire\Setting\Index as SettingIndex;
use App\Livewire\Galeri\Index as GaleriIndex;
use App\Livewire\Produk\Index as ProdukIndex;
use App\Livewire\Galeri\Publik as GaleriPublik;
use App\Livewire\Produk\Publik as ProdukPublik;
use App\Livewire\Produk\Detail as ProdukDetail;
use App\Livewire\Pemesanan\Riwayat as PemesananRiwayat;
use App\Livewire\Armada\Detail as ArmadaDetail;
use App\Livewire\Setting\Konten as SettingKonten;
use App\Livewire\PesanMasuk\Index as PesanMasukIndex;
use App\Livewire\Testimoni\Index as TestimoniIndex;
use App\Livewire\Setting\Gambar as SettingGambar;
use App\Livewire\Pemesanan\Sukses as PemesananSukses;
use App\Livewire\Setting\KontenKonstruksi;

// Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/setting', Setting::class)->name('setting');

    Route::get('/armada', Armada::class)->name('armada');

    Route::get('/fasilitas', Fasilitas::class)->name('fasilitas');

    Route::get('/produk', Produk::class)->name('produk');

    Route::get('/galeri', Galeri::class)->name('galeri');

    Route::get('/pemesanan', Pemesanan::class)->name('pemesanan');
    });
    
    Route::middleware(['auth', 'admin'])->group(function () {
        // semua route dashboard admin kamu di sini
    });
    Route::get('/armada-katalog', ArmadaKatalog::class)->name('armada.katalog');
    Route::middleware(['auth', 'admin'])->group(function () {
        // ... route dashboard, armada, fasilitas kamu yang lain
        Route::get('/pemesanan', PemesananIndex::class)->name('pemesanan.index');
    });
    //wajib login
    Route::middleware(['auth'])->group(function () {
        Route::get('/pemesanan/{armadaId}', PemesananCreate::class)->name('pemesanan.create');
        Route::get('/pesanan-saya', PemesananRiwayat::class)->name('pemesanan.riwayat');
        Route::get('/pemesanan/{id}/sukses', PemesananSukses::class)->name('pemesanan.sukses');
    });
    // Publik
    Route::get('/', Beranda::class)->name('beranda');
    Route::get('/tentang-kami', TentangKami::class)->name('about');
    Route::get('/konstruksi', Konstruksi::class)->name('konstruksi');
    Route::get('/unit-usaha', UnitUsaha::class)->name('unit-usaha');
    Route::get('/kontak', Kontak::class)->name('kontak');

    Route::get('/armada-katalog', ArmadaKatalog::class)->name('armada.katalog');
    Route::get('/armada/{id}', ArmadaDetail::class)->name('armada.detail');

    Route::get('/produk-publik', ProdukPublik::class)->name('produk.publik');
    Route::get('/produk/{id}', ProdukDetail::class)->name('produk.detail');

    Route::get('/galeri-publik', GaleriPublik::class)->name('galeri.publik');

    // Admin    
    Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/armada', Armada::class)->name('armada');
    Route::get('/fasilitas', Fasilitas::class)->name('fasilitas');
    Route::get('/pemesanan', PemesananIndex::class)->name('pemesanan.index');
    Route::get('/produk', ProdukIndex::class)->name('produk.index');
    Route::get('/galeri', GaleriIndex::class)->name('galeri.index');
    Route::get('/setting', SettingIndex::class)->name('setting.index');
    Route::get('/pesan-masuk', PesanMasukIndex::class)->name('pesan-masuk.index');
    Route::get('/testimoni', TestimoniIndex::class)->name('testimoni.index');
    Route::get('/setting/konten', SettingKonten::class)->name('setting.konten');
    Route::get('/setting/gambar', SettingGambar::class)->name('setting.gambar');
    Route::get('/setting/konten-konstruksi', KontenKonstruksi::class)->name('setting.konten-konstruksi');
});

// require __DIR__.'/settings.php';