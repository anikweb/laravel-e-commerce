<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    function category(){
        return $this->belongsTo(Category::class,'Category_id');
    }
    function subcategory(){
        return $this->belongsTo(subcategory::class,'subcategory_id');
    }
    function productColor(){
        return $this->belongsTo(productColor::class,'product_id');
    }
    function attribute(){
        return $this->hasMany(ProductAttribute::class,'product_id');
    }
    function imageGallery(){
        return $this->hasMany(ProductImageGallery::class,'product_id');
    }
    function cart(){
        return $this->hasMany(Cart::class,'product_id');
    }
}
