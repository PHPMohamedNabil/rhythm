@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Categories'=>route('category.index'),$cate->name.'.end'=>route('category.edit',$cate->id)])!!}
@endsection
@section('content')

     <div class="col-md-12">
            <div class="card">
            	    <div class="card-header">
                 		{{$cate->name}}
                 	<div class="float-right">
                 		 @if($cate->category_id != null)

                         <form id="del{{$cate->id}}"action="{{route('category.destroy',$cate->id)}}" onsubmit="" method="post" style="display:inline-block;">
                          @csrf 
                          @method('DELETE')
                             <button onclick="return delCate('{{$cate->name}}','{{$cate->id}}')" class="edit btn btn-danger btn-sm" type="submit">Delete ( {{$cate->name}} ) ChildCategory</button> 
                        </form>
                     @endif
                    </div>
                 	</div>
                 <div class="card-body">
                 	@if($errors->any())
                       <div class="alert alert-danger alert-dismissible">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <p><strong>Opps Something went wrong</strong></p>
                           <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                           </ul>
                       </div>

                     @endif
                       <form action="{{route('category.update',$cate->id)}}" method="post">
                       	  @csrf
                       	  @method('PUT')
                       	  <div class="form-group">
                       	  	<label for="name">Name:</label>
                       	  	 <input id="name" type="text" name="name" value="{{old('name')?? $cate->name}}" class="form-control">
                       	  </div>
                       	  <div class="form-group">
                       	  		<label for="name">Parent:</label>
                       	  	 <select name="category_id" class="form-control select2">
                              <option value="">no parent</option>
                       	  	 	@if($cate->category_id == null)
                       	  	 	         <option value="" selected="">no parent</option>
                                        
                       	  	 	@endif
                       	  	 	 @foreach($categories as $key => $category)
                                   
                                      @if($category->id == $cate->category_id)
                                        <option value="{{$category->id}}" selected="">{{$category->name}}</option>
                       	  	 	      @elseif($category->id == $cate->id)
                                      @php unset($category->id) @endphp
                                    @else
                                     <option value="{{$category->id}}" style="font-weight: bold;">{{$category->name}}</option>
                                        
                       	  	 	      @endif

                       	  	 	    @foreach($category->childrenCategories as $childCategory) 

                       	  	 	       @include('admin.category.childern_category',['child_category'=>$childCategory,'pref'=>'/','edit'=>true])
                       	  	 	 @endforeach
                       	  	 	 @endforeach
                       	  	 </select>
                       	  </div>
                       	  <div class="form-group">
                       	  	 <button class="btn btn-primary btn-block" type="submit">Save</button>
                       	  </div>
                       </form>
                 </div>
             </div>
      </div>
@endsection


@section('js')

  <script type="text/javascript">
     $('.select2').select2();
  @if(session('msg'))
     Swal.fire(
  'Good job!',
  '{{session("msg")}}',
  'success'
)

  @endif


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
  text: `you will delete the Category ${category_name}`,
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
      'Your  category data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Category {{session("del")}} has been deleted.',
      'success'
    )
 @endif

</script>
@endsection