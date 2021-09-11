@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="{{ route('frontend') }}">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total =0; @endphp
                            @forelse ($cartView as $cart)
                                <tr>
                                    <td class="images">
                                        <img src="{{ asset('products/thumbnails/'.$cart->product->created_at->format('Y/m').'/'.$cart->product->id.'/'.$cart->product->thumbnail) }}" alt="{{ $cart->product->title
                                        }}">
                                    </td>
                                    <td class="product">
                                        {{ $cart->product->title }} <br> (Color: {{ $cart->color->color_name }}, Size: {{ $cart->size->size_name }} )
                                    </td>
                                    <td class="ptice">
                                        <span>${{ App\Models\ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->offer_price }}</span>
                                    </td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{ $cart->quantity }}" />
                                    </td>
                                    <td class="total">
                                        <span>
                                            {{
                                            '$'.App\Models\ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->offer_price * $cart->quantity
                                            }}
                                            @php
                                                $total += App\Models\ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->offer_price * $cart->quantity;
                                            @endphp
                                        </span>

                                    </td>
                                    <td class="remove">
                                        <a href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No product to show</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button>Update Cart</button>
                                    </li>
                                    <li><a href="shop.html">Continue Shopping</a></li>
                                </ul>
                                <h3 id="coupon_section">Coupon</h3>
                                <p>Enter Your Coupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" id="add_coupon_input"  @if($coupon) disabled style="background: gray;color: #ccc;" @endif value="{{ $coupon ? $coupon->coupon_name : '' }}" placeholder="Coupon Code">
                                    @if (session('coupon_fail'))
                                        <div>
                                            <span class="text-danger">
                                                <i class="fa fa-exclamation-circle"></i>
                                                {{ session('coupon_fail') }}
                                            </span>
                                        </div>
                                    @elseif (session('coupon_expired'))
                                        <div>
                                            <span class="text-danger">
                                                <i class="fa fa-exclamation-circle"></i>
                                                {{ session('coupon_expired') }}
                                            </span>
                                        </div>
                                    @elseif (session('coupon_limit_Err'))
                                        <div>
                                            <span class="text-danger">
                                                <i class="fa fa-exclamation-circle"></i>
                                                {{ session('coupon_limit_Err') }}
                                            </span>
                                        </div>
                                    @elseif($coupon)
                                        <div>
                                            <span class="text-success h6">
                                                <i class="fa fa-check-circle"></i>
                                                {{ $coupon->coupon_name.' Coupon Applied!' }}
                                            </span>
                                        </div>
                                    @endif
                                    @if($coupon)
                                        <a style="padding:10px;width: 150px;height: 45px;position: absolute;right: 0;top: 0;background: #ef4836;color: #fff;text-transform: uppercase;border: none;" type="button" id="add_coupon_btn" href="{{ route('cartView') }}"  >Remove Coupon</a>
                                    @else
                                        <button type="button" id="add_coupon_btn">Apply Coupon</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left"> Subtotal </span>{{ '$'.$total }}</li>
                                    @if ($coupon)
                                        <li><span class="pull-left">Discount({{ $coupon->discount_range }}%) </span>{{  '$'.discountCounter($total,$coupon->discount_range) }}</li>
                                        <li><span class="pull-left">Total </span>${{ $total - discountCounter($total,$coupon->discount_range) }}</li>
                                    @else
                                        <li><span class="pull-left">Discount </span>$0</li>
                                        <li><span class="pull-left">Total </span>${{ $total }}</li>
                                    @endif
                                </ul>
                                @php
                                    session()->put('cart_subtotal_ammount',$total);
                                    if ($coupon){
                                        session()->put('cart_total_discount',discountCounter($total,$coupon->discount_range));
                                        session()->put('cart_coupon_name',$coupon->coupon_name);
                                    }else{
                                        session()->forget('cart_total_discount');
                                        session()->forget('cart_coupon_name');
                                    }
                                    // session()->put('cart_subtotal_ammount',$total);
                                @endphp
                                <a href="{{ route('checkout') }}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
@section('footer_js')
    <script>
        $(document).ready(function(){
            $('#add_coupon_btn').click(function(){
                var coupon_name = $('#add_coupon_input').val();
                // alert(coupon_name);
                window.location.href = "{{ route('cartView') }}/"+coupon_name;
            });
        });
        @if(session('success'))
            toastr["success"]("{{ session('success') }}")

            toastr.options = {

            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        @elseif(session('fail'))
            toastr["error"]("{{ session('fail') }}")

            toastr.options = {

            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        @endif
    </script>
@endsection
