<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    // Kolom yang boleh diisi saat data armada disimpan.
    protected $fillable = [
    'nama_bus', 'plat_nomor', 'kapasitas',
    'gambar', 'galeri', 'deskripsi', 'status',
];

    // Membaca kolom galeri sebagai array agar daftar foto mudah digunakan.
    protected $casts = [
        'galeri' => 'array',
    ];

    public function fasilitas()
    {
        // Menghubungkan armada dan fasilitas melalui tabel penghubung.
        return $this->belongsToMany(
            Fasilitas::class,
            'armada_fasilitas'
        );
    }

    public function pemesanans()
    {
        // Satu armada dapat memiliki banyak data pemesanan.
        return $this->hasMany(Pemesanan::class);
    }
}