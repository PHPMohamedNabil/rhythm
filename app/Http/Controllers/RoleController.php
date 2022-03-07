<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{


    public function __construct()
    {     
        $this->middleware('auth');
        $this->authorizeResource(Role::class,'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.role.index',['roles'=>Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateReq($request);
         
         Role::create($request->all());

        return redirect()->route('role.index')->with('msg','Role Created Successfully');
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
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Role $role)
    {
         $this->validateReq($request,true,$role);

          $role->update([
                'name'=>$request->name,
                'description'      =>$request->description,
             ]);

        return redirect()->route('role.index')->with('msg','Role updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $name = $role->name;
        $role->delete();

        return redirect()->route('role.index')->with('del', $name);
    }

    public function validateReq($request,$update=false,$id=null)
    {
       if($update)
       {
         return  $this->validate($request,[
                    'name'=>"min:3|max:50|required|string|unique:roles,name,$id->id",
                    'description'=>'required|string|max:255',
             ]);
       }
        return  $this->validate($request,[
                    'name'=>'min:3|max:50|required|string|unique:roles,name',
                    'description'=>'required|string|max:255',
             ]);
    }
}
