<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeatherLog;
use App\Models\Farm;
use Carbon\Carbon;

class WeatherLogSeeder extends Seeder
{
    public function run(): void
    {
        $farms = Farm::all();

        foreach ($farms as $farm) {
            WeatherLog::create([
                'farm_id' => $farm->id,
                'date' => Carbon::today()->subDays(2),
                'condition' => 'Hujan',
                'temperature' => 24.5,
                'humidity' => 85.0,
            ]);

            WeatherLog::create([
                'farm_id' => $farm->id,
                'date' => Carbon::today()->subDays(1),
                'condition' => 'Mendung',
                'temperature' => 27.0,
                'humidity' => 75.5,
            ]);

            WeatherLog::create([
                'farm_id' => $farm->id,
                'date' => Carbon::today(),
                'condition' => 'Cerah',
                'temperature' => 31.0,
                'humidity' => 60.0,
            ]);
        }
    }
}
