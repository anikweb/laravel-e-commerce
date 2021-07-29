<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CategoryControllers extends Controller
{
    function categories(){

        return view('backend.category.categories-view',[
            'catView' => Category::latest()->paginate(10),
            'catViewCount' => Category::all()->count(),
        ]);
    }

    function AddCategory(){
        return view('backend.category.category-form');
    }
    function PostCategory(Request $request){
        $request->validate([
            'category_name'=> ['required','min:3','max:30','unique:categories'],
            'category_slug' => 'required|unique:categories',
        ],[
            'category_name.unique'=>'The '.$request->category_name.' has already been taken.'
        ]);
        $cat = new Category;
        $cat->category_name = $request->category_name;
        $cat->category_slug = $request->category_slug;
        $cat->save();
        return redirect('/categories')->with('success','Category Successfully Added');
    }
    function DeleteCategory($datas){
        $cat = Category::findOrFail($datas);
        // return $cat->subcategory->count();
        if($cat->subcategory->count() < 1){
            Category::findOrFail($datas)->delete();
            return back()->with('success','Successfully deleted category');
        }else{
            return back()->with('fail','failed. delete subcategories which is created by this category before delete this category');
        }
        // return $datas;
    }
    function editCategory($data){
        return view('backend.category.category-edit-form',[
            'catView'=> Category::findOrFail($data),
        ]);
     }
    function updateCategory(Request $request){

        $request->validate([
            'category_name'=>['required','min:2','max:30'],
            'category_slug'=> 'required',
        ]);
        $cat = Category::findOrFail($request->category_id);
        $catCount = $cat->where('category_name',$request->category_name)->count();
        $cat->category_name = $request->category_name;
        $cat->category_slug = $request->category_slug;
        $cat->save();
        return redirect('/categories')->with('success','Category Updated');
    }
    function trashedCategories(){
        return view('backend.category.categories-trashed',[
            'catView' => Category::onlyTrashed()->paginate(),
            'catViewCount'=>Category::onlyTrashed()->count(),
        ]);
    }
    function restoreCategory($id){
        Category::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Category Successfully Restored');
    }
    function permanentCategory($id){
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success','Your Category Permanently Deleted!');
    }
    function permanentDeleteCategorySequrity(Request $request){
        if(Auth::check()){
            if(Hash::check($request->password,Auth::user()->password)){
               Category::onlyTrashed()->findOrFail($request->cat_id)->forceDelete();
               session()->put('pDeleteSecurity','true');
               return back()->with('success','Your Category Permanently Deleted');
             }
             else{
                return back()->with('fail','Password do not match, try again');
             }
        }
    }
    function deleteAll(Request $request){
        if(isset($request->delete)){

            foreach ($request->delete as $item) {
                Category::findOrFail($item)->delete();
            }
            return back()->with('success','Category Successfully Deleted');
        }else{
            return back()->with('fail','Please select at least 1 Category to delete.');
        }

    }
    function deleteAllTrash(Request $request){
        if(isset($request->delete)){
            foreach ($request->delete as $deleteTrash) {
                Category::onlyTrashed()->findOrFail($deleteTrash)->forceDelete();
            }
            return back()->with('success','Trash Permanently Deleted');
        }else{
            return back()->with('fail','Please select at least 1 Category to delete trash permanently.');
        }

    }
}
