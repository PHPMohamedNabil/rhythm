@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Pages'=>route('page.index'),$history[0]->slug.' (history of content updates).end'=>''])!!}
@endsection
@section('content')
  <div class="row">
    <div class="alert alert-warning">
       Versions of updates
    </div>
      @foreach($history as $update)
         <div class="col-md-12">
       <div class="card card-default ">
     <div class="card-header">
        Content Updated at {{date('Y-m-d h:i',strtotime($update->updated_at))}} By  <b>{{$update->editor->username ?? ''}}</b>&nbsp;&nbsp;Author was : {{$update->user->username ?? ''}} 
         <div class="float-right">
          <form action="{{route('page_delete_history')}}"id="del{{$update->id}}" method="post">
             @csrf
             <input type="hidden" name="id" value="{{$update->id}}">
             <input type="hidden" name="parent_id" value="{{$parent_page}}">
             <button onclick="return delCate('{{$update->title}}','{{$update->id}}');" class="btn btn-danger btn-md" type="submit"><i class="fa fa-trash"></i></button>
          </form>
        </div>
     </div>
     <div class="card-body">
               <label>Page Content</label>
               <div class="summernote">
                 {!! $update->content !!}
               </div>
    </div>
    </div>
     </div>
      @endforeach
  </div>
@endsection


@section('js')
  
  <script type="text/javascript">

     $(function(){
      $('.summernote').summernote();
    });
      

      // onImageUpload callback



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
  text: `you will delete the Page history `,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Move it!',
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
      'Your   data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

  </script>
@endsection