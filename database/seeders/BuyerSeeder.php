<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buyer;

class BuyerSeeder extends Seeder
{
    public function run(): void
    {
        Buyer::create([
            'name' => 'KUD Tani Makmur',
            'contact' => '081234567890',
            'address' => 'Jl. Desa Makmur No. 12',
            'type' => 'Koperasi',
        ]);

        Buyer::create([
            'name' => 'Bapak Budi (Tengkulak)',
            'contact' => '082345678901',
            'address' => 'Pasar Induk Sayur',
            'type' => 'Pasar Lokal',
        ]);

        Buyer::create([
            'name' => 'FreshMart Supermarket',
            'contact' => '021-5551234',
            'address' => 'Jl. Raya Kota No. 99',
            'type' => 'Supermarket',
        ]);
    }
}
