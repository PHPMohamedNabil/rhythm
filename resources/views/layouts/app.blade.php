<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Rhythm')</title>

   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style type="text/css">
    
</style>
<body class="bg-body home_font">
 
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}" style="margin-top: -9px;">
                    <img src="{{asset('rhythm_logo__final.png')}}" width="80px">
                </a>
                 <a class="mr-4 ml-4 icon-color" href="{{route('categories_all')}}">
                    Category
                </a>
                <form action="" method="get" class="col-md-6">
                    
                    <input type="search" name="query" class="form-control search-inp" placeholder="search..." autocomplete="off" id="search_query" style="border-radius:20px;" />

                </form>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                       @include('layouts.nav_icon')
                    </ul>
                </div>
            </div>
        </nav>
        <div class="search_res">
            <div class="col-md-6 justify-content-center mx-auto align items center" style="z-index:9999;">
                <div id="autocomplete_holder" style="z-index:9999;"> 
                   <div id="autocomplete" style="display: none;width:100%;">
                     
                   </div>
                </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>

<aside class="control-sidebar control-sidebar-dark" style="width:25%;">
    <!-- Control sidebar content goes here -->
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-arrow-right"></i>
        </a>
    <div class="p-3">
        <div class="dropdown">
  <a class="nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      @if(!auth()->user())
       <i class="fas fa-user"></i>
     @else
          {{auth()->user()->username ??''}}
     @endif
  </a>
    
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   @if(!auth()->user())
    <a class="dropdown-item" href="{{route('login')}}" >Login</a>
   
    @else
    <a class="nav-link" href="{{route('home_admin')}}">
      Manage
  </a>
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
         <!-- Sidebar -->
    <div class="sidebar" style="width:100%; overflow-x: auto;overflow-y: auto;"> 
      <!-- Sidebar user panel (optional) -->
     <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         user admin info here 
      </div>-->
<ul class="sidebar-nav navbar-nav">

      <li class="nav-item">
         <label for="nav-search" class="col-2 col-form-label sr-only">Search links</label>
         <div class="col p-2">
            <input class="form-control form-control-sm search-filter" type="search" id="nav-search" placeholder="Search for tools">
         </div>
      </li>
 <div id="link-content" style="font-size:17px;"><!-- added this to wrap the links-->     
      
      <li class="nav-item">
         <span class="navbar-brand">Categories</span>
      </li>
     @foreach($categories as $category)
      <li class="nav-item ">
             <a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseComponents{{$category->id}}"><i class="fa fa-fw fa-list"></i>  {{$category->name}}</a>
       <ul class="sidebar-second-level collapse" id="collapseComponents{{$category->id}}">
              <li style="font-size:12px;list-style:none;">
                <a href="{{route('categories_view',$category->id)}}" >{{$category->name}}</a>
            </li>
               @foreach ($category->childrenCategories as $childCategory)
                  @include('layouts.category_childern_hone', ['child_category' => $childCategory,'third'=>'no'])
               @endforeach
         
        </ul>
      </li>
      @endforeach
       
     
</div>
   </ul>
      <!-- /.sidebar-menu -->
    </div>
    </div>
  </aside>
  <div id="sidebar-overlay"></div>
    </div>
 

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script type="text/javascript">
        var debounce;
       $('#search_query').keyup(function(e){
            clearTimeout(debounce);
               let ser_text_len =$(this).val().length;
               let ser_text =$(this).val();
              // $('#autocomplete').html('');
              
              console.log(ser_text_len % 3 );
               if( (ser_text_len > 3 ) && ser_text.trim()!='')
               {
                 $('#autocomplete').html('');
                  $('#autocomplete').css('display','block');
                      debounce = setTimeout( 
                                function () { 
                                      get_keywords(ser_text.trim()); 
                                },300
                             );
                       
               }
               if(ser_text_len <= 0)
               {
                $('#autocomplete').css('display','none');
                $('#autocomplete').html('');
               }
        });
       function get_keywords(ser_text)
       {   
           

          $.get('/page/keyword/',{keyword:ser_text},function(response){

                  let render = '<ul class="list-group">';
                //  console.log(response[0].title);
                         $('#autocomplete').html('');
                  if(response.length >0)
                  {
                        
                   response.forEach((val,key)=>{
                         console.log(val);
                     var url = '{{ route("pageView",[":slug"]) }}';
                     url = url.replace(':slug', val.slug);
                       render+=`<li class="list-group-item link_search"><i class="fas fa-book icon-color">&nbsp;</i> <a href="${url}" style="" class="link_search">${val.title}</a></li>`;
                     });
                   render+='</ul>';
                   $('#autocomplete').html(render);
                  }
           },'json');
            //console.log(output);
            //return out_put;
       }
// Case insensitive method for filter
jQuery.expr[':'].casecontains = (a, b, c) => jQuery(a).text().toUpperCase().indexOf(c[3].toUpperCase()) >= 0;

$('.search-filter').on('keyup', function () {
            var input = $('.search-filter').val();
                        console.log('input: '+input);
            if (input.length != 0) { 
            // first hide the div #link-content lists from view
            $('#link-content li').hide();
            // but secretly unhide the collapsed links
            // using .show, so the nested uls can be viewed
            $('#link-content li.nav-item ul').addClass('show');
            // then filter in the matching links only
              $('#link-content li:casecontains("'+input+'")').show();
             //if searched result
              $('#link-content ul li').css('display','list-item');
            } else {
            // secretly unhide the collapsed links
            $('#link-content li.nav-item ul').removeClass('show');  
            // if search is empty, show the div and reset columns
            $('#link-content li').show();
            }
        });

    </script>
</body>
</html>
