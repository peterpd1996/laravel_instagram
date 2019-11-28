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
    copy link này nha .. e muốn tairi về ý, muốn n là hình ảnh
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">0
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Styles -->
  

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navigation padding">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                  <div ><i class="fa fa-instagram pr-3" style="border-right: 1px solid black"></i></div>
                  <div class="pl-3">Instagram</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @if (Auth::check())
                    <div class="" style="padding-left: 270px" style="position: relative">
                        
                        <input type="text" id="searchText" class="border_" placeholder="             Search" size="23">
                    
                    <div class="contais">
                        <ul class="result" id="resultSearch">
                            
                        </ul>

                    </div>
                
                    </div>
                @endif
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            <div class="pt-2 pr-2"><a href="/profile/{{ Auth::user()->id}}">
                                <i class="fa fa-user-o text-dark" aria-hidden="true"></i>
                                
                              </a></div>
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

        <main class="py-4 main">
            @yield('content')
        </main>
    </div>

    
   
</body>
</html>
<script>
    $(document).ready(function(){
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
        })
    })
</script>


@yield('js')

