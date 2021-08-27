<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(auth()->user()->can(''))
        if(auth()->user()->can('role management')){
            return view('backend.role.index',[
                'roles'=>Role::all(),
            ]);
        }else{
            return abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $permission = Permission::create(['name'=>'role management']);
        // return 'added';
        if(auth()->user()->can('role management')){
            return view('backend.role.create',[
                'permissions'=> Permission::orderBy('name','asc')->get(),
            ]);
        }else{
            return abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $role=Role::create(['name'=>$request->role_name]);
        $role->givePermissionTo($request->permission);
        return redirect()->route('role.index')->with('success','New Role Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->can('role management')){
            return view('backend.role.edit',[
                'roles' => Role::findOrFail($id),
                'permissions' => Permission::orderBy('name','asc')->get(),
            ]);
        }else{
            return abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function assignUser(){
        if(auth()->user()->can('role management')){
            return view('backend.role.assign_user',[
                'users' =>User::orderBy('name','asc')->get(),
                'roles' =>Role::orderBy('name','asc')->get(),
            ]);
        }else{
            return abort('404');
        }
    }
    public function assignUserStore(Request $request){
        // return $request;
        $user = User::find($request->user);
        // $user->assignRole($request->role);
        $user->assignRole($request->role);
        return back();
    }
}
