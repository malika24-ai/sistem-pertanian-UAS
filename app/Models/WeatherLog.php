<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherLog extends Model
{
    use HasFactory;

    protected $fillable = ['farm_id', 'date', 'condition', 'temperature', 'humidity'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
