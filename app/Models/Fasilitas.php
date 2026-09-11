<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = [
        'nama_fasilitas' 
    ];

    public function armadas()
    {
        return $this->belongsToMany(
            Armada::class,
            'armada_fasilitas'
        );
    }
}