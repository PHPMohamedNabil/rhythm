<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Rhythm')</title>

   

    <!-- Fonts -->
  
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="">

 <nav class="navbar navbar-expand-md nav-bg-color">
 <div class="container">
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fas fa-bars" style="color:#fff;"></span>
                </button>
                <!-- Left side of navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a  class="text-white" href="{{asset('/home')}}">
                         <img src="{{asset('logo-white.svg')}}">&nbsp; <span>Fakrny</span>
                     </a>
                     @yield('search_non_main'.'')
                    </ul>
                   <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                     @include('layouts.nav_icon')
                     <div class="dropdown">
  <a class="nav-link text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-user"></i>
       </a>
    
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
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
                    </ul>
               
    </div>
</div>
        </nav>



                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  
                    </div>
   
      
    <!-- LOGO -->
   
    <!-- END LOGO-->
    <!-- TOP NAVIGATION -->
   
    <!-- END TOP NAVIGATION -->
    <!-- SEARCH FIELD AREA -->
    <div class="searchfield bg-hed-six">
       @yield('search_div')
    </div>
    <!-- END SEARCH FIELD AREA -->
    <!-- MAIN SECTION -->
    <div class="container featured-area-default padding-30">
        <div class="row">
            
                  @yield('content')
           
            <!-- END ARTICLES CATEOGIRES SECTION -->
            <!-- SIDEBAR STUFF -->
            <div class="col-md-4 padding-20">
                <!--
                <div class="row margin-bottom-30">
                    <div class="col-md-12 ">
                        <div class="support-container">
                            <h2 class="support-heading">Need more Support?</h2>
                            If you cannot find an answer in the knowledgebase, you can
                            <a href="#">contact us</a> for further help.
                        </div>
                    </div>
                </div>
                end support staff -->

              
                    
                            @yield('questions')
                      

              
                            @yield('articles')
                    

                <!-- POPULAR TAGS (SHOW MAX 20 TAGS) -->
                
                            @yield('temp_q','')
                       
                <!-- END POPULAR TAGS (SHOW MAX 20 TAGS) -->
            </div>
            <!-- END SIDEBAR STUFF -->
        </div>
    </div>
    <!-- END MAIN SECTION -->

    <!-- ABOUT CONTAINER BOTTOM -->
    <div class="container-fluid featured-area-grey padding-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="fb-heading text-center">
                        <span class="border border-success p-3 shadow-lg rounded">Fakrny</span>
                    </div>
                    <div class="fb-content">
                        <p class="display-5">
                            Fakrny is a modern Knowledge base System Helps us to navigate over well documented contents and articles , That Contains an organized content structure to be as fast as possible in your work and be supported with right info
                        </p>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ABOUT CONTAINER BOTTOM -->

    <!-- FOOTER -->
    <div class="container-fluid footer marg30">
        <div class="container">
            <!-- FOOTER COLUMN ONE -->
            <!-- END FOOTER COLUMN ONE -->
            <!-- FOOTER COLUMN TWO -->
            <div class="col-xs-12 col-sm-4 col-md-4 margin-top-20">
                <div class="panel-transparent">
                    <div class="footer-heading">Categories</div>
                    <div class="footer-body">
                        <ul>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{route('categories_view',$category->id)}}">{{$category->name}}</a>
                            </li>
                        @endforeach   
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END FOOTER COLUMN TWO -->
            <!-- FOOTER COLUMN THREE -->

            <!-- END FOOTER COLUMN THREE -->
        </div>
    </div>
    <!-- END FOOTER -->

    <!-- COPYRIGHT INFO -->
    <div class="container-fluid footer-copyright marg30">
        <div class="container">
            <div class="pull-left">
                Copyright © 2022 Fakrny Kb @verision 1.1.1</a>
            </div>
        </div>
    </div>
    <!-- END COPYRIGHT INFO -->

    <!-- LOADING MAIN JAVASCRIPT -->
    <script src="{{ asset('js/app.js') }}"></script>

 @yield('js')
    <script type="text/javascript">

         $( "#search_query" ).autocomplete({
  
        source: function(request, response) {
            $.ajax({
            url: "/page/keyword/",
            type:'GET',
            data: {
                    keyword : request.term
             },
            dataType: "json",
            success: function(data){
               render='';
               var resp = $.map(data,function(obj){
                    return {value:obj.title,slug:obj.slug};
               }); 
              
  
               response(resp);
            },
           
        });
    },
    minLength: 3,
    select:function( event, ui ) {
                var url = '{{ route("pageView",[":slug"]) }}';
                     url = url.replace(':slug', ui.item.slug);
                window.location.href=url;
            }
 }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( '<li>')
        .append('<div class="pt-2 pb-2 col-md-12" >'+'<i class="fas fa-book icon-color"></i> &nbsp;&nbsp;&nbsp;' + item.value+ "</div>")
        .appendTo( ul );
    };

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

