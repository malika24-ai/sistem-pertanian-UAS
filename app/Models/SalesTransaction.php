<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_id', 'crop_id', 'transaction_date', 'quantity', 'price', 'total'];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
