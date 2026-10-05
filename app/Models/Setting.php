<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Kolom kunci dan nilai yang boleh disimpan sebagai pengaturan website.
    protected $fillable = ['key', 'value'];

    // Helper biar gampang manggil: Setting::get('nama_perusahaan')
    public static function get($key, $default = null)
    {
        // Mengambil nilai pengaturan berdasarkan kunci, atau nilai cadangan jika belum ada.
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function set($key, $value)
    {
        // Menambahkan pengaturan baru atau memperbarui nilai yang sudah ada.
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
    public static function getJson($key, $default = [])
    {
        // Membaca nilai pengaturan JSON sebagai array.
        $value = static::get($key);
        return $value ? json_decode($value, true) : $default;
    }

    public static function setJson($key, $array)
    {
        // Mengubah array menjadi JSON sebelum menyimpannya sebagai pengaturan.
        return static::set($key, json_encode($array));
    }
}