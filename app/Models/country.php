<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;
    public function state(){
        return $this->hasMany(state::class,'country_id');
    }
    public function city(){
        return $this->hasMany(city::class,'country_id');
    }
}
