@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Questions'=>route('question.index'),$question->title.'.end'=>''])!!}
@endsection
@section('content')

  <div class="card">
     <div class="card-header">
        Edit Question {{$question->title}}&nbsp;|<b>creator : {{$question->user->username ??''}}</b>
     </div>
     <div class="card-body">
       <form action="{{route('question.update',$question->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
           <div class="form-group">
            
               <label>Question Name</label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')?old('title'):$question->title}}" />
                @error('title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>Answer Title</label>
                <input type="text" name="answer_title" class="form-control @error('answer_title') is-invalid @enderror" value="{{old('answer_title')?old('answer_title'):$question->answer_title}}" />
                @error('answer_title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>Answer</label>
               <textarea class="form-control @error('answer') is-invalid @enderror" name="answer">{{old('answer')?old('answer'):$question->answer}}</textarea>
                 @error('answer')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    @php $file = explode('.',$question->attachment) @endphp
                    @if(end($file) == 'jpg' || end($file) == 'png' || end($file) == 'jpeg')
                          <img src="{{asset($question->attachment)}}" width="200"  height="200" /><button type="button" value="{{$question->id}}" class="btn btn-danger btn-sm delete_at"><i class="fas fa-trash"></i></button>
                    @elseif(end($file) == 'mp4')
                          <video src="{{asset($question->attachment)}}" width="200"  height="200" controls></video>
                    @endif
                </div>
            </div>
             <cite>Attachments (jpg,jpeg,png,mp4) max size 3mb</cite>
              <div class="custom-file">
                <input type="file"  class="custom-file-input  @error('attachment') is-invalid @enderror" id="attat" name="attachment">
                <label class="custom-file-label" for="attat"><i class="fas fa-paperclip"></i> {{str_replace('attachments/','',$question->attachment)}}</label>
               </div>
            @error('attachment')
              <span class="text-danger">
                      {{$message}}          
              </span>
            @enderror
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
       $.post("{{route('question_del_att')}}",{id:Id},function (response) {
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