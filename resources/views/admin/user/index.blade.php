@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Users.end'=>''])!!}
@endsection
@section('content')
    
    <div class="card">
       <div class="card-header">
          <div class="col-md-8">
            <a class="mb-3 btn btn-outline-primary" href="{{route('user.create')}}">New User</a>
          </div>
       </div>
       <div class="card-body">
          <div class="table-responsive dataTables_wrapper dt-bootstrap4">
            {!! $dataTable->table(['class'=>'col-12 w-100']) !!}
          </div>
       </div>
    </div>

@endsection


@section('js')
  {!! $dataTable->scripts() !!}

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
  text: `you will delete the User ${category_name}`,
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
      'Your  User data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your User {{session("del")}} has been deleted.',
      'success'
    )
 @endif
</script>
@endsection