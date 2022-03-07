<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;

trait QuestionsHelper{



  public function questionSearch(Request $request)
  {   
  	  if(!$request->input('query'))
  	  {
         return view('question_search',['questions'=>[],'word'=>'']);
  	  }
  	  $request->validate(['query'=>'string|min:3']);
       
     
      return view('question_search',['questions'=>Question::where('title','LIKE',"%{$request->input('query')}%")->paginate(10),'word'=>$request->input('query')]);
  }

  public function questionViewOne($id)
  {    
  	//dd(Question::where('id',$id)->where('title',$qtitle)->get());
    $question =Question::where('id',$id)->get();

      if(count($question)<= 0)
      {
           return abort(404);
      }
      return view('question_view',['question'=>$question]);
  }

  public function questionDeleteAtt(Request $request)
  {  

     $question = Question::findOrFail($request->id);

      if ($request->user()->cannot('update', $question)) {
            return response('can not perform this action',403);
        }

      if(Storage::delete($question->attachment) )
      { 
         $question->attachment = '';
         $question->save();
        
        return response()->json(['data'=>'done']);
      }
      return response()->json(['data'=>'not']);

  }

}