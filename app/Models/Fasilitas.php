<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    // Kolom nama fasilitas yang boleh diisi.
    protected $fillable = [
        'nama_fasilitas' 
    ];

    public function armadas()
    {
        // Satu fasilitas dapat digunakan oleh beberapa armada.
        return $this->belongsToMany(
            Armada::class,
            'armada_fasilitas'
        );
    }
}