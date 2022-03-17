<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\WallDataTable;
use App\Models\Wall;
use App\Http\Helpers\WallHelper;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


class WallController extends Controller
{   
    use WallHelper;

    public function __construct()
    {
          $this->authorizeResource(Wall::class,'wall');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WallDataTable $table)
    {
        return $table->render('admin.wall.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wall.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             //return dd($request->all());
         if($request->hasFile('attachment'))
         {
            $this->validateReq($request);
            $file= $request->file('attachment')->store('attachments\wall');
            Wall::create(['title'=>$request->title,
                              'description'=>$request->description,
                              'is_important'=>$request->is_important,
                              'attachment'=>$file,
                              'user_id'=>auth()->user()->id
         ]);
             Image::make(public_path($file))->insert(public_path($file));
             sleep(0.3);
            return redirect()->route('wall.index')->with('msg','Wall Post Added Successfully');
         }
         else
         {    
              $this->validateReq($request); 
              Wall::create(['title'=>$request->title,
                              'description'=>$request->description,
                              'is_important'=>$request->is_important,
                              'user_id'=>auth()->user()->id,
                              'attachment'=>''
         ]);
              return redirect()->route('wall.index')->with('msg','Wall Post Added Successfully');

         }
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
    public function edit(Wall $wall)
    {
        return view('admin.wall.edit',['wall'=>$wall]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Wall $wall)
    {
        $request_data =  $this->validateReq($request,true,$wall);       
       
         //$Wall = Wall::find($id);
         
         if($request->hasFile('attachment'))
         {  
            $file= $request->file('attachment')->store('attachments');
            
            Storage::delete($wall->attachment);
          
            $wall->update(['title'=>$request->title,
                              'answer_title'=>$request->answer_title,
                              'answer'=>$request->answer,
                              'attachment'=>$file
            ]);
             Image::make(public_path($file))->insert(public_path($file));
             sleep(0.3);
            return redirect()->route('wall.edit',$wall->id)->with('msg','Wall Updated Successfully');
         }
         else
         {
              $wall->update($request_data);
              return redirect()->route('wall.index')->with('msg','Wall Updated Successfully');

         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Wall $wall)
    {
        
        $name = $wall->name;
        $wall->delete();
        if($request->wall_main)
        {
            return redirect()->route('walls_all')->with('del', $name);
        }
        return redirect()->route('wall.index')->with('del', $name);
    }


    public function validateReq($req,$update=null,$update_id=null)
    {  
      //  return dd($update_id);

        if($update)
        {

          return $this->validate($req,[
                'title'=>"required|string|max:255|min:3|unique:walls,title,$update_id->id",
                'description'=>"required|string|max:255|min:3",
                'is_important'=>"required|integer|min:0|max:1",
                'attachment'=>"mimes:jpg,jpeg,png|max:3080"
            ]);
        }

          return $this->validate($req,['title'=>"required|string|max:255|min:3|unique:walls,title",
                'description'=>"required|string|min:3",
                'is_important'=>"required|integer|min:0|max:1",
                'attachment'=>"mimes:jpg,jpeg,png|max:3080"
            ]);
    }
}
