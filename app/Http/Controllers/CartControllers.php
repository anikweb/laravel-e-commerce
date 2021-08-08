<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class CartControllers extends Controller
{
    function cartView(){
        $cookie_id = Cookie::get('cookie_id');
        return view('frontend/pages/carts',[
            'cartView' => Cart::where('cookie_id',$cookie_id)->get(),
        ]);
    }
    function cartPost(Request $request){
        // return $request->except('_token');
        if($request->hasCookie('cookie_id')){
            $request->cookie('cookie_id');
        }else{
            $cookie_name = 'cookie_id';
            $cookie_value = time().'-'.Str::random(10);
            $cookie_duration = 1440;
            Cookie::queue($cookie_name, $cookie_value, $cookie_duration);
        }
        $cart = new Cart;
        $cart->cookie_id = $request->cookie('cookie_id');
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->color_id = $request->color_id;
        $cart->size_id = $request->size_id;
        $cart->save();
        return back();

    }
}
