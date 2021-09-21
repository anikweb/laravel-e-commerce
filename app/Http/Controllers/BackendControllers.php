<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\checkoutDetail;
use Auth;


class BackendControllers extends Controller
{
    function dashboard(){
        if(auth()->user()->roles()->first()->name =='Customer'){
            session()->put('pDeleteSecurity','false');
            return view('backend.customerDashboard',[
                'orders' => checkoutDetail::where('user_id',Auth::user()->id)->paginate(10),
            ]);
        }else{
            session()->put('pDeleteSecurity','false');
            return view('backend.dashboard');
        }


    }
}
