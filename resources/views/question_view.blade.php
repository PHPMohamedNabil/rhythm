@extends('layouts.app')
@section('search_non_main')
<div class="row">
    <div class="col-md-12 search-div" style="margin-left:86px;">
              <form method="get" class="" action="{{route('p_search')}}">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search for Page?" autocomplete="off" id="search_query" name="page_name">
                          <button class=" btn btn-info btn-sm ml-3" type="submit" style="margin-top: 0px;">Search</button>
                        </div>
                    </form>

             </div>
</div>
@endsection
@section('title','Quest:'.$question[0]->title)
@section('content')
 <div class="container">
     <div class="row">
         <div class="col-md-12">
             <section class="content-header">
              <div class="container-fluid" style="">
              	<span style="display:block;margin-left:-54%;font-size:10px;" class="text-center">Question</span>
              	<div style="margin-left:17%;">
              		<i class="fas fa-exclamation-circle" style="display:inline-block;font-size: 28px;text-align: center;"></i>
        <h1 class="text-center display-5" style="color:#393939;display:inline-block;"><span style="border-left-style:solid;border-left-style:#eaeaea;padding-left:10px;text-align: center;">{{$question[0]->title}}</span></h1>
              	</div>
        <cite class="text-center justify-content-center mt-2" style="display:block;margin-left: -50%;">
        	Date: {{date('Y-m-d',strtotime($question[0]->created_at))}}
        </cite>
      </div>
      <hr width="50%">
      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8  mt-4">
                      <h4 class="icon-menu">
                      <i class="fas fa-circle icon-menu"></i>	{{$question[0]->answer_title}}
                      </h4>
                </div>
                <div class="col-md-8  mt-4">
                	<div class="form-group">
                		<i class="fas fa-star display-5" style="color:#fb2;"></i> <span style="font-size:14px;">Answer:</span>
                	</div>
                	<div class="form-group" style="font-size:21px;">
                		{{$question[0]->answer}}
                	</div>
                </div>
                <div class="col-md-8">
                	<i class="fas fa-paperclip icon-menu display-5"></i> <span style="font-size:14px;">Attachments:</span>
                	<br>
                	  @php $file = explode('.',$question[0]->attachment) @endphp
                    @if(end($file) == 'jpg' || end($file) == 'png' || end($file) == 'jpeg')
                          <img src="{{asset($question[0]->attachment)}}" width="200"  height="200" />
                    @elseif(end($file) =='mp4')
                          <video src="{{asset($question[0]->attachment)}}" width="200"  height="200" controls></video>
                    @endif
                </div>
            </div>
        </div>
      </section>
@endsection