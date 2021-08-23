<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    function frontend(){
        if(Cookie::get('cookie_id') == ''){
            $cookie_name = 'cookie_id';
            $cookie_value = time().'-'.Str::random(10);
            $cookie_duration = 43800;
            Cookie::queue($cookie_name, $cookie_value, $cookie_duration);
        }
        return view('frontend.main',[
            'products'=> Product::latest()->limit(8)->get(),
        ]);
    }
    function productDetails($slug){

        $products = Product::where('slug',$slug)->first();
        $attr = ProductAttribute::where('product_id',$products->id)->get();
        $collection = collect($attr);
        $groupColor = $collection->groupBy('color_id');
        return view('frontend.pages.product-details',[
            'product'=> $products,
            'groupColor' =>$groupColor,
            'imageGallery' => ProductImageGallery::where('product_id',$products->id)->get(),
        ]);
    }
    function getColorSizeId($cid,$pid){
        $sizes = ProductAttribute::where('product_id',$pid)->where('color_id',$cid)->get();
        $outpot = '';
        foreach ($sizes as $key => $size) {
            $outpot =  $outpot.'<input class="sizeCheck @error("size_id") is-invalid @enderror" style="cursor: pointer;" data-price="'.$size->offer_price.'" data-quantity="'.$size->quantity.'" id="size" type="radio" value="'.$size->size_id.'" name="size_id"><label style="cursor: pointer;" for="size">'.'  '. $size->size->size_name .'</label>';
        }
        return response()->json($outpot);
        // echo $outpot;
    }
}
