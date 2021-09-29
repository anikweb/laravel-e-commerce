<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\CheckoutForm;
use Illuminate\Support\Facades\Cookie;
use App\Models\checkoutDetail;
use App\Models\city;
use Illuminate\Http\Request;
use App\Models\country;
use App\Models\Order_summary;
use App\Models\state;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order_detail;
use App\Models\ProductAttribute;
use App\Models\Product;

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
        // print_r(session()->get('cart_shipping_fee'));
        // return ;
        // return $request->country;

        if($request->country == 19){
            session(['cart_shipping_fee'=>'100']);
        }else{
            session(['cart_shipping_fee'=>'300']);
        }

        // return session('cart_shipping_fee');
        $country = country::find($request->country)->name;
        $city = city::find($request->city)->name;
        $state = state::find($request->state)->name;
        $checkout = checkoutDetail::create($request->except('_token','country','city','state',)+[
            'user_id' => Auth::user()->id,
            'country' =>$country,
            'city' =>$city,
            'state' =>$state,
        ]);
        $orderSummaryId =  Order_summary::insertGetId([
            "checkout_id" => $checkout->id,
            "coupon_name" => session()->get('cart_coupon_name'),
            "discount" => session()->get('cart_total_discount'),
            "shipping_fee" => session()->get('cart_shipping_fee'),
            "sub_total_price" => session()->get('cart_subtotal_ammount'),
            "total_price" => session()->get('cart_subtotal_ammount') + ( session()->get('cart_shipping_fee') - session()->get('cart_total_discount')),
            "created_at" => Carbon::now(),
        ]);
        $totalPrice = session()->get('cart_subtotal_ammount') + ( session()->get('cart_shipping_fee') - session()->get('cart_total_discount'));
        if(session()->get('cart_coupon_name')){
            Coupon::where('coupon_name',session()->get('cart_coupon_name'))->decrement('limit');
        }
        // // return $orderSummaryId;
        // return Cart::get();
        foreach (Cart::where('cookie_id', Cookie::get('cookie_id'))->get() as $cart) {
            Order_detail::insert([
                'order_summary_id' => $orderSummaryId,
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'created_at' =>Carbon::now(),
            ]);
            ProductAttribute::where([
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id
            ])->decrement('quantity',$cart->quantity);
            $cart->delete();
        }
        // SMS Nottification start
        $url = "http://66.45.237.70/api.php";
        $number= $request->phone;
        $text= 'Hello '.$request->name.'. Your Order Placed Successfully. Total amount: $'.$totalPrice."\n \n".'Thanks for your Order.';
        $data= array(
        'username'=>"01834833973",
        'password'=>"TE47RSDM",
        'number'=>"$number",
        'message'=>"$text"
        );
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
        // SMS Nottification end

        return redirect('/');
    }


}
