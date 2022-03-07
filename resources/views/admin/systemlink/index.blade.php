@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['System Links.end'=>''])!!}
@endsection
@section('content')


            <div class="card">
              <div class="card-header">
                  <div class="col-md-8">
                    @can('create',App\Models\SystemLink::class)
                              <button class="mb-3 btn btn-outline-primary" data-toggle="modal" data-target="#catModal">Add New Link</button>
                    @endcan
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
                          	 	<th>Name of Link</th>
                          	 	<th>URL</th>
                          	 	<th>Action</th>
                          	 </thead>
                          	 <tbody>
                          	 	@foreach($links as $link)
                          	 	<tr>
                          	 		<td>{{$link->link_name}}</td>
                          	 		<td>{{$link->url}}</td>
                          	 		<td>
  @can('delete',$link)
    <form id="del{{$link->id}}"action="{{route('systemlink.destroy',$link->id)}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf 
        @method('DELETE')
          	<button id="del{{$link->id}}" class="btn btn-sm btn-danger" onclick="return delCate('{{$link->link_name}}','{{$link->id}}');">Delete</button>
    </form>
  @endcan
                          	 		
                          	 			&nbsp;&nbsp;
                                @can('update',$link)
                          	 			<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#linkModal{{$link->id}}">Edit</button>
                                @endcan
                          	 		</td>
                          	 	</tr>

<!-- Modal-->
<div class="modal fade" id="linkModal{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$link->link_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="{{route('systemlink.update',[$link->id])}}" method="post">
          @csrf
          @method('PUT')
           <div class="form-group">
            
               <label>Link Name</label>
               <input type="text" name="link_name" class="form-control" value="{{$link->link_name}}" />
           </div>
           <div class="form-group">
            
            <label for="basic-url">Link Url</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                   <span class="input-group-text" id="basic-addon3">@url</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url" value="{{$link->url}}">
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
                          	    <th>Name of Link</th>
                          	 	<th>URL</th>
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
        <form  action="{{route('systemlink.store')}}" method="post">
          @csrf
           <div class="form-group">
            
               <label>Link Name</label>
               <input type="text" name="link_name" class="form-control"/>
           </div>
           <div class="form-group">
            
            <label for="basic-url">Link Url</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                   <span class="input-group-text" id="basic-addon3">@url</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="url">
           </div>
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
  text: `you will delete the User ${link}`,
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
      'Your  Link data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Link {{session("del")}} has been deleted.',
      'success'
    )
 @endif


</script>

@endsection