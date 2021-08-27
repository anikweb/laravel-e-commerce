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
        if(auth()->user()->can('view category')){
            return view('backend.category.categories-view',[
                'catView' => Category::latest()->paginate(10),
                'catViewCount' => Category::all()->count(),
            ]);
        }else{
            return abort('404');
        }

    }

    function AddCategory(){
        if(auth()->user()->can('add category')){
            return view('backend.category.category-form');
        }else{
            return abort('404');
        }
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
        if(auth()->user()->can('delete category')){
            $cat = Category::findOrFail($datas);
            if($cat->subcategory->count() < 1){
                Category::findOrFail($datas)->delete();
                return back()->with('success','Successfully deleted category');
            }else{
                return back()->with('fail','failed. delete subcategories which is created by this category before delete this category');
            }
        }else{
            return abort('404');
        }

        // return $datas;
    }
    function editCategory($data){
        if(auth()->user()->can('edit category')){
            return view('backend.category.category-edit-form',[
                'catView'=> Category::findOrFail($data),
            ]);
        }else{
            return abort('404');
        }
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
        if(auth()->user()->can('view trash category')){
            return view('backend.category.categories-trashed',[
                'catView' => Category::onlyTrashed()->paginate(),
                'catViewCount'=>Category::onlyTrashed()->count(),
            ]);
        }else{
            return abort('404');
        }
    }
    function restoreCategory($id){
        if(auth()->user()->can('restore trash category')){
            Category::onlyTrashed()->findOrFail($id)->restore();
            return back()->with('success','Category Successfully Restored');
        }else{
            return abort('404');
        }
    }
    function permanentCategory($id){
        if(auth()->user()->can('permanent delete trash category')){
            Category::onlyTrashed()->findOrFail($id)->forceDelete();
            return back()->with('success','Your Category Permanently Deleted!');
        }else{
            return abort('404');
        }
    }
    function permanentDeleteCategorySequrity(Request $request){
        if(auth()->user()->can('permanent delete trash category')){
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
        }else{
            return abort('404');
        }
    }
    function deleteAll(Request $request){
        if(auth()->user()->can('delete category')){
            if(isset($request->delete)){
                foreach ($request->delete as $item) {
                    Category::findOrFail($item)->delete();
                }
                return back()->with('success','Category Successfully Deleted');
            }else{
                return back()->with('fail','Please select at least 1 Category to delete.');
            }
        }else{
            return abort('404');
        }

    }
    function deleteAllTrash(Request $request){
        if(auth()->user()->can('permanent delete trash category')){
            if(isset($request->delete)){
                foreach ($request->delete as $deleteTrash) {
                    Category::onlyTrashed()->findOrFail($deleteTrash)->forceDelete();
                }
                return back()->with('success','Trash Permanently Deleted');
            }else{
                return back()->with('fail','Please select at least 1 Category to delete trash permanently.');
            }
        }else{
            return abort('404');
        }

    }
}
