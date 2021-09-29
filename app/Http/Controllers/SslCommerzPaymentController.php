<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Http\Requests\CheckoutForm;
use App\Models\{
    country,
    city,
    state,
    checkoutDetail,
    Order_summary,
    Coupon,
    Order_detail,
    Cart,
    ProductAttribute,
};
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(CheckoutForm $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        // dd($request->all());
        // return session()->all();
        if($request->country == 19){
            session(['cart_shipping_fee'=>'100']);
        }else{
            session(['cart_shipping_fee'=>'300']);
        }
        // dd(Cookie::get());
        $total_amount = (session()->get('cart_subtotal_ammount') + session()->get('cart_shipping_fee' ) - session()->get('cart_total_discount'));
        $post_data = array();
        $post_data['total_amount'] = $total_amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = Str::random(5).time(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = $request->city;
        $post_data['cus_state'] = $request->state;
        $post_data['cus_postcode'] = $request->zip_code;
        $post_data['cus_country'] = $request->country;
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Online";
        $post_data['ship_add1'] = $request->address;
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = $request->city;
        $post_data['ship_state'] = $request->state;
        $post_data['ship_postcode'] = $request->zip_code;
        $post_data['ship_phone'] = $request->phone;
        $post_data['ship_country'] = $request->country;

        $post_data['shipping_method'] = "Online";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $request->name.'#'.$request->email.'#'.$request->phone.'#'.$request->country.'#'.$request->state.'#'.$request->city.'#'.$request->address.'#'.$request->post_office.'#'.$request->zip_code.'#'.$request->order_note;
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = session()->get('cart_subtotal_ammount').'#'.session()->get('cart_shipping_fee').'#'.session()->get('cart_total_discount').'#'.session()->get('cart_coupon_name');
        $post_data['value_d'] = Cookie::get('cookie_id');

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        $transaction_status = false;
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();
        #Check order status in order tabel against the transaction id or order id.

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);
                echo "<br >Transaction is successfully Completed";
                $transaction_status = true;
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $transaction_status = true;
            echo "Transaction is Successful";

            echo "Transaction is Successfully Completed";
            // return redirect('/');
            // Checkout End
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            // return



        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
        // if($transaction_status){
        //     echo 'ja ja kore lagbe koren';
        // }else{
        //     echo 'kisui kora lagbe na, vagen';
        // }
        if($transaction_status){
            // Checkout Start
            // dd(explode("#",$request->value_a));
            //Request Item
            $RequestName = explode("#",$request->value_a)[0];
            $RequestEmail = explode("#",$request->value_a)[1];
            $RequestPhone = explode("#",$request->value_a)[2];
            $RequestCountry = explode("#",$request->value_a)[3];
            $RequestState = explode("#",$request->value_a)[4];
            $RequestCity = explode("#",$request->value_a)[5];
            $RequestAddress = explode("#",$request->value_a)[6];
            $RequestPostOffice = explode("#",$request->value_a)[7];
            $RequestZipCode = explode("#",$request->value_a)[8];
            $RequestOrderNote = explode("#",$request->value_a)[9];
            // session Item
            $RequesCartSubtotalAmmount = explode("#",$request->value_c)[0];
            $RequestCartShippingFee = explode("#",$request->value_c)[1];
            $RequestCartTotalDiscount = explode("#",$request->value_c)[2];
            $RequestCartCouponName = explode("#",$request->value_c)[3];
            // Cookie Item
            $Cookie_value = $request->value_d;

            $totalPrice = $RequesCartSubtotalAmmount + $RequestCartShippingFee;
            if($RequestCartTotalDiscount){
                $totalPrice = ($RequesCartSubtotalAmmount + $RequestCartShippingFee) - $RequestCartTotalDiscount;
            }
            // return $totalPrice;
            if($RequestCountry == 19){
                session(['cart_shipping_fee'=>'100']);
            }else{
                session(['cart_shipping_fee'=>'300']);
            }

            // return session('cart_shipping_fee');
            $country = country::find($RequestCountry)->name;
            $city = city::find($RequestCity)->name;
            $state = state::find($RequestState)->name;
            $checkout_id = checkoutDetail::insertGetId([
                'user_id' => Auth::user()->id,
                'name' =>$RequestName,
                'email' => $RequestEmail,
                'phone' => $RequestPhone,
                'country' =>$country,
                'city' =>$city,
                'state' =>$state,
                'address' =>$RequestAddress,
                'post_office' =>$RequestPostOffice,
                'zip_code' =>$RequestZipCode,
                'order_note' =>$RequestOrderNote,
                'payment_method' => 'online',
                'Created_at' =>Carbon::now(),
            ]);
            // $totalPrice = ($RequesCartSubtotalAmmount + $RequestCartShippingFee) - $RequestCartTotalDiscount;
            $orderSummaryId =  Order_summary::insertGetId([
                "checkout_id" => $checkout_id,

                "shipping_fee" => $RequestCartShippingFee,
                "sub_total_price" => $RequesCartSubtotalAmmount,
                "total_price" => $totalPrice,
                "created_at" => Carbon::now(),
            ]);
            if($RequestCartCouponName){
                $orderSummaryId =  Order_summary::insertGetId([
                    "checkout_id" => $checkout_id,
                    "shipping_fee" => $RequestCartShippingFee,
                    "sub_total_price" => $RequesCartSubtotalAmmount,
                    "total_price" => $totalPrice,
                    "coupon_name" => $RequestCartCouponName,
                    "discount" => $RequestCartTotalDiscount,
                    "created_at" => Carbon::now(),
                ]);
            }else{
                $orderSummaryId =  Order_summary::insertGetId([
                    "checkout_id" => $checkout_id,
                    "shipping_fee" => $RequestCartShippingFee,
                    "sub_total_price" => $RequesCartSubtotalAmmount,
                    "total_price" => $totalPrice,
                    "created_at" => Carbon::now(),
                ]);
            }
            if($RequestCartCouponName){
                Coupon::where('coupon_name',$RequestCartCouponName)->decrement('limit');
            }
            // // return $orderSummaryId;
            // return Cart::get();
            foreach (Cart::where('cookie_id',$Cookie_value)->get() as $cart) {
                Order_detail::insert([
                    'order_summary_id' => $orderSummaryId,
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'created_at' =>Carbon::now(),
                ]);
                ProductAttribute::where([
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id
                ])->decrement('quantity',$cart->quantity);
                $cart->delete();
            }
            // SMS Nottification start
            $url = "http://66.45.237.70/api.php";
            $number= $RequestPhone;
            $text= 'Hello '.$RequestName.'. Your Order Placed Successfully. Total amount: $'.$totalPrice."\n \n".'Thanks for your Order.';
            $data= array(
            'username'=>"01834833973",
            'password'=>"TE47RSDM",
            'number'=>"$number",
            'message'=>"$text"
            );
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            $p = explode("|",$smsresult);
            $sendstatus = $p[0];
            // SMS Nottification end

            // Checkout End
        }else{
            echo 'checkout error';
        }
    }
    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();
        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {
            $tran_id = $request->input('tran_id');
            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();
            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);
                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);
                    echo "validation Fail";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
