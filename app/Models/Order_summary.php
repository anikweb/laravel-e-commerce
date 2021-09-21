<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_summary extends Model
{
    use HasFactory;
    public function checkout(){
        return $this->belongsTo(checkoutDetail::class,'checkout_id');
    }
    public function order_details(){
        return $this->hasMany(Order_detail::class,'order_summary_id');
    }
}
