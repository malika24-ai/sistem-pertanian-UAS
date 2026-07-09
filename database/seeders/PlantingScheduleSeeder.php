<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlantingSchedule;
use App\Models\Crop;

class PlantingScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $crop = Crop::first();

        if ($crop) {
            PlantingSchedule::create([
                'crop_id' => $crop->id,
                'activity_name' => 'Penyemaian Benih',
                'scheduled_date' => \Carbon\Carbon::parse($crop->plant_date),
                'status' => 'Completed'
            ]);
            PlantingSchedule::create([
                'crop_id' => $crop->id,
                'activity_name' => 'Pemupukan Tahap 1',
                'scheduled_date' => \Carbon\Carbon::parse($crop->plant_date)->addDays(14),
                'status' => 'Completed'
            ]);
            PlantingSchedule::create([
                'crop_id' => $crop->id,
                'activity_name' => 'Pemupukan Tahap 2',
                'scheduled_date' => \Carbon\Carbon::parse($crop->plant_date)->addDays(30),
                'status' => 'Pending'
            ]);
        }
    }
}
