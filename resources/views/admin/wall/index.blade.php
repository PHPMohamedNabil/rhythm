@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Walls.end'=>''])!!}
@endsection
@section('content')
    
    <div class="card">
       <div class="card-header">
          <div class="col-md-8">
            @can('create',App\Models\Wall::class)
            <a class="mb-3 btn btn-outline-primary" href="{{route('wall.create')}}">Create Wall</a>
            @endcan
          </div>
       </div>
       <div class="card-body">
          <div class="table-responsive dataTables_wrapper dt-bootstrap4">
            {!! $dataTable->table(['class'=>'table table-hover table-bordered w-100']) !!}
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

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Wall {{session("del")}} has been deleted.',
      'success'
    )
 @endif
</script>
@endsection