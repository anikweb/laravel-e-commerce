<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkoutDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order_summary(){
        return $this->hasMany(Order_summary::class,'checkout_id');
    }
}
