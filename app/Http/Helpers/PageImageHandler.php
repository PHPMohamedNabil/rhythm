<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;


trait PageImageHandler{

     
     public function uploadPostImage(Request $request)
     {  
           $pathes = [];

        foreach($request->file('files') as $file)
        {   
            $pathes[]= asset($file->store('page_img'));

        }
     	return response()->json($pathes);
     }

     public function saveUploadedImage($img)
     {

     }

}