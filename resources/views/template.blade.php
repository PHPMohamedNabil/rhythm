@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row">
         <div class="col-md-12">
             <section class="content-header">
              <div class="container-fluid">
        <h2 class="text-center display-4">templates</h2>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form  action="{{route('template_search')}}">
                        <div class="input-group input-group-lg">
                            <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here" value="{{$word}}" name="query">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
             @if(isset($templates) && count($templates)>0)

              @foreach($templates as $template)
                <div class="col-md-10 offset-md-1">
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
