<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\checkoutDetail;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function orders(){
        return view('backend.orders.orders',[
            'orders' => checkoutDetail::where('user_id',Auth::user()->id)->paginate(10),
        ]);
    }
}
