<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantingSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['crop_id', 'activity_name', 'scheduled_date', 'status'];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
