<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Models\ShortCut;


trait ShortCutsHelper{



  public function templateSearch(Request $request)
  {   
  	  if(!$request->input('query'))
      {
         return view('template',['templates'=>[],'word'=>'']);
      }
      $request->validate(['query'=>'string|min:3']);

      $keyword =$request->input('query');

      return view('template',['templates'=>ShortCut::where('title','LIKE',"%{$keyword}%")->paginate(10),'word'=>$keyword]);
  }

}