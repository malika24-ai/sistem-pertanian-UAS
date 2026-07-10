<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesTransaction;
use App\Models\Buyer;
use App\Models\Crop;
use Carbon\Carbon;

class SalesTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = Buyer::all();
        $crops = Crop::all();

        if ($buyers->count() > 0 && $crops->count() > 0) {
            // Transaksi 1
            $buyer1 = $buyers->where('type', 'Koperasi')->first() ?? $buyers->first();
            $crop1 = $crops->first();
            
            SalesTransaction::create([
                'buyer_id' => $buyer1->id,
                'crop_id' => $crop1->id,
                'transaction_date' => Carbon::now()->subDays(20),
                'quantity' => 1500,
                'price' => 5000,
                'total' => 1500 * 5000,
            ]);

            // Transaksi 2
            $buyer2 = $buyers->where('type', 'Supermarket')->first() ?? $buyers->last();
            $crop2 = $crops->last();
            
            SalesTransaction::create([
                'buyer_id' => $buyer2->id,
                'crop_id' => $crop2->id,
                'transaction_date' => Carbon::now()->subDays(5),
                'quantity' => 400,
                'price' => 25000,
                'total' => 400 * 25000,
            ]);
        }
    }
}
