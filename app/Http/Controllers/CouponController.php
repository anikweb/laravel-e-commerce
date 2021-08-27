<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('view coupon')){
            return view('backend.coupon.index',[
                'coupons' => Coupon::latest()->paginate(10),
            ]);
        }else{
            return abort('404');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('add coupon')){
            return view('backend.coupon.create');
        }else{
            return abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name'=> 'required|unique:coupons,coupon_name',
            'discount_range'=>'required',
            'limit'=>'required',
            'expiry_date'=>'required',

        ],
        [
            'coupon_name.unique' => $request->coupon_name." has already taken."
        ]);
        $coupon = new Coupon;
        $coupon->coupon_name = $request->coupon_name;
        $coupon->discount_range = $request->discount_range;
        $coupon->limit = $request->limit;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->expiry_time = $request->expiry_time;
        $coupon->save();
        return redirect()->route('coupon.index')->with('success',$coupon->coupon_name.' Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        if(auth()->user()->can('view coupon')){
            return view('backend.coupon.show',[
                'coupon' =>$coupon,
            ]);
        }else{
            return abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        if(auth()->user()->can('edit coupon')){
            return view('backend.coupon.edit',[
                'coupon'=>$coupon,
            ]);
        }else{
            return abort('404');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        // return $coupon;
        $request->validate([
            'coupon_name'=> 'required|unique:coupons,coupon_name,'.$coupon->id,
            'discount_range'=>'required',
            'limit'=>'required',
            'expiry_date'=>'required',

        ],
        [
            'coupon_name.unique' => $request->coupon_name." has already taken."
        ]);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->discount_range = $request->discount_range;
        $coupon->limit = $request->limit;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->expiry_time = $request->expiry_time;
        $coupon->save();
        return redirect()->route('coupon.index')->with('success',$coupon->coupon_name.' Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if(auth()->user()->can('delete coupon')){
            $coupon->delete();
            return back()->with('success','Coupon deleted.');
        }else{
            return abort('404');
        }
    }
    /**
     * Display the Trash
     *
     * You need to create a custom route in web.php
     *
     */
    public function trash()
    {
        if(auth()->user()->can('view trash coupon')){
            return view('backend.coupon.trash',[
                'trash' => Coupon::onlyTrashed()->latest()->paginate(10),
            ]);
        }else{
            return abort('404');
        }

    }

    /**
     * Restore the Trash
     *
     * You need to create a custom route in web.php
     *
     */

    public function restore($id)
    {
        if(auth()->user()->can('restore trash coupon')){
            $trash = Coupon::onlyTrashed()->findOrFail($id);
            $trash->restore();
            return back()->with('success',$trash->coupon_name.' Restore');
        }else{
            return abort('404');
        }
    }

    public function trashDetails($id)
    {
        if(auth()->user()->can('view trash coupon')){
            return view('backend.coupon.trash-show',[
                'coupon' =>Coupon::onlyTrashed()->findOrFail($id),
            ]);
        }else{
            return abort('404');
        }
    }
}
