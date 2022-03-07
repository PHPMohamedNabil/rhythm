@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Pages'=>route('page.index'),'Create new question.end'=>''])!!}
@endsection
@section('content')
<form action="{{route('page.store')}}" method="post" enctype="multipart/form-data">
          @csrf
  <div class="row">
       <div class="col-md-7">
    <div class="card card-default ">
     <div class="card-header">
        New Page Title
     </div>
     <div class="card-body">
      <div class="form-group">
            
               <label>Page Title</label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"/>
                @error('title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
      </div>
      <div class="form-group">
               <label>short Description</label>
                <input type="text" name="short_description" class="form-control @error('answer_title') is-invalid @enderror"/>
                @error('short_description')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>Description</label>
               <textarea class="form-control @error('answer') is-invalid @enderror" name="long_description"></textarea>
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
              <button class="btn btn-primary btn-block" type="submit">Post</button>
           </div>
          <div class="form-group">
            <label for="publish">Publish:</label>
             <input type="checkbox" name="published" class="" id="publish"/>
           </div>
        <div class="form-group">
                <label for="category">Category:</label>
               <select name="category_id" class="form-control select2" id="category">
                    @foreach($categories as $category)
                    
                      <option value="{{$category->id}}" style="font-weight: bold;">{{$category->name}}</option>
                        
                      @foreach($category->childrenCategories as $childCategory) 
                         
                               @include('admin.category.childern_category',['child_category'=>$childCategory,'pref'=>'/','edit'=>false])
                      @endforeach
                  
                        
                        
                    @endforeach
               </select> 
                @error('category_id')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>

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
               <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="220"></textarea>
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
]

     });
      $('.select2').select2();

      // onImageUpload callback




  </script>

@endsection