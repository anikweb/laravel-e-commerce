<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendControllers extends Controller
{
    function dashboard(){
        session()->put('pDeleteSecurity','false');
        return view('backend.dashboard');
    }
}
