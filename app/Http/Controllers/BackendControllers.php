<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\checkoutDetail;
use App\Models\Order_detail;
use App\Models\Order_summary;
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
            $order_summary = Order_summary::where('checkout_id',$checkoutDetail->id)->first();
            $order_details = Order_detail::where('order_summary_id',$order_summary->id)->get();
            $pdf = PDF::loadView('backend.download.pdf.customer_invoice', compact('checkoutDetail','order_details','order_summary'))->setPaper('a4', 'portrait');
            return $pdf->stream('invoice.pdf');
       }else{
            return abort(404);
       }
    }
}
