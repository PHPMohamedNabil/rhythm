<div class="col-md-12">
       <div class="card card-default ">
     <div class="card-header">
        Content Updated at {{date('Y-m-d h:i',strtotime($updatechild->updated_at))}} By Username
        <div class="float-right">
          <form action="{{route('page_delete')}}" id="del{{$updatechild->id}}" method="post">
             @csrf
             <input type="hidden" onclick="return delCate('{{$updatechild->title}}','{{$updatechild->id}}');" name="id" value="{{$updatechild->id}}">
             <button class="btn btn-danger btn-md" type="submit"><i class="fas fa-trash"></i> </button>
          </form>
        </div>
     </div>
     <div class="card-body">
               <label>Page Content</label>
               <div class="summernote">
                 {!! $updatechild->content !!}
               </div>
                
    </div>
    </div>
</div>

@if ($updatechild->history->count())
        @foreach ($updatechild->history as $updatechild)
            
          @include('admin.pages.update_childern', ['updatechild' => $updatechild])
    

        @endforeach
@endif