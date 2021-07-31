<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use App\Models\ProductColor;
use App\Models\ProductImageGallery;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;



class ProductControllers extends Controller
{
    function viewProducts(){
        return view('backend.product.products-view',[
            'prodView'=>Product::with('subcategory')->latest()->paginate(),
            'catViewCount'=>Product::count(),
        ]);
    }
    function addProducts(){
        return view('backend.product.product-form',[
            'catView' => Category::all(),
            'colrView' => ProductColor::orderBy('color_name','asc')->get(),
            'sizeView' => ProductSize::all(),
        ]);
    }
    function postProducts(Request $request){
        $request->validate([
                'product_title' => ['required','unique:products,title'],
                'category_id'=> ['required'],
                'subCategory_id'=> ['required'],
                'summary'=> ['required','max:500'],
                'description'=> ['required','max:800'],
                'product_thumbnail'=> ['required','mimes:jpg,jpeg,png'],

            ],[
                    'product_title.unique' => 'This product has already been taken',
                    'rPrice[].required' => 'Regular price is required.',
                    'ofrPrice[].required' => 'Offer price is required.',
                ]);

        $product = new Product;
        $product->title = $request->product_title;
        $product->slug = Str::slug($request->product_title);

        $product->Category_id = $request->category_id;
        $product->subcategory_id = $request->subCategory_id;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $slug = Str::slug($request->product_title);

        if($request->hasFile('product_thumbnail')){

            $image = $request->file('product_thumbnail');
            // return $image[0]->getClientOriginalName();
            $ext = $slug.'-'.Str::random(10).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('products/thumbnails/'.$ext));
            $product->thumbnail = $ext;
        }
        $product->save();
        if($request->hasFile('imageGallery')){
            foreach ($request->file('imageGallery') as $image) {

                $imgGallery = new ProductImageGallery;
                $ext = $slug.'-'.Str::random(10).'.'.$image->getClientOriginalExtension();
                $destination = public_path('products/image-gallery/'.$ext);
                Image::make($image)->save($destination);
                $imgGallery->product_id = $product->id;
                $imgGallery->image_name = $ext;
                $imgGallery->save();

            }
        }

        foreach ($request->color as $key => $colors) {

            $attr = new ProductAttribute;
            $attr->product_id = $product->id;
            $attr->color_id = $colors;
            $attr->size_id = $request->size[$key];
            $attr->regular_price = $request->rPrice[$key];
            $attr->offer_price = $request->ofrPrice[$key];
            $attr->quantity = $request->quantity[$key];
            $attr->save();
        }

        return redirect('products-list')->with('success','Product Added');
    }
    function getSubCat($cat_id){
        $getSubcat = Subcategory::where('foreign_key',$cat_id)->get();
        return response()->json($getSubcat);
    }
    function editProduct($slug){
        $product =  Product::where('slug',$slug)->first();
        return view('backend.product.product-edit',[
            'catView'=>Category::all(),
            'productView'=>$product,
            'colrView' => ProductColor::orderBy('color_name','asc')->get(),
            'sizeView' => ProductSize::all(),
            'scatView'=>Subcategory::where('foreign_key',$product->Category_id)->get(),
            // 'productAttribute'=>ProductAttribute::where('product_id',$product->id)->get(),
        ]);
    }
    function updatePostProduct(Request $request){
        // return $request->all();
        $product = Product::findOrFail($request->product_id);
        $product->title = $request->product_title;
        $product->slug = Str::slug($request->product_title);
        $product->Category_id = $request->category_id;
        $product->subcategory_id = $request->subCategory_id;
        $product->summary = $request->summary;
        $product->description = $request->description;
        if($request->hasFile('product_thumbnail')){
            $old_thumbnail = public_path('products/thumbnails/'.$product->thumbnail);
            if(file_exists($old_thumbnail)){
                unlink($old_thumbnail);
            }
            $slug= Str::slug($request->product_title);
            $image = $request->file('product_thumbnail');
            $ext = $slug.'-'.Str::random(10).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('products/thumbnails/'.$ext));
            $product->thumbnail = $ext;
        }
        $product->save();
        foreach($request->attrId as $key => $attrId){
            if($attrId !=''){
                $attr = ProductAttribute::findOrFail($attrId);
                $attr->product_id = $request->product_id;
                $attr->color_id = $request->color[$key];
                $attr->size_id= $request->size[$key];
                $attr->regular_price = $request->rPrice[$key];
                $attr->offer_price = $request->ofrPrice[$key];
                $attr->quantity = $request->quantity[$key];
                $attr->save();
            }else{
                $attr = new ProductAttribute;
                $attr->product_id = $request->product_id;
                $attr->color_id = $request->color[$key];
                $attr->size_id = $request->size[$key];
                $attr->regular_price = $request->rPrice[$key];
                $attr->offer_price = $request->ofrPrice[$key];
                $attr->quantity = $request->quantity[$key];
                $attr->save();
            }
        }
        return redirect('products-list')->with('success','Product Updated');
    }
}
