<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $fillable = ['armada_id', 'user_id', 'pemesanan_id', 'nama', 'jabatan', 'perusahaan', 'pesan', 'rating', 'tampilkan'];

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}