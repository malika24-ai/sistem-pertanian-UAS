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
        
        $padi = CropType::where('name', 'Padi')->first();
        $jagung = CropType::where('name', 'Jagung')->first();
        $cabai = CropType::where('name', 'Cabai')->first();

        if ($farm) {
            if ($padi) {
                Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $padi->id,
                    'name' => 'Padi Sawah Petak A',
                    'plant_date' => Carbon::now()->subDays(60),
                    'estimated_harvest_date' => Carbon::now()->addDays(40),
                    'status' => 'Active'
                ]);
            }

            if ($jagung) {
                Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $jagung->id,
                    'name' => 'Jagung Hibrida Blok B',
                    'plant_date' => Carbon::now()->subDays(20),
                    'estimated_harvest_date' => Carbon::now()->addDays(80),
                    'status' => 'Active'
                ]);
            }

            if ($cabai) {
                Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $cabai->id,
                    'name' => 'Cabai Rawit Merah Petak C',
                    'plant_date' => Carbon::now()->subDays(5),
                    'estimated_harvest_date' => Carbon::now()->addDays(90),
                    'status' => 'Active'
                ]);
            }
        }
    }
}
