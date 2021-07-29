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
        return view('backend.subcategory.subcategories-view',[
            'subCatView'=> Subcategory::with('category')->latest()->paginate(10),
        ],[
            'subCatCount'=>Subcategory::all()->count(),
        ]);
    }

    function addSubcategory(){
        return view('backend.subcategory.subcategory-form',[
            "catView" => Category::orderBy('category_name','asc')->get(),
        ]);
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
        return view('backend.subcategory.subcategory-edit-form',[
            'subcatView'=> Subcategory::findOrFail($data),
        ]);
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
        $scat = Subcategory::findOrFail($data);

        if($scat->product->count() <1 ){
            Subcategory::findOrFail($data)->delete();
            return back()->with('success','Subcategory Deleted');
        }else{
            return back()->with('fail','failed. delete product which is created by this subcategory before delete this subcategory');
        }

    }
    function trashedSubcategory(){

        return view('backend.subcategory.subcategories-trashed',[
            'subcatTrash'=> Subcategory::onlyTrashed()->latest()->paginate(10),
            'subcatTrashCount' =>Subcategory::onlyTrashed()->count(),
        ]);
    }
    function restoreSubcategory($data){
        Subcategory::onlyTrashed()->findOrFail($data)->restore();
        return back()->with('success','Your Subcategory Restored');
    }
    function permanentDeleteSubcategory(Request $request){
        if(Auth::check()){
            if(Hash::check($request->password,Auth::user()->password)){
                Subcategory::onlyTrashed()->findOrFail($request->subcat_id)->forceDelete();
                session()->put('pDeleteSecurity','true');
                return back()->with('success','Trash Permanently Deleted');
            }else{
                return back()->with('fail','Password Do not match');
            }
        }
    }
    function pdeleteSubcatWithoutSecu($data){
        Subcategory::onlyTrashed()->findOrFail($data)->forceDelete();
        return back()->with('success','Your Subcategory Permanently Deleted');
    }
    function deleteAllSubcategories(Request $request){
        if(isset($request->delete)){
            foreach ($request->delete as $delete) {
                Subcategory::findOrFail($delete)->delete();
            }
            return back()->with('success','Subcategory Deleted');
        }else{
            return back()->with('fail','Please select at least 1 Subcategory to delete.');
        }

    }
    function deleteAllTrashSubcategories(Request $request){
        if(isset($request->delete)){
            foreach ($request->delete as $delete) {
                Subcategory::onlyTrashed()->findOrFail($delete)->forceDelete();
            }
            return back()->with('success','Subcategory Trash Permanently Deleted');
        }else{
            return back()->with('fail','Please select at least 1 Subcategory to delete trash permanently.');
        }

    }
}
