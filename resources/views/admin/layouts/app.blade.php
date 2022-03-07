@include('admin.layouts.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
   
   @include('admin.layouts.navbar')
   
   @include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Home Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            @yield('bread','')
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              @yield('content')
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
    
    @include('admin.layouts.footer')
</div>
<!-- ./wrapper -->

@yield('modal','')

<!-- REQUIRED SCRIPTS -->

 <script src="{{ asset('js/app.js') }}"></script>
 @yield('js')
 

</body>
</html>
