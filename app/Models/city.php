<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;

    public function country(){
        return $this->belongsTo(country::class,'country_id');
    }
    public function state(){
        return $this->belongsTo(state::class,'state_id');
    }
}
