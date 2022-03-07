<a href="{{route('question_view',[$data->id])}}" class="btn btn-outline-info btn-sm" target="_blank"><i class="fas fa-glasses"></i></a>
&nbsp;
&nbsp;

  @can('update',$data)
  <a href="{{route('question.edit',$data->id)}}" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;
  @endcan                                                    

  @can('delete',$data)
    <form id="del{{$data->id}}"action="{{route('question.destroy',$data->id)}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf 
        @method('DELETE')
           <button onclick="return delCate('{{$data->name}}','{{$data->id}}')" class="edit btn btn-danger btn-sm" type="submit">Delete</button> 
    </form>
 @endcan