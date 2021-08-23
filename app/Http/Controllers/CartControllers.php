<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class CartControllers extends Controller
{
    function cartView($coupon =''){
        $getDate = date('Y-m-d');
        $getTime = getdate();
        $getTime['hours'].':'.$getTime['minutes'].':00';
        if($coupon !=''){
            if(!Coupon::where('coupon_name',$coupon)->exists()){

                return redirect('carts/#coupon_section')->with('coupon_fail','Coupon does not exists!');
            }
        }
        $coupon = Coupon::where('coupon_name',$coupon)->first();
        $cookie_id = Cookie::get('cookie_id');

        return view('frontend/pages/carts',[
            'cartView' => Cart::where('cookie_id',$cookie_id)->get(),
            'coupon' =>$coupon,
        ]);
    }
    function cartPost(Request $request){
        // if($request->quantity){
        //     return back()->with('quantity_empty','Quantity Required.');
        // }
        $request->validate([
            'quantity' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
        ]);

        if(Cart::where('cookie_id',Cookie::get('cookie_id'))->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
           $insert = Cart::where('cookie_id',Cookie::get('cookie_id'))->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
            if($insert){
                return back()->with('success','Product Added to Cart.');
            }else{
                return back()->with('fail','Failed to Add Product to Cart.');
            }
        }else{
            $cart = new Cart;
            $cart->cookie_id = Cookie::get('cookie_id');
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->save();
            if($cart->save()){
                return back()->with('success','Product Added to Cart.');
            }else{
                return back()->with('fail','Failed to Add Product to Cart.');
            }
        }

    }
}
