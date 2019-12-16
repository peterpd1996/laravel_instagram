<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tung Duong</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/paper-plane.png">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/js.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Styles -->
</head>

<body>
    <div id="app">
        <header class="padding navigation shadow-sm">
            <div class="container d-flex align-items-center">
                <div class="logo">
                    <a class="navbar-brand d-flex text-dark" href="{{ url('/') }}">
                        <div>
                            <i class="fa fa-instagram pr-3" style="border-right: 1px solid black"></i>
                            <span id="brand">D'Look</span>
                        </div>
                    </a>
                </div>
                @if (Auth::check())
                <div class="search d-flex justify-content-center">
                    <div class="contais">
                        <input type="text" id="searchText" class="border_" placeholder="             Search" size="23">
                        <ul class="result " id="resultSearch" style="text-align: left">
                        </ul>
                    </div>
                </div>
                @endif
                <div class="notification d-flex  mt-2">
                    @auth
                    <div class="mr-2" style="cursor: pointer;position: relative">
                        <i class="fa fa-bell-o " aria-hidden="true" id="notify"></i>
                        <div id="count"></div>
                        {{-- // count notification --}}
                        {{-- notification --}}


                        <ul class="notifi disable" id="notifShow" style="position: absolute;left: -312px">

                            {{-- <li class='border_b'>
                                <a href='/p/{$post->post_id}' class='text-dark'>
                                    <div class='d-flex fix align-items-center'>

                                        <img src='/profiles/abv.jpg' class='rounded'>
                                        <span class='ml-2 userLikeOrCmt'><b>tung duong xin chao
                                            </b>liked
                                            your photo</span>
                                        <div class="imageLikeOrCmt">
                                            <img src='/uploads/{$post->image}' class='w-img'>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='border_b'>
                                <a href='/p/{$cmt->post_id}' class='text-dark'>
                                    <div class='d-flex fix'>
                                        <img src='/profiles/abv.jpg' class='rounded'>
                                        <span class='ml-2 userLikeOrCmt'><b>tung
                                                duong
                                                haha </b>commented on your
                                            photo:"xin qua day ong oi haha"</span>

                                        <img class='mr-2 w-img' src='/uploads/{$post->image}'>

                                    </div>
                                </a>
                            </li> --}}
                        </ul>
                        {{-- endnotification --}}
                    </div>
                    <div class=" pr-2"><a href="/profile/{{ Auth::user()->id ?? ''}}">
                            <i class="fa fa-user-o text-dark" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="username" style="position: relative">
                        <i style="cursor: pointer; " class="fa fa-caret-down" aria-hidden="true"
                            style="position: absolute"></i>
                        <div class="logout none">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="text-dark">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
                @guest
                <div class="actionLoginLogout d-flex pt-1 justify-content-end" style="font-size: 17px">
                    <div class="login mr-3">
                        <a class="text-dark" href="{{ route('login') }}">Login</a>
                    </div>
                    <div class="register" style="padding-right: 10px">
                        <a class="text-dark" href="{{ route('register') }}">Register</a>
                    </div>
                </div>
                @endguest
            </div>
        </header>
        <main class="py-4 main">
            @yield('content')
        </main>
    </div>
</body>

</html>
<script>
    $(document).ready(function () {
        notification()
        $(document).on('keyup', '#searchText', function () {
            var user = $("#searchText").val();
            if (user.trim() != '') {
                $.ajax({
                    url: "/search",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        user: user,
                    },
                    success: function (data) {
                        $('#resultSearch').html(data)
                    }

                })
            } else {
                $('#resultSearch').html('')
            }
        });

        $("#notify").click(function () {
            $("#notifShow").toggleClass("disable");
            $("#count").html('');
            notification('seen');
        });

        function notification(status = '') {
            $.ajax({
                url: "/notification",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    stt: status,
                },
                dataType: "json",
                success: function (data) {
                    if (data.notification != '') {
                        $("#notifShow").html(data.notification);
                    } else {
                        $("#notifShow").html(
                            "<span class='p-3' style='display:block'> you have not receiving notifications !!</span>"
                        );
                    }

                    if (data.unseen_total > 0) {
                        $("#count").html("<span id='countNofi'>" + data.unseen_total + "<span>");
                    }

                }
            })
        }
        $('.fa-caret-down').click(function () {
            $('.logout').toggleClass('none');
        });

    })

</script>
@yield('js')