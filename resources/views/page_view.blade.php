@extends('layouts.app')

@section('title',$page[0]->title)
@section('content')

  <div class="container-fluid">
     <div class="row">
         <div class="col-md-12" style="margin-top:-12px;">
             <div class="card">
               <div class="card-header" style="background-color: #F5F5F5;">
               	  <div class="card-title">
               	  	<span style="font-size:10px;margin-left:47px;">Knowledge</span>
               	  		<h4 style="margin-top: -17px;font-weight: bold;">
               	  		<i class="fas fa-clipboard-list" style="font-size:40px;"></i>&nbsp;&nbsp;
               	       	{{$page[0]->title}}

               	    </h4>
            
               	  	</div>
               	  </div>
               	  <div class="row mt-4">
               	  	 <div class="col-md-2 align-items-center justify-content">
               	  	 	<div class="ml-4">
               	  	 		<span class="page-sub-title">Category</span>
               	  	 	<p>
               	  	 		<a href="{{route('categories_view',$page[0]->category->id)}}">{{$page[0]->category->name}}</a>
               	  	 	</p> 
               	  	 	</div>

               	  	 </div>
               	  	 <div class="col-md-2">
               	  	 	<span  class="page-sub-title">Last Update</span>
               	  	 	<p style="font-weight:bold;">
               	  	 		{{date('d/m/Y H:i:s a',strtotime($page[0]->updated_at))}}
               	  	 	</p>
               	  	 </div>
               	  	 <div class="col-md-8 ">
               	  	 	
               	  	 	<p >
               	  	 		<span  class="page-sub-title">Description:</span> 
               	  	 		 {{$page[0]->long_description}}
               	  	 	</p>
               	  	 </div>
               	  </div>
               </div>
               <div class="card">
               	 <div class="card-header" style="border-bottom-style:solid;border-bottom-color:#2d2d2d;">
               	 	<div class="card-title">
               	 		<i class="fas fa-exclamation-circle"></i>&nbsp; {{$page[0]->short_description}}
               	 	</div>
               	 </div>
               	 <div class="card-body" style="overflow-x:auto;">
               	 	{!! $page[0]->content !!}
               	 </div>
               </div>
             </div>


         </div>
     </div>
   </div>

@endsection