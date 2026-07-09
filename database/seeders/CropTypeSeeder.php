<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CropType;

class CropTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Pangan', 'description' => 'Tanaman pangan penghasil karbohidrat dan protein.'],
            ['name' => 'Hortikultura', 'description' => 'Tanaman sayuran, buah-buahan, dan tanaman hias.'],
            ['name' => 'Perkebunan', 'description' => 'Tanaman industri dan perkebunan tahunan maupun semusim.']
        ];
        foreach ($types as $type) {
            CropType::create($type);
        }
    }
}
