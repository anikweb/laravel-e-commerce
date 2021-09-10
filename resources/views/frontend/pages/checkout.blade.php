@extends('frontend.master')
@section('content')
        <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>Checkout</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><span>Checkout</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .breadcumb-area end -->
        <!-- checkout-area start -->
        <div class="checkout-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-form form-style">
                            <h3>Billing Details </h3>
                            <form action="http://themepresss.com/tf/html/tohoney/checkout">
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <p>First Name *</p>
                                        <input type="text" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Email Address *</p>
                                        <input type="email" value="{{ Auth::user()->email }}" >
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Phone No. *</p>
                                        <input type="text">
                                    </div>
                                    <div class="col-sm-4 col-12 ">
                                        <p>Country *</p>
                                        <select name="" id="country_id">
                                            <option value="">-Select-</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-12 ">
                                        <p>State *</p>
                                        <select id="state" name="">
                                            <option value="">-Select-</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-12 ">
                                        <p>City *</p>

                                        <select name="" id="city">
                                            <option value="">-Select-</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <p>Your Address *</p>
                                        <input type="text">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Post Office</p>
                                        <input type="email">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Postcode/ZIP</p>
                                        <input type="text">
                                    </div>
                                    <div class="col-12">
                                        <p>Order Notes </p>
                                        <textarea name="massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                            <ul class="total-cost">
                                <li>Subtotal <span class="pull-right"><strong>{{ session()->get('cart_subtotal_ammount') }}</strong></span></li>
                                <li>Discount <span class="pull-right"><strong>{{ session()->get('cart_total_discount') }}</strong></span></li>
                                <li>Shipping <span class="pull-right shippping-fee">0</span></li>
                                @php
                                    $total = session()->get('cart_subtotal_ammount') - session()->get('cart_total_discount')
                                @endphp
                                <li>Total<span class="pull-right total-ammount">{{ $total }}</span></li>
                            </ul>

                            <ul class="payment-method">
                                <li>
                                    <input id="bank" type="checkbox">
                                    <label for="bank">Direct Bank Transfer</label>
                                </li>
                                <li>
                                    <input id="paypal" type="checkbox">
                                    <label for="paypal">Paypal</label>
                                </li>
                                <li>
                                    <input id="card" type="checkbox">
                                    <label for="card">Credit Card</label>
                                </li>
                                <li>
                                    <input id="delivery" type="checkbox">
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                            </ul>
                            <button>Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
@endsection
@section('footer_js')
    <script>
        $(document).ready(function(){
            $('#country_id').change(function(){
                var country_id = $('#country_id').val();
                // var state_id = $('#state_id').val();
                // alert(country_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url : 'get/state/list',
                    data: {country_id : country_id},
                    success:function(data){
                    //    alert(data);
                    $('#state').html(data);
                    $('#state').change(function(){
                        var state_id = $('#state').val();
                        // alert(state_id);
                        $.ajax({
                            type: 'POST',
                            url: 'get/city/list',
                            data:{state_id:state_id},
                            success:function(data){
                                if(data){
                                    $('#city').html(data);
                                }
                            }
                        });
                    });
                    }
                });
            });
        });
        $(document).ready(function(){
            $('#country_id').select2();
            $('#state').select2();
            $('#city').select2();
            $('#country_id').change(function(){
                var country_id = $('#country_id').val();
                if (country_id == '19'){
                    $('.shippping-fee').html(100);
                    $('.total-ammount').html('{{ $total+100 }}');

                }else{
                    $('.shippping-fee').html('pending');
                    $('.total-ammount').html('{{ $total }}');
                }
            });
        });

    </script>
@endsection
