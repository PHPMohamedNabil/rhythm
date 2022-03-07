@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Permissions'=>route('permission.index'),'Permission Create.end'=>''])!!}
@endsection
@section('content')
    
   <div class="container">
     <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('permission.store')}}" method="post">
          @csrf
        <div class="card">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
            <select name="role_id" class="form-control">
              <option value="">Select Role</option>
              @foreach($roles as $role)
                              <option value="{{$role->id}}">{{$role->name}}</option>
              @endforeach
            </select>
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
                        <td>Categories</td>
                        <td><input type="checkbox" name="permissions[categories][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[categories][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[categories][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[categories][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[categories][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[categories][can-publish]"/></td>
                      </tr>
                           <tr>
                        <td>Questions</td>
                        <td><input type="checkbox" name="permissions[questions][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[questions][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[questions][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[questions][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[questions][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[questions][can-publish]"/></td>
                      </tr>

                          <tr>
                        <td>Pages</td>
                        <td><input type="checkbox" name="permissions[pages][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[pages][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[pages][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[pages][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[pages][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[pages][can-publish]"/></td>
                      </tr>

                          <tr>
                        <td>Templates</td>
                        <td><input type="checkbox" name="permissions[templates][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[templates][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[templates][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[templates][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[templates][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[templates][can-publish]"/></td>
                      </tr>

                      <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permissions[users][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[users][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[users][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[users][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[users][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[users][can-publish]"/></td>
                      </tr>
                      <tr>
                        <td>Permissions</td>
                        <td><input type="checkbox" name="permissions[permissions][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[permissions][can-publish]"/></td>
                      </tr>
                      <tr>
                        <td>Roles</td>
                        <td><input type="checkbox" name="permissions[roles][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[roles][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[roles][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[roles][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[roles][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[roles][can-publish]"/></td>
                      </tr>
                      <tr>
                        <td>Wall</td>
                        <td><input type="checkbox" name="permissions[wall][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[wall][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[wall][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[wall][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[wall][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[wall][can-publish]"/></td>
                      </tr>
                     <tr>
                        <td>System Link</td>
                        <td><input type="checkbox" name="permissions[system_links][can-add]"/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-edit]"/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-view]"/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-delete]"/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-list]"/></td>
                        <td><input type="checkbox" name="permissions[system_links][can-publish]"/></td>
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