<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    function subcategory(){
        return $this->hasMany(Subcategory::class,'foreign_key');
    }
    function product(){
        return $this->hasMany(Product::class,'Category_id');
    }

}

