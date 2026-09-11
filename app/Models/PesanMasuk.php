<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanMasuk extends Model
{
    protected $fillable = ['nama', 'whatsapp', 'email', 'layanan', 'pesan', 'dibaca'];
}