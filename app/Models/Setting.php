<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    // Helper biar gampang manggil: Setting::get('nama_perusahaan')
    public static function get($key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function set($key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
    public static function getJson($key, $default = [])
    {
        $value = static::get($key);
        return $value ? json_decode($value, true) : $default;
    }

    public static function setJson($key, $array)
    {
        return static::set($key, json_encode($array));
    }
}