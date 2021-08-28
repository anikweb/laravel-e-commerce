<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendControllers extends Controller
{
    function dashboard(){
        if(auth()->user()->roles()->first()->name =='Customer'){
            session()->put('pDeleteSecurity','false');
            return view('backend.customerDashboard');
        }else{
            session()->put('pDeleteSecurity','false');
            return view('backend.dashboard');
        }


    }
}
