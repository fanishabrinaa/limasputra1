<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $settings = [
        'nama_perusahaan' => 'PT Contoh Pariwisata',
        'deskripsi' => 'Perusahaan bus pariwisata sejak 2010',
        'alamat' => 'Jl. Contoh No. 1',
        'telepon' => '0812xxxxxxx',
        'email' => 'info@contoh.com',
    ];

    foreach ($settings as $key => $value) {
        \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
}
    $this->call(SettingSeeder::class);