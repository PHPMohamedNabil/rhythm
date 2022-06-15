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
@section('content')
<div class="container">
     <div class="row">
         <div class="col-md-12">
             @if(count($pages) > 0)
              <h4 style="text-left">Search Resultes for : <span class="font-weight-bold text-info">{{$keyword ??''}}</span></h4>
               <div class="card">
             	<div class="card-header">
             		@foreach($pages as $page)
             		<div class="form-group">
             			<h4>
             				<a style="color:#2c40d0;" href="{{route('pageView',[$page->slug])}}">{{$page->title}}</a>

             			</h4>
             			<cite>
             				{{route('pageView',[$page->slug])}}
             			</cite>
             			<p class="font-weight-bold">
             				{{$page->long_description}}
             			</p>
             		</div>
             		@endforeach
             		<div class="text-center align-itmes-cetner justify-content-center">
             			{{ $pages->links() }}
             		</div>
             	</div>
             </div>
             
             @else
              <div class="text-center">
                   <p>
                       No Search Resultes Found
                   </p>
              </div>  
             @endif

         </div>
     </div>
</div>
@endsection