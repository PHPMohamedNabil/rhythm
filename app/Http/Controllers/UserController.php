<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   

    public function __construct()
    {
      $this->authorizeResource(User::class,'user');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $datatable)
    {
       return $datatable->render('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.user.create',['roles'=>Role::all()]);
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
               'name'=>'string|max:26|min:3|required',
               'username'=>'string|max:60|min:3|regex:/^\S*$/u|required|unique:users,username',
               'email'   =>'email|required|unique:users,email',
               'password' => ['required', 'string', 'min:8', 'confirmed'],
               'role_id'  =>'required|integer|exists:roles,id',

           ]);
         $request['password'] = Hash::make($request['password']);
         User::create($request->all());
        return redirect()->route('user.index')->with('msg','user created');
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
    public function edit(User $user)
    {
        return view('admin.user.edit',['user'=>$user::with('role')->where('id',$user->id)->get(),'roles'=>Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        if($request->password)
        {        
            $request->validate([
               'name'=>'string|max:26|min:3|required',
               'username'=>"string|max:60|min:3|regex:/^\S*$/u|required|unique:users,username,$user->id",
               'email'   =>"email|required|unique:users,email,$user->id",
               'password' => ['string', 'min:8', 'confirmed'],
               'role_id'  =>'required|integer|exists:roles,id',

           ]);
             $request['password'] = Hash::make($request['password']);

         if( (auth()->user()->role->name =='Admin') && ($request->role_id != Role::where('name','Admin')->get()[0]->id) && ($user->id == auth()->user()->id) )
         {
              return abort(403);
         }

         $user->update($request->all());
          return redirect()->route('user.edit',$user->id)->with('msg','User Data Updated');
        }
        
            $request->validate([
               'name'=>'string|max:26|min:3|required',
               'username'=>"string|max:60|min:3|regex:/^\S*$/u|required|unique:users,username,$user->id",
               'email'   =>"email|required|unique:users,email,$user->id",
               'role_id'  =>'required|integer|exists:roles,id',

           ]);
            unset($request['password']);
          
          //return dd($request->role_id != Role::where('name','Admin')->get()[0]->id);
             if( (auth()->user()->role->name =='Admin') && ($request->role_id != Role::where('name','Admin')->get()[0]->id) && ($user->id == auth()->user()->id) )
         {
              return abort(403);
         }

         $user->update($request->all());
         return redirect()->route('user.edit',$user->id)->with('msg','User Data Updated');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    { 
      //  return dd(123);
        $name       = $user->username;
        $user->delete();

        return redirect()->route('user.index')->with('del', $name);
    }
}
