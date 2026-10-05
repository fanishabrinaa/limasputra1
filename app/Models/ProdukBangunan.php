<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukBangunan extends Model
{
    // Nama tabel produk yang digunakan oleh model ini.
    protected $table = 'produk';

    // Kolom yang boleh diisi saat data produk disimpan.
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

    // Mengubah kolom berisi JSON menjadi array saat dibaca dari database.
    protected $casts = [
        'spesifikasi' => 'array',
        'keunggulan'  => 'array',
        'galeri'      => 'array',
    ];
}