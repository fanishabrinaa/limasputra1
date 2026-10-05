<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    // Kolom yang boleh diisi saat testimoni disimpan.
    protected $fillable = ['armada_id', 'user_id', 'pemesanan_id', 'nama', 'jabatan', 'perusahaan', 'pesan', 'rating', 'tampilkan'];

    public function armada()
    {
        // Menghubungkan testimoni dengan armada yang dinilai.
        return $this->belongsTo(Armada::class);
    }

    public function user()
    {
        // Menghubungkan testimoni dengan akun pengirimnya.
        return $this->belongsTo(User::class);
    }

    public function pemesanan()
    {
        // Menghubungkan testimoni dengan pemesanan asalnya.
        return $this->belongsTo(Pemesanan::class);
    }
}