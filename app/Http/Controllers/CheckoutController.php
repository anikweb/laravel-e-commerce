<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutForm;
use Auth;
use App\Models\checkoutDetail;
use App\Models\city;
use Illuminate\Http\Request;
use App\Models\country;
use App\Models\state;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('iscustomer');
    }
    public function checkout(){
        return view('frontend.pages.checkout',[
            'countries' =>country::orderBy('name','asc')->get(),
        ]);
    }
    public function getState(Request $request){
        // print_r($request->all());
        $option = "<option value=''>-Select-</option>";
        $statelist = state::where('country_id',$request->country_id)->get();

        foreach ($statelist as $state) {

            $option .= "<option value='$state->id'>$state->name</option>";
        }
        echo $option;
        // return response()->json($state);
    }
    public function getCityList(Request $request){
        // print_r($request->all());
        $option = "<option value=''>-Select-</option>";
        $citylist = city::where('state_id',$request->state_id)->get();
        foreach ($citylist as $city) {
            $option .= "<option value='$city->id'>$city->name</option>";
        }
        echo $option;
        // return response()->json($state);
    }
    public function checkoutStore(CheckoutForm $request){
        // print_r(session()->all());
        // return session()->get('cart_coupon_name');
        // echo  session()->get('cart_subtotal_ammount').'<br/>';
        // echo  session()->get('cart_shipping_fee').'<br/>';
        // echo  session()->get('cart_total_discount').'<br/>';
        // echo session()->get('cart_coupon_name');
        // return ;
        $country = country::find($request->country)->name;
        $city = city::find($request->city)->name;
        $state = state::find($request->state)->name;
        checkoutDetail::create($request->except('_token','country','city','state',)+[
            'user_id' => Auth::user()->id,
            'country' =>$country,
            'city' =>$city,
            'state' =>$state,
            'coupon_name' => session()->get('cart_coupon_name'),
            'discount' => session()->get('cart_total_discount'),
            'shipping_fee' => session()->get('cart_shipping_fee'),
            'total_price' => (session()->get('cart_subtotal_ammount') + session()->get('cart_shipping_fee'))-(session()->get('cart_total_discount')),
        ]);
    }


}
