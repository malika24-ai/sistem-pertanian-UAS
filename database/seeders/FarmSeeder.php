<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Farm;
use App\Models\User;

class FarmSeeder extends Seeder
{
    public function run(): void
    {
        $petani = User::whereHas('role', function($q) { $q->where('name', 'Petani'); })->first();
        if ($petani) {
            Farm::create([
                'user_id' => $petani->id,
                'name' => 'Sawah Subur Makmur',
                'location' => 'Desa Tani Jaya',
                'area' => 1500.50
            ]);
            Farm::create([
                'user_id' => $petani->id,
                'name' => 'Kebun Hijau',
                'location' => 'Desa Tani Makmur',
                'area' => 800.00
            ]);
        }
    }
}
