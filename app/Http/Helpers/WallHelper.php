<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Models\Wall;
use Illuminate\Support\Facades\Storage;


trait WallHelper{

     
     public function uploadPostImage(Request $request)
     {  
           $pathes = [];

        foreach($request->file('files') as $file)
        {   
            $pathes[]= asset($file->store('Wall_img'));

        }
     	return response()->json($pathes);
     }

     public function saveUploadedImage($img)
     {

     }

     public function getAllWalls()
     {
         $walls = Wall::orderBy('is_important','DESC')->orderBy('updated_at','DESC')->paginate(14);
           
           //return dd($walls);
         return view('wall_main',compact('walls'));
     }


  public function wallDeleteAtt(Request $request,Wall $wall)
  {   
    if ($request->user()->cannot('update', $wall)) {
          return  abort(403);
        }

     $Wall = Wall::findOrFail($request->id);

      if(Storage::delete($Wall->attachment) )
      { 
         $Wall->attachment = null;
         $Wall->save();
        
        return response()->json(['data'=>'done']);
      }
      return response()->json(['data'=>'not']);

  }

}