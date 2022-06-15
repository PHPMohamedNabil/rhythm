@extends('layouts.app')
@section('search_non_main')
<div class="row">
    <div class="col-md-12 search-div" >
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
                     <h1 class="white d-block">Questions</h1>
                        <span class="nested"> Search for Questions & FAQs </span>
                  
               </div>
            </div>
            <br>
            <div class="row justify-content-center">
             <div class="col-md-6 ">
               <form  action="{{route('question_search')}}">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here" value="{{$word}}" name="query">
                         
                        </div>
                    </form>

             </div>
            </div>
           

        </div>
@endsection
@section('content')
<style type="text/css">
    .link-hover:hover{
        text-decoration:underline;
    }
</style>
<div class="col-md-12 padding-20">
<div class="container">
  
            <div class="row mt-3">
             @if(isset($questions) && count($questions)>0)

<div class="col-md-12">
  
    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
      @foreach($questions as $question)
        <div class="card">
           <div class="card-header bg-light text-white" id="headingOne">
                 <button class="btn btn-link link-hover" data-toggle="collapse" data-target="#col{{$question->id}}" aria-expanded="true" aria-controls="collapseOne">
                 <h4 class="mb-0">
                    
                       {{$question->title}}
                    
                 
               </h4>
                </button>
           </div>
    <div id="col{{$question->id}}"class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            <div class="float-right">{{date('Y-m-d',strtotime($question->created_at))}}
            </div>
                <h4>{{$question->answer_title}}</h4>
                <p class="mb-0">
                  {{$question->answer}}
                </p>
                <p>
                    <i class="fas fa-paperclip icon-menu display-5"></i> <span style="font-size:14px;">Attachments:</span>
                    <br>
                      @php $file = explode('.',$question->attachment) @endphp
                    @if(end($file) == 'jpg' || end($file) == 'png' || end($file) == 'jpeg')
                          <img src="{{asset($question->attachment)}}" width="200"  height="200" />
                    @elseif(end($file) =='mp4')
                          <video src="{{asset($question->attachment)}}" width="200"  height="200" controls></video>
                    @endif
                </p>
        </div>
    </div>
</div>
@endforeach
</div>
</div>

</div>

             @elseif($word == '')
              <p class="text-center display-5" style="display:block;margin:50px auto;font-size:22px;"><i class="fas fa-search"></i> Search for Questions ...</p>
             @else
              <p class="text-center display-5" style="display:block;margin:50px auto;font-size:22px;"><i class="far fa-folder-open"></i> No search Results Founds</p>
             @endif
            </div>
            </div>
        </div>
        <div class="row">
            @if(isset($questions) && count($questions)>0)
               {{$questions->links()}}
            @endif
        </div>
    </section>
     
</div>
</div>
</div>
</div>

@endsection
