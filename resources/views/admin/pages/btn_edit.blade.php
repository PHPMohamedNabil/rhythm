
<a href="{{route('pageView',[$data->slug])}}" class="btn btn-outline-info btn-sm" target="_blank"><i class="fas fa-glasses"></i></a>
&nbsp;
&nbsp;
@can('update',$data)
  <a href="{{route('page.edit',$data->id)}}" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;
                                                    

@endcan

@can('delete',$data)
    <form id="del{{$data->id}}"action="{{route('page.destroy',$data->id)}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf 
        @method('DELETE')
           <button onclick="return delCate('{{$data->title}}','{{$data->id}}')" class="edit btn btn-warning btn-sm" type="submit">Move To Archive</button> 
    </form>
@endcan

