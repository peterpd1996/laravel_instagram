<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/ins.jpg">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}" ></script>
    <script src="{{ asset('js/js.js') }}" defer ></script>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Styles -->
  

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navigation padding">
            <div class="container">
                <a class="navbar-brand d-flex" style="padding-right: 247px" href="{{ url('/') }}">
                  <div ><i class="fa fa-instagram pr-3" style="border-right: 1px solid black"></i></div>
                  <div class="pl-3">Instagram</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav " style="padding-right: 250px">
                            @if (Auth::check())
                            <div class=""  style="position: relative">
                                
                                <input type="text" id="searchText" class="border_" placeholder="             Search" size="23">
                            
                            <div class="contais">
                                <ul class="result " id="resultSearch">
                                    
                                </ul>
        
                            </div>
                        
                            </div>
                            @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        {{-- icon notification, user --}}
                          <div class="icon-notification d-flex pt-2" style>
                                <div id="" style="cursor: pointer;position: relative;width: 20px;margin-right: 17px">
                                        <i class="fa fa-bell-o " aria-hidden="true" id="notify"></i>
                                        <div id="count"></div> 
                                        {{-- // count notification --}}
                                        <ul class="notifi disable" id="notifShow" style="position: absolute">
                                                {{-- <li class='border_b'> --}}
                                                        <a href='' class='text-dark'>
                                                            <div class='d-flex fix align-items-center'>
                                                                <img src='/profiles/abv.jpg'  class='rounded'>
                                                                <b class="pl-2">tung</b>
                                                                <div class="pl-1">liked your photo</div>
                                                                <div style="padding-left: 184px">
                                                                    <img src='/profiles/Capture.PNG' class='w-img'>
                                                                </div>
                                                                
                                                            </div>
                                                        </a>
                                                 </li>
                                                 <li class='border_b'>
                                                        <a href='' class='text-dark'>
                                                            <div class='d-flex fix'>
                                                                <img src='/profiles/abv.jpg'  class='rounded'>
                                                                <b class='pl-2 pt-2'>huong</b>
                                                                <div style='padding: 6px'>commented on your photo:"cũng được đấy chứ nhỉ haha" </div>
                                                                <img class='mr-1 w-img' src='/profiles/Capture.PNG'>
                                                                
                                                            </div>
                                                            
                                                        </a>
                                                 </li>
                                        </ul>

                                </div>
                                <div class=" pr-2"><a href="/profile/{{ Auth::user()->id}}">
                                <i class="fa fa-user-o text-dark" aria-hidden="true"></i>
                                    
                              </a>
                            </div>
                          </div>
                           {{-- end icon notification, user --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <nav class="nav navbar-light shadow-sm" >
            <div class="container">
                    <div class="row d-flex align-items-center ">
                        <div class="col-md-3">
                                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                                    <div ><i class="fa fa-instagram pr-3" style="border-right: 1px solid black"></i></div>
                                    <div class="pl-3">Instagram</div>
                                  </a>
                        </div>
                        <div class="col-md-5">
                                @if (Auth::check())
                                    <div class=""  style="position: relative;padding-left: 200px">
                                        
                                        <input type="text" id="searchText" class="border_" placeholder="             Search" size="23">
                                    
                                    <div class="contais">
                                        <ul class="result" id="resultSearch">
                                            
                                        </ul>
                
                                    </div>

                                    </div>
                                @endif
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                                <div><i class="fa fa-bell-o pt-2 pr-4" aria-hidden="true"></i></div>
                                <div class="pt-2 pr-2"><a href="/profile/{{ Auth::user()->id}}">
                                    <i class="fa fa-user-o text-dark" aria-hidden="true"></i>
                                    
                                </a></div>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                            </div>
                    </div>
            </div>
        </nav> --}}

        <main class="py-4 main">
            @yield('content')
        </main>
    </div>

    
   
</body>
</html>
<script>
    $(document).ready(function(){
        notification()
        $(document).on('keyup','#searchText',function(){
            var user = $("#searchText").val();
            if(user.trim() != '')
            {
                 $.ajax({
                    url:"/search",
                    method:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        user:user,
                    },
                    success:function(data){
                        $('#resultSearch').html(data)
                    }
                
                })
            }
            else
            {
                $('#resultSearch').html('')
            }
        });
    
        $("#notify").click(function(){
            $("#notifShow").toggleClass("disable");
            $("#count").html('');
            notification('seen');
        });
        function notification(status = '')
        {
            $.ajax({
                url:"/notification",
                method:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                     stt:status,
                },
                dataType:"json",
                success:function(data){
                    if(data.notification !='')
                    {
                        $("#notifShow").html(data.notification);
                    }
                    else
                    {
                        $("#notifShow").html("<span class='p-3' style='display:block'> you have not receiving notifications !!</span>");
                    }
                    
                    if(data.unseen_total > 0)
                    {
                        $("#count").html("<span id='countNofi'>"+data.unseen_total+"<span>");
                    }
                    
                }
            })
        }

})


    
</script>


@yield('js')

