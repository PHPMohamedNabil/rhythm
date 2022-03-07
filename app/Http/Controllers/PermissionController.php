<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class PermissionController extends Controller
{   



    public function __construct()
    {
          $this->authorizeResource(Permission::class,'permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permission.index',['permissions'=>Permission::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create',['roles'=>Role::all()]);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
              'role_id'=>'required|unique:permissions',
              'permissions'=>'required',
         ]);
          Permission::create($request->all());
        return redirect()->route('permission.index')->with('msg','Permission Assigned Succesfully');
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
    public function edit(Permission $permission)
    {
        return view('admin.permission.edit',['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Permission $permission)
    {
        $request->validate([
              'role_id'=>"required|unique:permissions,role_id,$permission->id",
              'permissions'=>'required',
         ]);
          $permission->update($request->all());
        return redirect()->route('permission.edit',$permission->id)->with('msg','Permission Edited Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
         $permission->delete($permission);
         return   redirect()->route('permission.index')->with('msg','Permission Deleted');
    }
}
