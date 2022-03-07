@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Roles.end'=>''])!!}
@endsection
@section('content')


            <div class="card">
              <div class="card-header">
                  <div class="col-md-8">
                              <button class="mb-3 btn btn-outline-primary" data-toggle="modal" data-target="#catModal">Add New Role</button>
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
                     <div class="table-responsive dataTables_wrapper dt-bootstrap4">
                        <table class="table table-hover table-bordered  table-striped">
                          	 <thead>
                          	 	<th>Name</th>
                          	 	<th>Description</th>
                          	 	<th>Action</th>
                          	 </thead>
                          	 <tbody>
                          	 	@foreach($roles as $role)
                          	 	<tr>
                          	 		<td>{{$role->name}}</td>
                          	 		<td>{{$role->description}}</td>
                          	 		<td>

                                  <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#linkModal{{$role->id}}">Edit</button>
                                  &nbsp;&nbsp;
    <form id="del{{$role->id}}"action="{{route('role.destroy',$role->id)}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf 
        @method('DELETE')
          	<button id="del{{$role->id}}" class="btn btn-sm btn-danger" onclick="return delCate('{{$role->name}}','{{$role->id}}');">Delete</button>
    </form>
                          	 		
                          	 		
                          	 		</td>
                          	 	</tr>

<!-- Modal-->
<div class="modal fade" id="linkModal{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$role->link_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="{{route('role.update',[$role->id])}}" method="post">
          @csrf
          @method('PUT')
           <div class="form-group">
            
               <label>Role Name</label>
               <input type="text" name="name" class="form-control" value="{{$role->name}}" />
           </div>
           <div class="form-group">
            
            <label for="basic-url">Role Description</label>
            <div class="input-group mb-3">
                <textarea type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="description">{{$role->description}}</textarea>
           </div>
           </div>
           
           <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Save</button>
           </div>
       </form>
      </div>
    </div>
  </div>
</div>
                          	 	@endforeach
                          	 </tbody>
                          	 <tfoot>
                          	    <th>Name</th>
                          	 	<th>Description</th>
                          	 	<th>Action</th>
                          	 </tfoot>
                        </table>
                     </div>
                 </div>
            </div>


@endsection

@section('modal')
 
<!-- Modal-->
<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="{{route('role.store')}}" method="post">
          @csrf
   
           <div class="form-group">
            
            <label for="basic-url">Role Name</label>
            <div class="input-group mb-3">
             
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="name">
           </div>
           </div>
          <div class="form-group">
            
               <label>Role Description</label>
               <textarea type="text" name="description" class="form-control"></textarea>
           </div>
           
           <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Submit</button>
           </div>
       </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
	
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

  
 function delCate(link,id)
 {
      event.preventDefault();

     var form = $(`#del${id}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will delete the Role ${link} it will be deleted with it is permissions Assigned to it`,
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
      'Your  Role data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Role {{session("del")}} has been deleted.',
      'success'
    )
 @endif


</script>

@endsection