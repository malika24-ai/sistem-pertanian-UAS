<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HarvestRecord;
use App\Models\Crop;
use App\Models\Farm;
use App\Models\CropType;
use Carbon\Carbon;

class HarvestRecordSeeder extends Seeder
{
    public function run(): void
    {
        $farm = Farm::first();
        $pangan = CropType::where('name', 'Pangan')->first();
        $hortikultura = CropType::where('name', 'Hortikultura')->first();

        if ($farm) {
            // Musim Hujan (Padi)
            if ($pangan) {
                $padiMusimLalu = Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $pangan->id,
                    'name' => 'Padi Sawah Musim Hujan',
                    'plant_date' => Carbon::now()->subDays(150),
                    'estimated_harvest_date' => Carbon::now()->subDays(30),
                    'status' => 'Harvested'
                ]);

                HarvestRecord::create([
                    'crop_id' => $padiMusimLalu->id,
                    'harvest_date' => Carbon::now()->subDays(30),
                    'quantity' => 2500.50,
                    'quality' => 'Grade A'
                ]);
            }

            // Musim Kemarau (Jagung)
            if ($pangan) {
                $jagungMusimLalu = Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $pangan->id,
                    'name' => 'Jagung Hibrida Musim Kemarau',
                    'plant_date' => Carbon::now()->subDays(120),
                    'estimated_harvest_date' => Carbon::now()->subDays(10),
                    'status' => 'Harvested'
                ]);

                HarvestRecord::create([
                    'crop_id' => $jagungMusimLalu->id,
                    'harvest_date' => Carbon::now()->subDays(10),
                    'quantity' => 1250.00,
                    'quality' => 'Standard'
                ]);
            }

            // Musim Pancaroba (Cabai)
            if ($hortikultura) {
                $cabaiMusimLalu = Crop::create([
                    'farm_id' => $farm->id,
                    'crop_type_id' => $hortikultura->id,
                    'name' => 'Cabai Rawit Musim Pancaroba',
                    'plant_date' => Carbon::now()->subDays(130),
                    'estimated_harvest_date' => Carbon::now()->subDays(5),
                    'status' => 'Harvested'
                ]);

                HarvestRecord::create([
                    'crop_id' => $cabaiMusimLalu->id,
                    'harvest_date' => Carbon::now()->subDays(5),
                    'quantity' => 450.75,
                    'quality' => 'Grade B'
                ]);
            }
        }
    }
}
