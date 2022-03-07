@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Pages'=>route('page.index'),$page->slug.'.end'=>''])!!}
@endsection
@section('content')
<form action="{{route('page.update',$page->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
  <div class="row">
       <div class="col-md-7">
    <div class="card card-default ">
     <div class="card-header">
         Page Title
     </div>
     <div class="card-body">
      <div class="form-group">
            
               <label>Page Title</label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')?old('title'):$page->title}}" />
                @error('title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
      </div>
      <div class="form-group">
               <label>short Description</label>
                <input type="text" name="short_description" class="form-control @error('answer_title') is-invalid @enderror" value="{{old('short_description')?old('short_description'):$page->short_description}}"/>
                @error('short_description')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>Description</label>
               <textarea class="form-control @error('answer') is-invalid @enderror" name="long_description"> {{old('short_description')?old('short_description'):$page->short_description}}</textarea>
                 @error('long_description')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>

     </div>
  </div>
  </div>
  <div class="col-md-5">
    <div class="card card-default ">
     <div class="card-header">
        Settings
     </div>
     <div class="card-body">
           <div class="form-group">
              <button class="btn btn-primary btn-block" type="submit">save</button>
           </div>
         @can('publish',$page)
          <div class="form-group">
            <label for="publish">Publish:</label>
             <input type="checkbox" name="published" class="" id="publish"  {{strtolower(old('published')) ==1 ?'checked':''}}{{$page->published ==1 ?'checked':''}}/>
           </div>
         @endcan
        <div class="form-group">
                <label for="category">Category:</label>
               <select name="category_id" class="form-control select2" id="category">
                    @foreach($categories as $category)
                    
                         @if($category->id == $page->category_id)
                                        <option value="{{$category->id}}" selected="">{{$category->name}}</option>
                                    @else
                                     <option value="{{$category->id}}" style="font-weight: bold;">{{$category->name}}</option>
                                        
                        @endif
                        
                      @foreach($category->childrenCategories as $childCategory) 
                         
                               @include('admin.pages.category_page_edit',['child_category'=>$childCategory,'pref'=>'/','edit'=>false])
                      @endforeach
                  
                        
                        
                    @endforeach
               </select> 
           </div>
           @if($page->refer_to !== null && $is_history_exists >=1)
            <div class="form-group">
               <a href="{{route('history_page_edit',$page->id)}}">Show Update History</a>
           </div>
           @endif
           <span style="font-weight:bold;">Author: </span>{{$page->user->username ?? ''}}
           <br>
           <span style="font-weight:bold;">Last Edit By: </span>{{$page->editor->username ?? ''}}
           <br>
           <span style="font-weight:bold;">Published By: </span>{{$page->publisher->username ?? ''}}

     </div>
  </div>
  </div>

  </div>
  <div class="row">
     <div class="col-md-12">
       <div class="card card-default ">
     <div class="card-header">
        Content
     </div>
     <div class="card-body">
               <label>Page Content</label>
               <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="220">{{old('content')?old('content'):$page->content}}</textarea>
                 @error('content')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
    </div>
  </div>
     </div>
  </div>
</form>
@endsection

@section('js')
  
  <script type="text/javascript">

     $('#content').summernote({
      height: $(document).height()*(50/100),
      callbacks: {
    onImageUpload: function(files) {
      // upload image to server and create imgNode...
    //  let uploadImages = uploadImage(files);
     // $summernote.summernote('insertNode', uploadImages);
             
   let imageFiles = new FormData();

    
   let fullData=[];


   Object.entries(files).forEach(
            
                      ([key, file]) =>  
                      {
                       // console.log(key,file);
                        imageFiles.append(`files[${key}]`,file);
                      }
                    )

     const config = {headers: {"Content-Type":"multipart/form-data"}};
  
       axios.post("{{route('upload_page_photo')}}",imageFiles,config).then((response)=>{
                     Object.entries(response.data).forEach(([key,img])=>{
                      $('#content').summernote('insertImage',img);
                  });
       }).catch((error)=>{console.log(error)});

     
             
         
            
             
             

    }
  },
  toolbar: [
  ['style', ['style']],
  ['font', ['bold', 'underline', 'clear']],
  ['fontsize', ['fontsize','fontsizeunit']],
  ['fontname', ['fontname']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['insert', ['link', 'picture', 'video']],
  ['view', ['fullscreen', 'codeview', 'help']],
],

     });
      $('.select2').select2();

      // onImageUpload callback




  </script>

@endsection