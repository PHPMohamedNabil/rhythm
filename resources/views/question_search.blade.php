@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row">
         <div class="col-md-12">
             <section class="content-header">
              <div class="container-fluid">
        <h2 class="text-center display-4">Questions</h2>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form  action="{{route('question_search')}}">
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
             @if(isset($questions) && count($questions)>0)

              @foreach($questions as $question)
                <div class="col-md-10 offset-md-1">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col px-4">
                                    <div>
                                        <div class="float-right">{{date('Y-m-d',strtotime($question->created_at))}}</div>
                                        <h4><a href="{{route('question_view',[$question->id])}}">{{$question->title}}</a></h4>
                                        <p class="mb-0">
                                            {{$question->answer_title}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach

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

@endsection
