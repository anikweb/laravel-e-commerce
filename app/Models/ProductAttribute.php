<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory,SoftDeletes;

    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    function color(){
        return $this->belongsTo(ProductColor::class,'color_id');
    }
    function size(){
        return $this->belongsTo(ProductSize::class,'size_id');
    }
}
