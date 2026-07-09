<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'crop_type_id',
        'name',
        'plant_date',
        'estimated_harvest_date',
        'status',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function cropType()
    {
        return $this->belongsTo(CropType::class);
    }

    public function plantingSchedules()
    {
        return $this->hasMany(PlantingSchedule::class);
    }

    public function harvestRecords()
    {
        return $this->hasMany(HarvestRecord::class);
    }
}
