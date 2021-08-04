<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImageGallery;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function frontend(){
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
            $outpot =  $outpot.'<input class="sizeCheck" style="cursor: pointer;" data-price="'.$size->offer_price.'" data-quantity="'.$size->quantity.'" id="size" type="radio" value="" name="size"><label style="cursor: pointer;" for="size">'.'  '. $size->size->size_name .'</label>';
        }
        // return response()->json($sizes);
        echo $outpot;
    }
    function cartView(){
        return view('frontend/pages/carts');
    }
}
