<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    public function order_summary(){
        return $this->belongsTo(order_summary::class,'order_summary_id');
    }
}
