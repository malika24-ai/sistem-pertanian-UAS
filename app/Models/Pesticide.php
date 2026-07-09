<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesticide extends Model
{
    use HasFactory;

    protected $fillable = ['crop_id', 'name', 'type', 'dosage', 'usage_date'];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
