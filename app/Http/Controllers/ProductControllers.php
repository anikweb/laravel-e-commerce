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
use Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductControllers extends Controller
{
    // Product view code start
    function viewProducts(){
        if(auth()->user()->can('view product')){
            return view('backend.product.products-view',[
                'prodView'=>Product::with(['subcategory','category','productColor','attribute','imageGallery'])->latest()->paginate(),
                'catViewCount'=>Product::count(),
            ]);
        }else{
            return abort('404');
        }
    }
    // Product view code end
    // Stock Out Product View
    public function viewStockOutProducts(){
        if(auth()->user()->can('view product')){
            return view('backend.product.products_stock_out',[
                'prodView'=> Product::with('subcategory')->latest()->paginate(),
                'catViewCount'=> Product::count(),
            ]);
        }else{
            return abort('404');
        }
    }
    // add product code start
    function addProducts(){
        if(auth()->user()->can('add product')){
            return view('backend.product.product-form',[
                'catView' => Category::all(),
                'colrView' => ProductColor::orderBy('color_name','asc')->get(),
                'sizeView' => ProductSize::all(),
            ]);
        }else{
            return abort('404');
        }
    }
    // add product code end
    // insert new product post code start
    function postProducts(Request $request){
        // all input validation
        $request->validate([
                'product_title' => ['required','unique:products,title'],
                'category_id'=> ['required'],
                'subCategory_id'=> ['required'],
                'summary'=> ['required','max:500'],
                'description'=> ['required','max:800'],
                'product_thumbnail'=> ['required','mimes:jpg,jpeg,png'],

            ],[
                // custom message
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
        $product->thumbnail = 'default.png';
        $slug = Str::slug($request->product_title);
        $product->save();
        // thumbnail image code start
        // Dynamic Folder Creation start
        $path1 = public_path('products/thumbnails').'/'.$product->created_at->format('Y/m/').$product->id.'/';
        File::makeDirectory($path1, $mode = 0777, true, true);
        // Dynamic Folder Creation end
        if($request->hasFile('product_thumbnail')){
            $image = $request->file('product_thumbnail');
            // return $image[0]->getClientOriginalName();
            $ext = $slug.'-'.Str::random(10).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save($path1.$ext, 70);
            $product->thumbnail = $ext;
        }
        $product->save();
        // thumbnail image code end
        // gallery image code start
        // Dynamic Folder Creation start
        $path2 = public_path('products/image-gallery').'/'.$product->created_at->format('Y/m/').$product->id.'/';
        File::makeDirectory($path2, $mode = 0777, true, true);
        // Dynamic Folder Creation end
        if($request->hasFile('imageGallery')){
            foreach ($request->file('imageGallery') as $image) {

                $imgGallery = new ProductImageGallery;
                $ext = $slug.'-'.Str::random(10).'.'.$image->getClientOriginalExtension();
                // $destination = public_path('products/image-gallery/'.$ext);
                Image::make($image)->save($path2.$ext);
                $imgGallery->product_id = $product->id;
                $imgGallery->image_name = $ext;
                $imgGallery->save();

            }
        }
        // gallery image code end
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
        // gallery image code end
        // redirect when success
        return redirect('products-list')->with('success','Product Added');
    }
    // insert new product post code end
    // get subcategory by ajax code start
    function getSubCat($cat_id){
        $getSubcat = Subcategory::where('foreign_key',$cat_id)->get();
        return response()->json($getSubcat);
    }
    // get subcategory by ajax code end
    // edit product form view code start
    function editProduct($slug){
        if(auth()->user()->can('edit product')){
            $product =  Product::where('slug',$slug)->first();
            return view('backend.product.product-edit',[
                'catView'=>Category::all(),
                'productView'=>$product,
                'colrView' => ProductColor::orderBy('color_name','asc')->get(),
                'sizeView' => ProductSize::all(),
                'scatView'=>Subcategory::where('foreign_key',$product->Category_id)->get(),
            ]);
        }else{
            return abort('404');
        }
    }
    // edit product form view code end
    // edit product post code start
    function updatePostProduct(Request $request){
        $product = Product::findorFail($request->product_id);
        $product->title = $request->product_title;
        $product->slug = Str::slug($request->product_title);
        $product->Category_id = $request->category_id;
        $product->subcategory_id = $request->subCategory_id;
        $product->summary = $request->summary;
        $product->description = $request->description;
        // $path1 = public_path('products/thumbnails').'/'.$product->created_at->format('Y/m/').$product->id.'/';
        // thumbnail image
        if($request->hasFile('product_thumbnail')){
            $old_thumbnail = public_path('products/thumbnails/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->thumbnail);
            if(file_exists($old_thumbnail)){
                unlink($old_thumbnail);
            }
            $slug= Str::slug($request->product_title);
            $image = $request->file('product_thumbnail');
            $ext = $slug.'-'.Str::random(10).'.'.$image->getClientOriginalExtension();
            $destination = $path1 = public_path('products/thumbnails').'/'.$product->created_at->format('Y/m/').$product->id.'/'.$ext;
            Image::make($image)->save($destination);
            $product->thumbnail = $ext;
        }
        $product->save();
        // gallery image change/update start
        if($request->hasFile('multiple_image')){
            foreach ($request->file('multiple_image') as $key => $glImage) {
                $gl = ProductImageGallery::findOrFail($request->mulImgId[$key]);
                $old_glImage = public_path('products/image-gallery/'.$product->created_at->format('Y/m/').$product->id.'/'.$gl->image_name);
                if(file_exists($old_glImage)){
                    unlink($old_glImage);
                }
                $ext = Str::slug($product->title).'-'.Str::random(10).'.'.$glImage->getClientOriginalExtension();
                $destination = public_path('products/image-gallery/'.$product->created_at->format('Y/m/').$product->id.'/'.$ext);
                Image::make($glImage)->save($destination,70);
                $gl->image_name = $ext;
                $gl->save();
            }
        }
        // gallery image change/update end
        // gallery image add new start
        if($request->hasFile('multiple_image_new')){
            foreach ($request->file('multiple_image_new') as $key => $glImageNew) {
                $gl = new ProductImageGallery;
                $ext = Str::slug($product->title).'-'.Str::random(10).'.'.$glImageNew->getClientOriginalExtension();
                // public_path('products/image-gallery/'.$product->created_at->format('Y/m/').$product->id.'/'.$ext);
                $destination = public_path('products/image-gallery').'/'.$product->created_at->format('Y/m/').$product->id.'/'.$ext;
                Image::make($glImageNew)->save($destination,70);
                $gl->image_name = $ext;
                $gl->product_id = $product->id;
                $gl->save();
            }
        }
        // gallery image add new end
        // attribute update start
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
        // attribute update end
        return redirect('products-list')->with('success','Product Updated');
    }
}
