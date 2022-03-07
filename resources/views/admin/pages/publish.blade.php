@can('publish',$data)
<label class="switch">
  <input id="pub{{$data->id}}" type="checkbox" class="published" data-published="{{$data->published}}" data-id="{{$data->id}}"  {{$data->published == 1 ?'checked':''}}/>
  <span class="slider round"></span>
</label>
@endcan
@cannot('publish',$data)
 
 @if($data->published == 1)
     
  <span class="badge badge-success">Published</span>
       
 @else
  <span class="badge badge-pill badge-warning">Pending</span>
 @endif


@endcan