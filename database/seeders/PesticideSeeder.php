<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesticide;
use App\Models\Crop;
use Carbon\Carbon;

class PesticideSeeder extends Seeder
{
    public function run(): void
    {
        $crops = Crop::all();

        foreach ($crops as $crop) {
            Pesticide::create([
                'crop_id' => $crop->id,
                'name' => 'Pestisida Nabati Ekstrak Nimba',
                'type' => 'Organik',
                'dosage' => '5 liter / hektar',
                'usage_date' => Carbon::parse($crop->plant_date)->addDays(21),
            ]);

            Pesticide::create([
                'crop_id' => $crop->id,
                'name' => 'Fungisida Hayati Trichoderma',
                'type' => 'Organik',
                'dosage' => '2 liter / hektar',
                'usage_date' => Carbon::parse($crop->plant_date)->addDays(45),
            ]);
        }
    }
}
