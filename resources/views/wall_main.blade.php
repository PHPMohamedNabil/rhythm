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
@section('content')
<style type="text/css">
    .dropdown-toggle::after {
          display: none !important;
}
.paper {
  height: 800px;
  width: 100%;
  resize: none;
  font-size: 18px;
  color: #2d2d2d;
  font-family: tahoma;
  font-Style: bold;
  background-color: white;
  //background: repeating-linear-gradient(180deg, white, white, white 40px, grey 42px);
  border: 1px solid #eaeaea;
}
</style>
<div class="container">
    <h3 class="text-center"><i class="fas fa-star" style="color: #eaeaea;"></i> Daily Posts</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills"  aria-orientation="vertical">
 @can('viewAny',App\Models\Wall::class)
  <a class="nav-link active"  href="{{route('wall.index')}}" role="tab" >Walls</a>
 @endcan
  <textarea id="notes" placeholder="write your notes ..."  class="paper mt-2"></textarea>
</div>
            </div>
            <div class="col-lg-9 mx-auto">
                
                <!-- Timeline -->
                <ul class="timeline">

                 @foreach($walls as $wall)
                    <li class="timeline-item bg-white rounded ml-3 p-4 shadow" style="overflow-x:auto;word-wrap: break-word;">
                        <div class="timeline-arrow"></div>
                         @if($wall->is_important ==1)
     
                         <span class="badge badge-pill badge-warning">Important</span>
       
                    @else
                         <span class="badge badge-pill badge-info">Not</span>
                    @endif
                    <div class="float-right">
                        <!-- Example single danger button -->
<div class="btn-group">
 @can('update',$wall)
 @can('delete',$wall)
  <button type="button" class="btn btn-defualt dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-h" style="transform: rotate(272deg);"></i>
  </button>
 @endcan
 @endcan
  <div class="dropdown-menu">
   @can('update',$wall)
    <a class="dropdown-item" href="{{route('wall.edit',$wall->id)}}">Edit</a>
   @endcan
   @can('delete',$wall)
    <form id="del{{$wall->id}}" action="{{route('wall.destroy',$wall->id)}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="wall_main" value="wall_main" />
        <button onclick="return delCate('{{$wall->title}}','{{$wall->id}}')" class="btn btn-defualt text-right" type="submit">Delete</button> 
    </form>
   @endcan
  </div>
</div>
                    </div>
                        <h2 class="h5 mb-0">{{$wall->title}}</h2><span class="small text-gray"><i class="fa fa-clock-o mr-1"></i>{{date('Y-m-d h:i',strtotime($wall->updated_at))}}</span>
                        <p class="text-small mt-2 font-weight-light" style="word-wrap: break-word;">{{$wall->description}}</p>
                        @if($wall->attachment)
                            <div class="text-center">
                                 <img src="{{asset($wall->attachment)}}" style="width:70%; height:100%;" />
                            </div>
                        @endif
                    </li>
                 @endforeach
             </ul>
                 <div class="text-center">
                     {{$walls->links()}}
                 </div>
             </div>
         </div>
</div>
@endsection
@section('js')
  <script type="text/javascript">
   
  


  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

  
 function delCate(category_name,catid)
 {
      event.preventDefault();

     var form = $(`#del${catid}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will delete the Wall ${category_name}`,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
        form.submit();
      return true;

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your  Wall data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }
notesall();
 function notesall()
 {
      return $('#notes').html(localStorage.getItem('todos'));
 }

 $('#notes').on('keyup',function(e){
  localStorage.setItem('todos',this.value);
 })

 </script>
 
@endsection