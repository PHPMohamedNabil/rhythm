@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-title"></div>
                 <div class="card-body">
                    <h5><i class="fas fa-list"></i> <span style="border-bottom-style:solid;border-bottom-color:#323a56;">C</span>ategories</h5>
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
         </div>
     </div>
 </div>
@endsection