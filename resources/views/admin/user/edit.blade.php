@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Users'=>route('user.index'),$user[0]->username.'.end'=>''])!!}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                       <div class="col-md-8">
                            {{ __($user[0]->username) }}
                       </div>
                       <div class="col-md-4">
                           <div class="text-right">
                        Last Update : {{date('Y-m-d h:i',strtotime($user[0]->updated_at))}}
                    </div>
                       </div>
                    </div>
                </div>
                 
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update',$user[0]->id) }}">
                        @csrf

                         @method('PUT')


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user[0]->username }}" required autocomplete="name" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user[0]->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user[0]->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                <select id="role"  class="form-control" name="role_id" required>
                                    <option value="">Select User Role</option>
                                    @foreach($roles as $role)
                                      <option value="{{$role->id}}" @if($user[0]->role_id == $role->id) selected="" @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        
                            <div class="form-group justify-content-center text-center">
                                <h4>Change Password</h4>
                            </div>
                        
                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4 pt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header">
                             <form action="{{route('user.destroy',$user[0]->id)}}" method="post" id="del{{$user[0]->id}}"> 
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-outline-danger" type="submit" onclick="return delCate('{{$user[0]->name}}','{{$user[0]->id}}')" id="del{{$user[0]->id}}">
                                      Delete User
                                  </button>
                             </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
     @if(session('msg'))
     Swal.fire(
  'Updated!',
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

  
 function delCate(link,id)
 {
      event.preventDefault();

     var form = $(`#del${id}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will delete the Link ${link}`,
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
      'Your  User data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your Yser {{session("del")}} has been deleted.',
      'success'
    )
 @endif
</script>
@endsection