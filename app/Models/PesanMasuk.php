<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanMasuk extends Model
{
    // Kolom pesan pengunjung yang boleh disimpan ke database.
    protected $fillable = ['nama', 'whatsapp', 'email', 'layanan', 'pesan', 'dibaca'];
}