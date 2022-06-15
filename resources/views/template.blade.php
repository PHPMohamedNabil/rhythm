@extends('layouts.app')

@section('search_non_main')
<div class="row">
    <div class="col-md-12" style="margin-left:86px;">
             <form method="get" class="" action="{{route('p_search')}}">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search for Page?" autocomplete="off" id="search_query" name="page_name">
                          <button class=" btn btn-info btn-sm ml-3" type="submit" style="margin-top: 0px;">Search</button>
                        </div>
                    </form>

             </div>
</div>
@endsection
@section('search_div')
 <div class="container" style="padding-top: 20px; padding-bottom: 20px;">
            <div class="row  margin-bottom-20">
               <div class="col-md-12 justify-content-center align-itmes-cetner">
                     <h1 class="white d-block">Templates</h1>
                     <p>
                         Search for Templates
                     </p>
                  
               </div>
            </div>
            <br>
            <div class="row justify-content-center">
             <div class="col-md-6">
 <form  action="{{route('template_search')}}">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here" value="{{$word}}" name="query">
                           
                        </div>
 </form>

             </div>
            </div>
           

        </div>

@endsection
@section('content')
<div class="col-md-12 padding-20">
<div class="container">
     <div class="row">
         <div class="col-md-12">
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-3">
             @if(isset($templates) && count($templates)>0)

              @foreach($templates as $template)
                <div class="col-md-12 offset-md-1">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col px-4">
                                    <div class="text-left">
                                        <h4>{{$template->title}}</h4>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-outline-success mr-2" onclick="return copy('{{json_encode($template->properties)}}','{{$template->title}}');"><i class="far fa-copy icon-color"></i> Copy</button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$template->id}}">Description</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>


  <div class="modal fade" id="Modal{{$template->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$template->title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
       
       <div class="text-center col-md-12">
           <textarea class="display-5 form-control" style="" rows="10">{{wordwrap($template->description)}}</textarea>
       </div>
           
           <div class="form-group">
               <button class="btn btn-primary mt-2" class="close" data-dismiss="modal" aria-label="Close">Close</button>
           </div>
      
      </div>
    </div>
  </div>
</div>
                @endforeach

             @elseif($word == '')
              <p class="text-center display-5" style="display:block;margin:50px auto;font-size:22px;"><i class="fas fa-search"></i> Search for Templates ...</p>
             @else
              <p class="text-center display-5" style="display:block;margin:50px auto;font-size:22px;"><i class="far fa-folder-open"></i> No search Results Founds</p>
             @endif
            </div>
            </div>
        </div>
        <div class="row">
            @if(isset($templates) && count($templates)>0)
               {{$templates->links()}}
            @endif
        </div>
    </section>
     
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
