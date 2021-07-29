<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use HasFactory,SoftDeletes;
    function attribute(){
        return $this->hasMany(ProductAttribute::class,'size_id');
    }
}
