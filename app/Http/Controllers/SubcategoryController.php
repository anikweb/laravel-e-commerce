<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubcategoryController extends Controller

{
    function viewSubcategories(){
        if(auth()->user()->can('view subcategory')){
            return view('backend.subcategory.subcategories-view',[
                'subCatView'=> Subcategory::with('category')->latest()->paginate(10),
                'subCatCount'=>Subcategory::all()->count(),
            ]);
        }else{
            return abort('404');
        }
    }

    function addSubcategory(){
        if(auth()->user()->can('add subcategory')){
            return view('backend.subcategory.subcategory-form',[
                "catView" => Category::orderBy('category_name','asc')->get(),
            ]);
        }else{
            return abort('404');
        }
    }

    function postSubcategory(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:subcategories|min:2',
            'subcategory_slug' => 'required|unique:subcategories',
            'parent_category'=> 'required',
        ]);
        $subcat = new Subcategory;
        $subcat->subcategory_name = $request->subcategory_name;
        $subcat->subcategory_slug = $request->subcategory_slug;
        $subcat->foreign_key = $request->parent_category;
        $subcat->save();
        return redirect('/subcategories')->with('success','Subcategory Successfully Added');
    }

    function editSubcategory($data){
        if(auth()->user()->can('edit subcategory')){
            return view('backend.subcategory.subcategory-edit-form',[
                'subcatView'=> Subcategory::findOrFail($data),
            ]);
        }else{
            return abort('404');
        }
    }

    function updateSubcategory(Request $request){
        $request->validate([
            'subcategory_name'=>'required|min:2|unique:subcategories',
            'subcategory_slug'=>'required|unique:subcategories',
        ]);
        $subcat = Subcategory::findOrFail($request->subcategory_id);
        $subcat->subcategory_name = $request->subcategory_name;
        $subcat->subcategory_slug = $request->subcategory_slug;
        $subcat->save();
        return redirect('/subcategories')->with('success','Subcategories Updated');
    }
    function deleteSubcategory($data){
        // return $data;
        if(auth()->user()->can('delete subcategory')){
            $scat = Subcategory::findOrFail($data);
            if($scat->product->count() <1 ){
                Subcategory::findOrFail($data)->delete();
                return back()->with('success','Subcategory Deleted');
            }else{
                return back()->with('fail','failed. delete product which is created by this subcategory before delete this subcategory');
            }
        }else{
            return abort('404');
        }

    }
    function trashedSubcategory(){
        if(auth()->user()->can('view trash subcategory')){
            return view('backend.subcategory.subcategories-trashed',[
                'subcatTrash'=> Subcategory::onlyTrashed()->latest()->paginate(10),
                'subcatTrashCount' =>Subcategory::onlyTrashed()->count(),
            ]);
        }else{
            return abort('404');
        }
    }
    function restoreSubcategory($data){
        if(auth()->user()->can('restore trash subcategory')){
            Subcategory::onlyTrashed()->findOrFail($data)->restore();
            return back()->with('success','Your Subcategory Restored');
        }else{
            return abort('404');
        }
    }
    function permanentDeleteSubcategory(Request $request){
        if(auth()->user()->can('permanent delete trash subcategory')){
            if(Auth::check()){
                if(Hash::check($request->password,Auth::user()->password)){
                    Subcategory::onlyTrashed()->findOrFail($request->subcat_id)->forceDelete();
                    session()->put('pDeleteSecurity','true');
                    return back()->with('success','Trash Permanently Deleted');
                }else{
                    return back()->with('fail','Password Do not match');
                }
            }
        }else{
            return abort('404');
        }
    }
    function pdeleteSubcatWithoutSecu($data){
        if(auth()->user()->can('permanent delete trash subcategory')){
            Subcategory::onlyTrashed()->findOrFail($data)->forceDelete();
            return back()->with('success','Your Subcategory Permanently Deleted');
        }else{
            return abort('404');
        }
    }
    function deleteAllSubcategories(Request $request){
        if(auth()->user()->can('delete subcategory')){
            if(isset($request->delete)){
                foreach ($request->delete as $delete) {
                    Subcategory::findOrFail($delete)->delete();
                }
                return back()->with('success','Subcategory Deleted');
            }else{
                return back()->with('fail','Please select at least 1 Subcategory to delete.');
            }
        }else{
            return abort('404');
        }

    }
    function deleteAllTrashSubcategories(Request $request){
        if(auth()->user()->can('permanent delete trash subcategory')){
            if(isset($request->delete)){
                foreach ($request->delete as $delete) {
                    Subcategory::onlyTrashed()->findOrFail($delete)->forceDelete();
                }
                return back()->with('success','Subcategory Trash Permanently Deleted');
            }else{
                return back()->with('fail','Please select at least 1 Subcategory to delete trash permanently.');
            }
        }else{
            return abort('404');
        }

    }
}
