<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantingSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['crop_id', 'plant_date', 'estimated_harvest_date'];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
