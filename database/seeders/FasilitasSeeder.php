<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitas = [
            'AC',
            'Wifi',
            'TV',
            'Toilet',
            'Karaoke',
            'USB Charger',
            'Reclining Seat',
        ];

        foreach ($fasilitas as $item) {
            Fasilitas::create([
                'nama_fasilitas' => $item,
            ]);
        }
    }
}