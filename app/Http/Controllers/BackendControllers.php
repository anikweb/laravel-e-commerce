<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\checkoutDetail;
use App\Models\User;
use Auth;
use PDF;

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
            return view('backend.dashboard',[
                'orders' => checkoutDetail::all(),
                'users' => User::all(),
            ]);
        }
    }
    public function downloadCustomerInvoice($billing_id){
       if(auth()->user()->roles()->first()->name === "Customer"){

            $checkoutDetail = checkoutDetail::find($billing_id);
            $pdf = PDF::loadView('backend.download.pdf.customer_invoice', compact('checkoutDetail'));
            return $pdf->stream('invoice.pdf');
       }else{
            return abort(404);
       }
    }
}
