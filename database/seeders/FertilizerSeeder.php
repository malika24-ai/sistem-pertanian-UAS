<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fertilizer;
use App\Models\Crop;
use Carbon\Carbon;

class FertilizerSeeder extends Seeder
{
    public function run(): void
    {
        $crops = Crop::all();

        foreach ($crops as $crop) {
            Fertilizer::create([
                'crop_id' => $crop->id,
                'name' => 'Urea',
                'type' => 'Anorganik (Kimia)',
                'dosage' => '50 kg / hektar',
                'usage_date' => Carbon::parse($crop->plant_date)->addDays(14),
            ]);

            Fertilizer::create([
                'crop_id' => $crop->id,
                'name' => 'NPK Mutiara',
                'type' => 'Anorganik (Kimia)',
                'dosage' => '25 kg / hektar',
                'usage_date' => Carbon::parse($crop->plant_date)->addDays(30),
            ]);
        }
    }
}
