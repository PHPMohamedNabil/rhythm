@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Pages'=>route('page.index'),'Archive.end'=>''])!!}
@endsection
@section('content')

    <div class="card">
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
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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

  
 function restoreArch(category_name,catid)
 {
      event.preventDefault();

     var form = $(`#restore${catid}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will Restore the Page ${category_name}`,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Restore it!',
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
      'Your  Page data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 function delArc(category_name,catid)
 {
      event.preventDefault();

     var form = $(`#delete${catid}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will delete the Page ${category_name}`,
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
      'Your  Page data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Page {{session("del")}} has been deleted.',
      'success'
    )
 @endif


</script>
@endsection