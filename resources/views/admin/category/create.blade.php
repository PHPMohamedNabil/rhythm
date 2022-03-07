@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Categories'=>route('category.index')])!!}
@endsection

@section('content')

  <div class="col-md-12">
            <div class="card">
            	    <div class="card-header">
                 		Create New Category
                 	<div class="float-right">
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
               	 <form  action="{{route('category.store')}}" method="post">
          @csrf
           <div class="form-group">
            
               <label>Category Name</label>
               <input type="text" name="name" class="form-control"/>
           </div>
               <label>CategoryParent</label>
              <div class="form-group">
                 <select name="category_id" class="form-control select2">
                    <option value="">No Parent</option>
                    @foreach($categories as $category)
                    
                      <option value="{{$category->id}}" style="font-weight: bold;">{{$category->name}}</option>
                        
                      @foreach($category->childrenCategories as $childCategory) 
                         
                               @include('admin.category.childern_category',['child_category'=>$childCategory,'pref'=>'/','edit'=>false])
                      @endforeach
                  
                        
                        
                    @endforeach
               </select> 
              </div>
           
           <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Save</button>
           </div>
       </form>
               </div>
       
    </div>
   </div>
@endsection

@section('js')
 

  <script type="text/javascript">
    $('.select2').select2({
      
    });

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