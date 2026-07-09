<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlantingSchedule;
use App\Models\Crop;
use Carbon\Carbon;

class PlantingScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $crops = Crop::with('cropType')->get();

        foreach ($crops as $crop) {
            $typeName = strtolower($crop->cropType->name ?? '');
            
            // Padi Januari
            if (str_contains(strtolower($crop->name), 'padi') || $typeName == 'pangan') {
                PlantingSchedule::create([
                    'crop_id' => $crop->id,
                    'plant_date' => Carbon::createFromDate(Carbon::now()->year, 1, 15),
                    'estimated_harvest_date' => Carbon::createFromDate(Carbon::now()->year, 4, 15),
                ]);
            }
            // Jagung Februari
            else if (str_contains(strtolower($crop->name), 'jagung')) {
                PlantingSchedule::create([
                    'crop_id' => $crop->id,
                    'plant_date' => Carbon::createFromDate(Carbon::now()->year, 2, 10),
                    'estimated_harvest_date' => Carbon::createFromDate(Carbon::now()->year, 5, 10),
                ]);
            }
            // Cabai Maret
            else if (str_contains(strtolower($crop->name), 'cabai') || $typeName == 'hortikultura') {
                PlantingSchedule::create([
                    'crop_id' => $crop->id,
                    'plant_date' => Carbon::createFromDate(Carbon::now()->year, 3, 5),
                    'estimated_harvest_date' => Carbon::createFromDate(Carbon::now()->year, 6, 5),
                ]);
            }
        }
    }
}
