<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/paper-plane.png">
    <!-- Styles -->
</head>

<body>
    <div id="app">
        <header class="padding navigation shadow-sm d-flex">
            <div class="container d-flex align-items-center">
                <div class="logo">
                    <a class="navbar-brand d-flex text-dark" href="{{ url('/') }}">
                        <div>
                            <i class="fa fa-instagram pr-3" style="border-right: 1px solid black"></i>
                            <span id="brand">D'Look</span>
                        </div>
                    </a>
                </div>
            </div>
             <div class="logout">
                                <a style="font-size: 18px;padding-right: 16px;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="text-dark">
                                {{trans('home.header.log_out')}}
                                    </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
            </div>
        </header>
        <main class="main">
            <div style="text-align: center;">
                <img src="{{ asset('vendor/block.jpeg') }}">
                <div style="margin-top: 15px;font-size: 21px;padding: 20px;background: #afa8a670;"> Tài khoản của bạn đã bị khóa đến ngày {{ $timeBlock }} do đăng một số hình ảnh hoặc nội dung không phù hợp</div>
            </div>

        </main>
    </div>
</body>

</html>

