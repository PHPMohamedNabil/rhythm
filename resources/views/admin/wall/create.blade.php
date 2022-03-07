@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Walls'=>route('wall.index'),'Create new wall.end'=>''])!!}
@endsection
@section('content')

  <div class="card">
     <div class="card-header">
        Create New Wall
     </div>
     <div class="card-body">
       <form action="{{route('wall.store')}}" method="post" enctype="multipart/form-data">
          @csrf
           <div class="form-group">
            
               <label>Title</label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"/>
                @error('title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>description</label>
               <textarea class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                 @error('description')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
             <cite>Attachments (jpg,jpeg,png) max size 3mb</cite>
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
            <label>Is Important Thing *(must read or not)</label>
              <select class="form-control" name="is_important">
                 <option value="0">No</option>
                 <option value="1">Yes</option>
              </select>
           </div>
           <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Submit</button>
           </div>
       </form>
     </div>
  </div>

@endsection