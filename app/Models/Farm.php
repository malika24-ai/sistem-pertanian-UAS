<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'location', 'area'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function crops()
    {
        return $this->hasMany(Crop::class);
    }
}
