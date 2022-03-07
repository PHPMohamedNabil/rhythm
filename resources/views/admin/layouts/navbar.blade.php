
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
       <a class="nav-link"  href="{{route('home')}}" >
         <i class="fas fa-desktop"></i>
       </a>
    
      </li>

     
     
  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      @if(!auth()->user())
       Login
     @else
           {{auth()->user()->username}}
     @endif
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   @if(!auth()->user())
    <a class="dropdown-item" href="{{route('login')}}" >Login</a>
   
    @else
         <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
    </a>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
    @endif
  </div>
</div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->