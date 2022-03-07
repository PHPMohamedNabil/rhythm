@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Questions'=>route('question.index'),'Create new question.end'=>''])!!}
@endsection
@section('content')

  <div class="card">
     <div class="card-header">
        Create New Questions
     </div>
     <div class="card-body">
       <form action="{{route('question.store')}}" method="post" enctype="multipart/form-data">
          @csrf
           <div class="form-group">
            
               <label>Question Name</label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"/>
                @error('title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>Answer Title</label>
                <input type="text" name="answer_title" class="form-control @error('answer_title') is-invalid @enderror"/>
                @error('answer_title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>Answer</label>
               <textarea class="form-control @error('answer') is-invalid @enderror" name="answer"></textarea>
                 @error('answer')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
             <cite>Attachments (jpg,jpeg,png,mp4) max size 3mb</cite>
              <div class="custom-file">
                <input type="file"  class="custom-file-input  @error('attatchment') is-invalid @enderror" id="attat" name="attachment">
                <label class="custom-file-label" for="attat"><i class="fas fa-paperclip"></i> Attachments</label>
               </div>
                   @error('attatchment')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Submit</button>
           </div>
       </form>
     </div>
  </div>

@endsection