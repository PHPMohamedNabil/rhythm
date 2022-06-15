@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Category.end'=>''])!!}
@endsection
@section('content')

            <div class="card">
              <div class="card-header">
                  <div class="col-md-8">
                    @can('create',App\Models\Category::class)
                              <a class="mb-3 btn btn-outline-primary" href="{{route('category.create')}}">+ New Category</a>
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
                            {!! $dataTable->table(['class'=>'table table-hover table-bordered']) !!}
                     </div>
                 </div>
            </div>
     
   


@endsection
@section('modal')
 
<!-- Modal -->
<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
  {!! $dataTable->scripts() !!}

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

  @if(session('err'))
   swalWithBootstrapButtons.fire(
      'Error!',
      'Category {{session("del")}} Has many artilces.',
      'error'
    )
 @endif


</script>
@endsection