
 <form id="restore{{$data->id}}"action="{{route('page_restore')}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf 
        <input type="hidden" name="id" value="{{$data->id}}"/>
           <button onclick="return restoreArch('{{$data->title}}','{{$data->id}}')" class="edit btn btn-success btn-sm" type="submit"><i class="fas fa-trash-restore"></i>&nbsp;Restore Page</button> 
    </form>

     <form id="delete{{$data->id}}"action="{{route('page_delete')}}" onsubmit="" method="post" style="display:inline-block;">
        @csrf 
        <input type="hidden" name="id" value="{{$data->id}}"/>

        <input type="hidden" name="archive_delete" value="{{$data->deleted_at}}"/>
           <button onclick="return delArc('{{$data->title}}','{{$data->id}}')" class="edit btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i>&nbsp;Delete Page</button> 
    </form>