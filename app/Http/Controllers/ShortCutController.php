<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ShortCutDataTable;
use App\Models\ShortCut;
use App\Http\Helpers\ShortCutsHelper;
class ShortCutController extends Controller
{

    use ShortCutsHelper;

    public function __construct()
    {
        $this->middleware('auth')->except('templateSearch');
        $this->authorizeResource(ShortCut::class,'shortcut');
         //  dd($this->getMiddleware());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShortCutDataTable $table)
    {
        return $table->render('admin.shortcut.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shortcut.create');
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
        ShortCut::create(['title'=>$request->title,'description'=>$request->description,'properties'=>$request->properties,'user_id'=>auth()->user()->id]);
        return redirect()->route('shortcut.index')->with('msg','shortcut created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShortCut $shortcut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortCut $shortcut)
    {   
        //return dd($shortCut);
        return view('admin.shortcut.edit',['shortcut'=>$shortcut]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ShortCut $shortcut)
    {  
       // dd($request->all());
        $shortcut->update(['title'=>$request->title,'description'=>$request->description,'properties'=>$request->properties]);
        return redirect()->route('shortcut.index')->with('msg','shortcut updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortCut $shortcut)
    {
        $name     = $shortcut->name;
        $shortcut->delete();

        return redirect()->route('shortcut.index')->with('del', $name);
    }


    public function validateReq($req,$update=null,$update_id=null)
    {  
      //  return dd($update_id);

        if($update)
        {

          return $this->validate($req,[
                'title'=>"required|string|min:3|unique:short_cuts,title,$update_id",
                'properties.*'=>"required|string|max:255|min:3",
                'properties'=>"required|string|min:3",
                'description'=>"required|string|max:255|min:3"
            ]);
        }   

         return $this->validate($req,[
                'title'=>"required|string|min:3|unique:short_cuts,title",
                'properties'=>"required|array",
                'properties.*'=>"required|string",
                'description'=>"required|string|min:3"
            ]);
    }
}
