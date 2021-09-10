<?php

namespace App\Http\Controllers;

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


}
