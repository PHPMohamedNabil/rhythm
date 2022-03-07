@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Permissions.end'=>''])!!}
@endsection
@section('content')
    
    <div class="card">
       <div class="card-header">
          <div class="col-md-8">
            <a class="mb-3 btn btn-outline-primary" href="{{route('permission.create')}}">Create Permission</a>
          </div>
       </div>
       <div class="card-body">
          <div class="table-responsive dataTables_wrapper dt-bootstrap4">
            <table class="table table-hover table-bordered table-striped">
              <thead>
                <th>Role's Permission</th>
                <th>Edit</th>
              </thead>
              <tbody>
                @foreach($permissions as $permission)
                    <tr>
                      <td>{{$permission->role->name}}</td>
                      <td>
                        <a class="btn btn-info btn-sm" href="{{route('permission.edit',$permission->id)}}"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <form action="{{route('permission.destroy',$permission->id)}}" method="post" style="display:inline-block;" id="del{{$permission->id}}">
                          @csrf
                          <input type="hidden" name="id" value="{{$permission->id}}"/>
                          @method('DELETE')
                          <button class="btn btn-danger btn-sm" onclick="return delCate('{{$permission->role->name}}','{{$permission->id}}');">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
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

  
 function delCate(category_name,catid)
 {
      event.preventDefault();

     var form = $(`#del${catid}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will delete permissions for ${category_name}`,
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
      'Your  permissions  data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Question {{session("del")}} has been deleted.',
      'success'
    )
 @endif
</script>
@endsection