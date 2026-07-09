<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CropType;

class CropTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Padi', 'description' => 'Tanaman padi sawah'],
            ['name' => 'Jagung', 'description' => 'Jagung manis hibrida'],
            ['name' => 'Cabai', 'description' => 'Cabai rawit merah']
        ];
        foreach ($types as $type) {
            CropType::create($type);
        }
    }
}
