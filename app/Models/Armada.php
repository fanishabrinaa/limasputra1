<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    protected $fillable = [
    'nama_bus', 'plat_nomor', 'kapasitas',
    'gambar', 'galeri', 'deskripsi', 'status',
];

    protected $casts = [
        'galeri' => 'array',
    ];

    public function fasilitas()
    {
        return $this->belongsToMany(
            Fasilitas::class,
            'armada_fasilitas'
        );
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}