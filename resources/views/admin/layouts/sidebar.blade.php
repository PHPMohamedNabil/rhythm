
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <span class="brand-text font-weight-light text-center">Rhythm KB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         user admin info here 
      </div>-->

      <!-- SidebarSearch Form -->
     <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         @can('viewAny',App\Models\Category::class)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Categories</p>
                </a>
              </li>
          
            </ul>
          </li>
        @endcan
        @can('viewAny',App\Models\Question::class)
         <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                Q & A
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('create',App\Models\Question::class)
              <li class="nav-item">
                <a href="{{route('question.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New Question</p>
                </a>
              </li>
              @endcan
              <li class="nav-item">
                <a href="{{route('question.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Questions</p>
                </a>
              </li>
            </ul>
          </li>
         @endcan
        
        @can('viewAny',App\Models\Page::class)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             @can('create',App\Models\Page::class)
              <li class="nav-item">
                <a href="{{route('page.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New Page</p>
                </a>
              </li>
              @endcan
              @can('viewAny',App\Models\Page::class)
              <li class="nav-item">
                <a href="{{route('page.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pages</p>
                </a>
              </li>
              @endcan
              @can('remove',App\Models\Page::class)
              <li class="nav-item">
                <a href="{{route('page_archive')}}" class="nav-link">
                  <i class="fas fa-archive nav-icon"></i>
                  <p>Archive</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        @endcan
      @can('viewAny',App\Models\ShortCut::class)

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Templates
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('create',App\Models\ShortCut::class)
              <li class="nav-item">
                <a href="{{route('shortcut.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New Template</p>
                </a>
              </li>
              @endcan
              
              <li class="nav-item">
                <a href="{{route('shortcut.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Templates</p>
                </a>
              </li>
            </ul>

          </li>
        @endcan

         @can('viewAny',App\Models\Wall::class)
        <li class="nav-item">

            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Wall
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('create',App\Models\Wall::class)
              <li class="nav-item">
                <a href="{{route('wall.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
            @endcan

               @can('viewAny',App\Models\Wall::class)
              <li class="nav-item">
                <a href="{{route('wall.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wall Posts</p>
                </a>
              </li>
              @endcan
            </ul>
            
          </li>
        @endcan
        @can('viewAny',App\Models\User::class)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users & Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('create',App\Models\User::class)
              <li class="nav-item">
                <a href="{{route('user.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li>
              @endcan
              @can('viewAny',App\Models\User::class)
               <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              @endcan
              @can('viewAny',App\Models\Role::class)
              <li class="nav-item">
                <a href="{{route('role.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              @endcan
               @can('viewAny',App\Models\Permission::class)
               <li class="nav-item">
                <a href="{{route('permission.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permissions</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
            @can('viewAny',App\Models\SystemLink::class)
              <li class="nav-item">
                <a href="{{route('systemlink.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Systems Links</p>
                </a>
              </li>
            @endcan


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>