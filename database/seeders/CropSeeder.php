<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crop;
use App\Models\Farm;
use App\Models\CropType;
use Carbon\Carbon;

class CropSeeder extends Seeder
{
    public function run(): void
    {
        $farm = Farm::first();
        
        $pangan = CropType::where('name', 'Pangan')->first();
        $hortikultura = CropType::where('name', 'Hortikultura')->first();

        if ($farm) {
            if ($pangan) {
                Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $pangan->id,
                    'name' => 'Padi Sawah Petak A',
                    'plant_date' => Carbon::now()->subDays(60),
                    'estimated_harvest_date' => Carbon::now()->addDays(40),
                    'status' => 'Active'
                ]);

                Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $pangan->id,
                    'name' => 'Jagung Hibrida Blok B',
                    'plant_date' => Carbon::now()->subDays(20),
                    'estimated_harvest_date' => Carbon::now()->addDays(80),
                    'status' => 'Active'
                ]);
            }

            if ($hortikultura) {
                Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $hortikultura->id,
                    'name' => 'Cabai Rawit Merah Petak C',
                    'plant_date' => Carbon::now()->subDays(5),
                    'estimated_harvest_date' => Carbon::now()->addDays(90),
                    'status' => 'Active'
                ]);
            }
        }
    }
}
