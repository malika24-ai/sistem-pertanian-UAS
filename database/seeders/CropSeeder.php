<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crop;
use App\Models\Farm;
use App\Models\CropType;

class CropSeeder extends Seeder
{
    public function run(): void
    {
        $farm = Farm::first();
        $cropType = CropType::where('name', 'Padi')->first();

        if ($farm && $cropType) {
            Crop::create([
                'farm_id' => $farm->id,
                'crop_type_id' => $cropType->id,
                'plant_date' => now()->subDays(60),
                'status' => 'Active'
            ]);
        }
    }
}
