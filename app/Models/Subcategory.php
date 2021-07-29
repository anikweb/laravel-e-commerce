<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    function category(){
        return $this->belongsTo(Category::class,'foreign_key');
    }
    function product(){
        return $this->hasMany(Product::class,'subcategory_id');
    }
}
