<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    function size(){
        return $this->belongsTo(ProductSize::class,'size_id');
    }
    function color(){
        return $this->belongsTo(ProductColor::class,'color_id');
    }
}
