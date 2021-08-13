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
        if($request->cookie('cookie_id')== ''){
            $cookie_name = 'cookie_id';
            $cookie_value = time().'-'.Str::random(10);
            $cookie_duration = 1440;
            Cookie::queue($cookie_name, $cookie_value, $cookie_duration);
            if(Cart::where('cookie_id',Cookie::get('cookie_id'))->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
                Cart::where('cookie_id',Cookie::get('cookie_id'))->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
            }else{
                $cart = new Cart;
                $cart->cookie_id = Cookie::get('cookie_id');
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                $cart->color_id = $request->color_id;
                $cart->size_id = $request->size_id;
                $cart->save();
            }
        }
        return back();
    }
}
