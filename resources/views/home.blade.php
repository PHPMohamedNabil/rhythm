@extends('layouts.app')

@section('search_div')
 <div class="container" style="padding-top: 20px; padding-bottom: 20px;">
            <div class="row  margin-bottom-20">
               <div class="col-md-12 justify-content-center align-itmes-cetner">
                     <h1 class="white d-block">Fakrny Knowledge Base</h1>
                        <span class="nested"> Well Documented and easy to use </span>
                  
               </div>
            </div>
            <br>
        
             <div class="row justify-content-center">
             <div class="col-md-8 ">
               <form method="get" class="" action="{{route('p_search')}}">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" placeholder="What do you need help with?" autocomplete="off" id="search_query" name="page_name">
                          <button class="buttonsearch btn btn-info btn-lg ml-3" type="submit" style="margin-top: 0px;">Search</button>
                        </div>
                    </form>

             </div>
            </div>
           

        </div>

@endsection

@section('content')
<div class="col-md-8 padding-20">
 <div class="container">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-title"></div>
                 <div class="card-body">
                    <h5><i class="fas fa-list"></i> <span style="border-bottom-style:solid;border-bottom-color:#323a56;">C</span>ategories</h5>
                     <div class="row">
                        @foreach($categories as $category)
                         <div class="col-md-4 col-xs-12 col-sm-4 mt-2">
                           <div class="card cat-hover justify-content-center align-itmes-cetner text-center" style="padding:35px;font-size: 20px;">
                               <span class="icon-menu font-weight-bold"><a href="{{route('categories_view',$category->id)}}" class="icon-menu">{{$category->name}}</a></span>
                           </div>
                            
                         </div>
                        @endforeach

                     </div>

                 </div>
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-md-12">
              <div class="card">
                 <div class="card-title"></div>
                 <div class="card-body">
                    <h5><i class="fas fa-grip-horizontal icon-menu"></i> <span style="border-bottom-style:solid;border-bottom-color:#323a56;">T</span>emplates</h5>
                    @foreach($templates as $template)
                        <button class="btn btn-outline-primary mt-2 mr-2 mb-2"  onclick="return copy('{{json_encode($template->properties)}}','{{$template->title}}');">{{$template->title}}</button>
                    @endforeach

                 </div>
             </div>
         </div>
        @section('temp_q')
    <div class="row margin-top-20">
                    <div class="col-md-12">
                        <div class="fb-heading-small">
                            Search for Template/Question
                        </div>
                        <hr class="style-three">
                        <div class="fat-content-tags padding-left-10">
              <div class="col-md-12">
          <div class="card">
              <div class="card-body">
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Questions</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Templates</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<form class="mt-4" action="{{route('question_search')}}" method="get">
  <div class="form-group mx-sm-3 mb-2">
    <div class="row">
        <div class="col-md-8">
            <label for="inputPassword2" class="sr-only">Questions</label>
    <input type="search" name="query" class="form-control col-md-12 typeahead" id="inputPassword2" placeholder="Search for a Question ..."> 
        </div>
        <div class="col-md-4">
            <button type="submit" class="button-rh mb-2">Search </button>
        </div>
    </div> 
  </div>

</form>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<form class="mt-4" action="{{route('template_search')}}" method="get">
  <div class="form-group mx-sm-3 mb-2">
    <div class="row">
        <div class="col-md-8">
            <label for="inputPassword2" class="sr-only">Templates</label>
    <input type="search" name="query" class="form-control col-md-12" id="inputPassword2" placeholder="Search for a Templates ..."> 
        </div>
        <div class="col-md-4">
            <button type="submit" class="button-rh mb-2">Search </button>
        </div>
    </div> 
  </div>

</form>
  </div>
</div>
              </div>
          </div>

         </div>
         </div>
                    </div>
                </div>
        @endsection

        @section('questions')
    <div class="row margin-top-20">
        <div class="col-md-12">
             <hr class="style-three">
                        <div class="fat-content-small padding-left-10">
                        <div class="fb-heading-small">
                            LATEST Questions
                        </div>
          <ul>
         @foreach($questions as $question)
                <li>
                 <a href="{{asset('/questions/search?query=')}}{{$question->title}}">
                       <i class="fas fa-question-circle"></i> {{$question->title}}</a>
                </li>
         @endforeach
         
           
        </ul>
          </div>
        </div>
    </div>
                
       @endsection

       @section('articles')
        <div class="row margin-top-20">
                    <div class="col-md-12">
                        <div class="fb-heading-small">
                            Latest Articles
                        </div>
                        <hr class="style-three">
           <div class="fat-content-small padding-left-10">
            <ul>
             @foreach($pages as $page)
                <li>
                    <a href="{{route('pageView',$page->slug)}}">
                        <i class="fas fa-file-alt"></i> {{$page->title}}</a>
                </li>
             @endforeach          
            </ul>
           </div>
         </div>
      </div>
              
       @endsection 
     </div>

        <div class="row">
            <div class="col-lg-12 mx-auto">
                
                <!-- Timeline -->
                <ul class="timeline">
                 @foreach($walls as $wall)
                    <li style="overflow-x:auto;word-wrap: break-word;" class="timeline-item bg-white rounded ml-3 p-4 shadow">
                        <div class="timeline-arrow"></div>
                         @if($wall->is_important ==1)
     
                         <span class="badge badge-pill badge-warning">Important</span>
       
                    @else
                         <span class="badge badge-pill badge-info">Not</span>
                    @endif
                        <h2 class="h5 mb-0">{{$wall->title}}</h2><span class="small text-gray"><i class="fa fa-clock-o mr-1"></i>{{date('Y-m-d h:i',strtotime($wall->updated_at))}}</span>
                        <p class="text-small mt-2 font-weight-light">{{$wall->description}}</p>
                        @if($wall->attachment)
                             <div class="text-center">
                                 <img src="{{asset($wall->attachment)}}" style="width:50%; height:50%;"/>
                             </div>
                        @endif
                    </li>
                 @endforeach
             </ul>
                 <div class="text-center">
                     <a href="{{route('walls_all')}}" class="btn btn-outline-primary">Walls</a>
                 </div>
             </div>
         </div>
 </div>
</div>
@endsection

@section('js')
 <script type="text/javascript">
     function copy(text,title)
     {    
         let template =JSON.parse(text);
         
         var output = '';
         for (var i = 0; i < template.length; i++) {
                output+=template[i]+'\n';
         }
         copyToClipboard(output);
           Swal.fire(
               'Good job!',
               `" ${title} " Template copied Successfully`,
               'success'
             )

         console.log(output);
     }

     function copyToClipboard(text) {
         const elem = document.createElement('textarea');
         elem.value = text;
         document.body.appendChild(elem);
         elem.select();
         document.execCommand('copy');
         document.body.removeChild(elem);
}

 </script>
@endsection
