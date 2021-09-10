<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    use HasFactory;

    public function country(){
        return $this->belongsTo(country::class,'country_id');
    }
    public function city(){
        return $this->hasMany(city::class,'state_id');
    }
}
