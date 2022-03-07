@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Walls'=>route('wall.index'),'Create new wall.end'=>''])!!}
@endsection
@section('content')

  <div class="card">
     <div class="card-header">
        Creator :{{$wall->user->username ?? ''}}
     </div>
     <div class="card-body">
       <form action="{{route('wall.update',$wall->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
           <div class="form-group">
            
               <label>Title</label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$wall->title}}" />
                @error('title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>description</label>
               <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{$wall->description}}</textarea>
                 @error('description')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
             <cite>Attachments (jpg,jpeg,png) max size 3mb</cite>
              @if($wall->attachment)
                   <img src="{{asset($wall->attachment)}}" width="70" height="70">
             <button type="button" value="{{$wall->id}}" class="btn btn-danger btn-sm delete_at"><i class="fas fa-trash"></i></button>
              @endif
              <div class="custom-file">
                <input type="file"  class="custom-file-input  @error('attatchment') is-invalid @enderror" id="attat" name="attachment">
                <label class="custom-file-label" for="attat"><i class="fas fa-paperclip"></i> Attachments</label>
               </div>
                   @error('attatchment')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
            <label>Is Important Thing *(must read or not)</label>
              <select class="form-control" name="is_important">
                 <option value="0" {{$wall->is_important == 0 ?'selected':''}}>No</option>
                 <option value="1" {{$wall->is_important == 1 ?'selected':''}}>Yes</option>
              </select>
           </div>
           <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Submit</button>
           </div>
       </form>
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


  $(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


   $('.delete_at').on('click',function(){
           let Id = parseInt($(this).val());
 swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will delete the Question attachment`,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
       $.post("{{route('wall_del_att')}}",{id:Id},function (response) {
                 if(response.data == 'done')
                  {
                    $('img').remove();
                    $('video').remove(); 
                    $('.delete_at').remove();      
                    $('.custom-file-label').html(' ');
                     Swal.fire(
                          'Good job!',
                          'Attachment Deleted',
                          'success'
                        )

                 }
                 else{
                      Swal.fire(
                          'Try Again!',
                          'Not Done',
                          'error'
                        )
                 }
           });
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


   });

  });
</script>
@endsection