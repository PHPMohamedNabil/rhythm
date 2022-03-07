@can('update',$data)
  <a href="{{route('category.edit',$data->id)}}" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;
@endcan
@can('delete',$data)
    <form id="del{{$data->id}}"action="{{route('category.destroy',$data->id)}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf 
        @method('DELETE')
           <button onclick="return delCate('{{$data->name}}','{{$data->id}}')" class="edit btn btn-danger btn-sm" type="submit">Delete</button> 
    </form>
@endcan