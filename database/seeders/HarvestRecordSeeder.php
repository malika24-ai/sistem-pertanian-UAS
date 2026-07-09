<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HarvestRecord;
use App\Models\Crop;
use App\Models\Farm;
use App\Models\CropType;

class HarvestRecordSeeder extends Seeder
{
    public function run(): void
    {
        $farm = Farm::first();
        $cropType = CropType::where('name', 'Jagung')->first();

        if ($farm && $cropType) {
            $pastCrop = Crop::create([
                'farm_id' => $farm->id,
                'crop_type_id' => $cropType->id,
                'name' => 'Jagung Musim Lalu',
                'plant_date' => now()->subDays(120),
                'estimated_harvest_date' => now()->subDays(10),
                'status' => 'Harvested'
            ]);

            HarvestRecord::create([
                'crop_id' => $pastCrop->id,
                'harvest_date' => now()->subDays(10),
                'quantity' => 1250.00,
                'quality' => 'Grade A'
            ]);
        }
    }
}
