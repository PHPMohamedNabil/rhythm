@extends('layouts.app')
@section('bg-page','style="background-color:#eaeaea"')
@section('search_non_main')
<div class="row">
    <div class="col-md-12 search-div search-resp">
               <form method="get" class="" action="{{route('p_search')}}">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search for Page?" autocomplete="off" id="search_query" name="page_name">
                          <button class=" btn btn-info btn-sm ml-3" type="submit" style="margin-top: 0px;">Search</button>
                        </div>
                    </form>

             </div>
</div>
@endsection

@section('title',$page[0]->title)

@section('search_div')
  <div class="container" style="">
            <div class="row  margin-bottom-20">
               <div class="col-md-12 justify-content-center align-itmes-cetner text-left">
                    <span style="font-size:10px;margin-left:60px;">Knowledge</span>
                     <h1 class="white d-block"><i class="fas fa-clipboard-list" style="font-size:50px;"></i>&nbsp;&nbsp;{{$page[0]->title}}</h1>
                        <span class="nested"> <i class="fas fa-exclamation-circle"></i>&nbsp; {{$page[0]->short_description}} </span>
                  
               </div>
            </div>
            <br>
            <div class="row">
       
                  <div class="col-md-4 align-items-center justify-content">
                        <div class="ml-4">
                            <span class="">Category</span>
                        <p>
                            @if(isset($page[0]->category->id))
                            <a href="{{route('categories_view',$page[0]->category->id)}}" style="color:#ffe4cd;text-decoration: underline;">{{$page[0]->category->name}}</a>
                            @else
                               <span>!! No Category !!</span>
                            @endif
                        </p> 
                        </div>

                     </div>
                     <div class="col-md-4">
                        <span  class="">Last Update</span>
                        <p style="font-weight:bold;">
                            {{date('d/m/Y H:i:s a',strtotime($page[0]->updated_at))}}
                        </p>
                     </div>
                     <div class="col-md-4 float-right description-mr" style="">
                        
                        <div class="support-container">
                            <h2 class="support-heading">Description</h2>
                            {{$page[0]->long_description}}
                        
                    </div>
                     </div>
                     
             
         </div>
     </div>
@endsection

@section('content')

  <div class="container-fluid">
     <div class="row">
         <div class="col-md-12" style="margin-top:-44px;">
         
               <div class="card">

               	 <div class="card-body" style="overflow-x:auto;">
               	 	{!! $page[0]->content !!}
               	 </div>
               </div>
             </div>

         </div>
     </div>
   </div>

@endsection