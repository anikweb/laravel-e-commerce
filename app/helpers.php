<?php
    function totalCart(){
        return App\Models\Cart::where('cookie_id',Cookie::get('cookie_id'))->count();
    }
    function cartProducts(){
        return App\Models\Cart::where('cookie_id',Cookie::get('cookie_id'))->get();
    }
    function discountCounter($netAmout, $discountAmout){
        return ($netAmout*$discountAmout)/100;
    }
?>
