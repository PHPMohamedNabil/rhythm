<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\DataTables\QuestionsDataTable;
use App\Http\Helpers\QuestionsHelper;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class QuestionController extends Controller
{  
    use QuestionsHelper;

    public function __construct()
    {    
         $this->middleware('auth')->except('questionSearch','questionViewOne');
         $this->authorizeResource(Question::class,'question');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionsDataTable $table)
    {    
        return $table->render('admin.question.index');
       // return view('admin.question.index',['questions'=>Question::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.create');
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
            $file= $request->file('attachment')->store('attachments');
            Question::create(['title'=>$request->title,
                              'answer_title'=>$request->answer_title,
                              'answer'=>$request->answer,
                              'attachment'=>$file,
                              'user_id'   =>auth()->user()->id

         ]);
        Image::make(public_path($file))->insert(public_path($file));

            return redirect()->route('question.index')->with('msg','Question Added Successfully');
         }
         else
         {
              Question::create($this->validateReq($request));
              return redirect()->route('question.index')->with('msg','Question Added Successfully');

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
    public function edit(Question $question)
    {
        return view('admin.question.edit',['question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question)
    {     
      $request_data =  $this->validateReq($request,true,$question);       
       
        // $Question = Question::find($id);
         
         if($request->hasFile('attachment'))
         {  
            $file= $request->file('attachment')->store('attachments');
             
             //delete old image 
            Storage::delete($question->attachment);
              ///break
                 sleep(0.5);
              ///end break

            $question->update(['title'=>$request->title,
                              'answer_title'=>$request->answer_title,
                              'answer'=>$request->answer,
                              'attachment'=>$file
            ]);
            
        
          //encode new image and save it
            Image::make(public_path($file))->insert(public_path($file));
           

            return redirect()->route('question.edit',$question->id)->with('msg','Question Added Successfully');
         }
         else
         {
              $question->update($request_data);
              return redirect()->route('question.index')->with('msg','Question Added Successfully');

         }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
       
        $name = $question->name;
        $question->delete();

        return redirect()->route('question.index')->with('del', $name);
    }


    public function validateReq($req,$update=null,$update_id=null)
    {  
      //  return dd($update_id);

        if($update)
        {

          return $this->validate($req,[
                'title'=>"required|string|max:255|min:3|unique:questions,title,$update_id->id",
                'answer_title'=>"required|string|max:255|min:3",
                'answer'=>"required|string|min:3",
                'attachment'=>"mimes:jpg,jpeg,png,mp4|max:3080"
            ]);
        }

          return $this->validate($req,['title'=>"required|string|max:255|min:3|unique:questions,title",
                'answer_title'=>"required|string|max:255|min:3",
                'answer'=>"required|string|min:3",
                'attachment'=>"mimes:jpg,jpeg,png,mp4|max:3080"
            ]);
    }
}
