@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Permissions'=>route('permission.index'),'Permission Create.end'=>''])!!}
@endsection
@section('content')
    
   <div class="container">
     <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('permission.update',$permission->id)}}" method="post">
          @csrf
          @method('PUT')
          <input type="hidden" name="role_id" value="{{$permission->role->id}}">
        <div class="card">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
            <h3>{{$permission->role->name}}</h3>
            <table class="table table-striped table-dark mt-4">
                      <thead>
                        <tr>
                          <th scope="col">Permission</th>
                          <th scope="col">can-add</th>
                          <th scope="col">can-edit</th>
                          <th scope="col">can-view</th>
                          <th scope="col">can-delete</th>
                          <th scope="col">can-list</th>
                          <th scope="col">can-publish</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <tr>
                        <td>Categories</td>
                        <td><input type="checkbox" name="permissions[categories][can-add]" @if(isset($permission['permissions']['categories']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[categories][can-edit]" @if(isset($permission['permissions']['categories']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[categories][can-view]" @if(isset($permission['permissions']['categories']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[categories][can-delete]" @if(isset($permission['permissions']['categories']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[categories][can-list]" @if(isset($permission['permissions']['categories']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[categories][can-publish]"  @if(isset($permission['permissions']['categories']['can-publish'])) checked @endif/></td>
                      </tr>
                           <tr>
                        <td>Questions</td>
                        <td><input type="checkbox" name="permissions[questions][can-add]" @if(isset($permission['permissions']['questions']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[questions][can-edit]" @if(isset($permission['permissions']['questions']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[questions][can-view]" @if(isset($permission['permissions']['questions']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[questions][can-delete]" @if(isset($permission['permissions']['questions']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[questions][can-list]" @if(isset($permission['permissions']['questions']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[questions][can-publish]" @if(isset($permission['permissions']['questions']['can-publish'])) checked @endif/></td>
                      </tr>

                          <tr>
                        <td>Pages</td>
                        <td><input type="checkbox" name="permissions[pages][can-add]" @if(isset($permission['permissions']['pages']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[pages][can-edit]" @if(isset($permission['permissions']['pages']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[pages][can-view]" @if(isset($permission['permissions']['pages']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[pages][can-delete]" @if(isset($permission['permissions']['pages']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[pages][can-list]" @if(isset($permission['permissions']['pages']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[pages][can-publish]" @if(isset($permission['permissions']['pages']['can-publish'])) checked @endif/></td>
                      </tr>

                          <tr>
                        <td>Templates</td>
                        <td><input type="checkbox" name="permissions[templates][can-add]" @if(isset($permission['permissions']['templates']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[templates][can-edit]" @if(isset($permission['permissions']['templates']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[templates][can-view]" @if(isset($permission['permissions']['templates']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[templates][can-delete]" @if(isset($permission['permissions']['templates']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[templates][can-list]" @if(isset($permission['permissions']['templates']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[templates][can-publish]" @if(isset($permission['permissions']['templates']['can-publish'])) checked @endif/></td>
                      </tr>

                          <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permissions[users][can-add]" @if(isset($permission['permissions']['users']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[users][can-edit]" @if(isset($permission['permissions']['users']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[users][can-view]" @if(isset($permission['permissions']['users']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[users][can-delete]" @if(isset($permission['permissions']['users']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[users][can-list]" @if(isset($permission['permissions']['users']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[users][can-publish]" @if(isset($permission['permissions']['users']['can-publish'])) checked @endif/></td>
                      </tr>
                      <tr>
                         <td>Permissions</td>
                        <td><input type="checkbox" name="permissions[permissions][can-add]" @if(isset($permission['permissions']['permissions']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-edit]" @if(isset($permission['permissions']['roles']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-view]" @if(isset($permission['permissions']['permissions']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-delete]" @if(isset($permission['permissions']['permissions']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-list]" @if(isset($permission['permissions']['permissions']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-publish]" @if(isset($permission['permissions']['permissions']['can-publish'])) checked @endif/></td>
                      </tr>
                      <tr>
                        <td>Roles</td>
                        <td><input type="checkbox" name="permissions[roles][can-add]" @if(isset($permission['permissions']['roles']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[roles][can-edit]" @if(isset($permission['permissions']['roles']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[roles][can-view]" @if(isset($permission['permissions']['roles']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[roles][can-delete]" @if(isset($permission['permissions']['roles']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[roles][can-list]" @if(isset($permission['permissions']['roles']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[roles][can-publish]" @if(isset($permission['permissions']['roles']['can-publish'])) checked @endif/></td>
                      </tr>
                      </tr>
                      <tr>
                        <td>Wall</td>
                        <td><input type="checkbox" name="permissions[walls][can-add]" @if(isset($permission['permissions']['walls']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[walls][can-edit]" @if(isset($permission['permissions']['walls']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[walls][can-view]" @if(isset($permission['permissions']['walls']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[walls][can-delete]" @if(isset($permission['permissions']['walls']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[walls][can-list]" @if(isset($permission['permissions']['walls']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[walls][can-publish]" @if(isset($permission['permissions']['walls']['can-publish'])) checked @endif/></td>
                      </tr>
                     <tr>
                        <td>System Link</td>
                        <td><input type="checkbox" name="permissions[system_links][can-add]" @if(isset($permission['permissions']['system_links']['can-add'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-edit]" @if(isset($permission['permissions']['system_links']['can-edit'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-view]" @if(isset($permission['permissions']['system_links']['can-view'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-delete]" @if(isset($permission['permissions']['system_links']['can-delete'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-list]" @if(isset($permission['permissions']['system_links']['can-list'])) checked @endif/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-publish]" @if(isset($permission['permissions']['system_links']['can-publish'])) checked @endif/></td>
                      </tr>  
                      
                     </tbody>
                   </table>
                   <button type="submit" class="btn btn-primary mt-4">Submit</button>
          </div>
        </div>
        </form>
      </div>
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

  
 function delCate(category_name,catid)
 {
      event.preventDefault();

     var form = $(`#del${catid}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will delete the Question ${category_name}`,
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
      'Your  Question data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Question {{session("del")}} has been deleted.',
      'success'
    )
 @endif
</script>
@endsection