<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
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
    ];
    public function testimoni()
{
    return $this->hasOne(Testimoni::class);
}
    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}