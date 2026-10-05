<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    // Nama tabel galeri yang digunakan oleh model ini.
    protected $table = 'galeri';

    // Kolom yang boleh diisi saat foto galeri disimpan.
    protected $fillable = [
        'judul',
        'kategori',
        'gambar',
        'deskripsi',
    ];
}