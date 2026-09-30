<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukBangunan extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'satuan',
        'stok',
        'sku',
        'deskripsi',
        'spesifikasi',
        'keunggulan',
        'gambar',
        'galeri',
    ];

    protected $casts = [
        'spesifikasi' => 'array',
        'keunggulan'  => 'array',
        'galeri'      => 'array',
    ];
}