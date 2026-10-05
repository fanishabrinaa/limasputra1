<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    // Kolom yang boleh diisi saat data pemesanan dibuat atau diperbarui.
    protected $fillable = [
        'kode_pemesanan',
        'armada_id',
        'user_id',
        'nama_pemesan',
        'email',
        'no_hp',
        'instansi',
        'tanggal_berangkat',
        'tanggal_pulang',
        'tujuan',
        'jumlah_penumpang',
        'catatan',
        'status',
        'alasan_penolakan',
        'jemputan',
    ];
    // Satu pemesanan dapat memiliki satu testimoni.
    public function testimoni()
{
    return $this->hasOne(Testimoni::class);
}
    // Menghubungkan pemesanan dengan armada yang disewa.
    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }
    // Menghubungkan pemesanan dengan akun pelanggan.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}