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
             <div class="card card-default">
                 	<div class="card-header">
                 	  <div class="card-title">
                    	<h2 class="text-center" style="width:100%; color:#666464;">{{$category_parent_name[0]}}</h2>

                 	  </div>
                 		<div class="card-tools">
                            <span>
                                @foreach($categories as $category)
                                    
                                @endforeach
                            </span>
                 		   <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-plus"></i>
                           </button>
                 	    </div>
                 	</div>
                 <div class="card-body">
                 
                     <div class="row">
                        @foreach($categories as $category)
                         <div class="col-md-2 mt-2">
                           <div class="card cat-hover justify-content-center align-itmes-cetner text-center" style="padding:35px;font-size: 20px;">
                               <span class="icon-menu font-weight-bold"><a href="{{route('categories_view',$category->id)}}" class="icon-menu">{{$category->name}}</a></span>
                           </div>
                            
                         </div>
                        @endforeach

                     </div>

                 </div>
             </div>
             @if(count($pages) > 0)
              
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
                  
             @endif
         </div>
     </div>
</div>
@endsection