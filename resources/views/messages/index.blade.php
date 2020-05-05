<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- Favicons -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tung Duong</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/paper-plane.png">
    <!-- Scripts -->
    {{-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body class="chat-page">
<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <header class="padding  shadow-sm" style="background: white">
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
                        <input type="text" id="searchText" class="border_" placeholder="{{trans('home.header.search')}}" size="23" style="font-family:Arial, FontAwesome !important;text-align: center;padding: 3px 3px 2px 3px;border-radius: 20px;">
                        <ul class="result " id="resultSearch" style="text-align: left">
                        </ul>
                    </div>
                </div>
            @endif
            <div class="notification d-flex  mt-2">
                @auth
                    <div class="messenger pr-2">
                        <a href="{{route('messages.show') }}" class="text-dark">
                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="mr-2" style="cursor: pointer;position: relative">
                        <i class="fa fa-bell-o " aria-hidden="true" id="notify"></i>
                        <div id="count"></div>
                        {{-- // count notification --}}
                        {{-- notification --}}
                        <ul class="notifi disable" id="notifShow" style="position: absolute;left: -312px">
                        </ul>
                        {{-- endnotification --}}
                    </div>
                    <div class=" pr-2">
                        <a href="/profile/{{ Auth::user()->id ?? ''}}">
                            <i class="fa fa-user-o text-dark" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="username" style="position: relative">
                        <i style="cursor: pointer; " class="fa fa-caret-down" aria-hidden="true"
                           style="position: absolute"></i>
                        <div class="logout none">
                             <ul style="list-style: none;">
                                <li>    
                                    <form action="{{ route('changeLang') }}" class="form-lang" method="post">
                                        <select name="locale" onchange='this.form.submit();' class="select">
                                            <option
                                                value="vi" {{ Lang::locale() === 'vi' ? 'selected' : '' }}>{{trans('home.header.lang_vi')}}</option>
                                            <option
                                                value="jp" {{ Lang::locale() === 'jp' ? 'selected' : '' }}>{{trans('home.header.lang_en')}}</option>
                                        </select>
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li><a  class="text-dark" href="{{route('changePassword')}}">{{trans('home.header.change_pass')}}</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="text-dark">
                                {{trans('home.header.log_out')}}
                                    </a>
                                </li>
                            </ul>
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
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12" style="padding: 0 !important">
                    <div class="chat-window">
                        <!-- Chat Left -->
                        <div class="chat-cont-left">
                            <div class="chat-header">
                                <img src="/profiles/{{Auth::user()->profile->profileImage()}}" alt="" width="50px"
                                     height="50px" class="rounded-circle">
                                <span id="mes" data-message="{{ Auth::user()->id}}" class="pl-2">{{ trans('message.chat') }}</span>
                            </div>
                            <form class="chat-search">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{trans('home.header.search')}}"
                                           style="background:rgba(210, 210, 210, 0.51) !important">
                                </div>
                            </form>
                            <div class="chat-users-list">
                                <div class="chat-scroll-left">
                                    @if($userText !== null)
                                        <a href="javascript:void(0);" class="media user active" data-user={{$userText->id}}>
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-online">
                                                    <img src="/profiles/{{$userText->profile->profileImage()}}"
                                                         alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">{{ $userText->username }}</div>
                                                    <div class="user-last-chat">{{ $userText->getLastMessageWithUser(auth()->user()->id,$userText->id) }}</div>
                                                </div>
                                                <div>
                                                    {{-- <div class="last-chat-time block">2 min</div> --}}
                                                    <div
                                                        class="unread badge badge-success badge-pill ">{{ $userText->countMessageUnread($userText->id,auth()->user()->id) }}</div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    @foreach($users as $user)
                                        <a href="javascript:void(0);" class="media user" data-user={{$user->id}}>
                                            <div class="media-img-wrap">
                                                <div class="avatar avatar-online">
                                                    <img src="/profiles/{{$user->profile->profileImage()}}"
                                                         alt="User Image" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="user-name">{{ $user->username }}</div>
                                                    <div class="user-last-chat">{{ $user->getLastMessageWithUser(auth()->user()->id,$user->id) }}</div>
                                                </div>
                                                <div>
                                                    {{-- <div class="last-chat-time block">2 min</div> --}}
                                                    <div class="unread badge badge-success badge-pill">{{ $user->countMessageUnread($user->id,auth()->user()->id) }}</div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /Chat Left -->
                        <!-- Chat Right -->
                        <div class="chat-cont-right" id="chat-right">
                            @include('messages.chat_content')
                        </div>
                        <!-- /Chat Right -->
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>
    </div>
</div>
<div class="modal fade call-modal" id="voice_call">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Outgoing Call -->
                <div class="call-box incoming-box">
                    <div class="call-wrapper">
                        <div class="call-inner">
                            <div class="call-user">
                                <img class="call-avatar" src="{{ asset('profiles/249593.jpg')}}" alt="User Image">
                                <h4>Darren Elder</h4>
                                <span>Connecting...</span>
                            </div>
                            <div class="call-items">
                                <a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal"
                                   aria-label="Close"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                <a href="voice-call.html" class="btn call-item call-start"><i class="fa fa-phone"
                                                                                              aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Outgoing Call -->
            </div>
        </div>
    </div>
</div>
<!-- /Voice Call Modal -->
<!-- Video Call Modal -->
<div class="modal fade call-modal" id="video_call">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Incoming Call -->
                <div class="call-box incoming-box">
                    <div class="call-wrapper">
                        <div class="call-inner">
                            <div class="call-user">
                                <img class="call-avatar" src="{{ asset('profiles/249593.jpg')}}" alt="User Image">
                                <h4>Darren Elder</h4>
                                <span>Calling ...</span>
                            </div>
                            <div class="call-items">
                                <a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal"
                                   aria-label="Close"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                <a href="video-call.html" class="btn call-item call-start"><i class="fa fa-video-camera"
                                                                                              aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Incoming Call -->
            </div>
        </div>
    </div>
</div>


</body>
<!-- doccure/chat.html  30 Nov 2019 04:12:18 GMT -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{ asset('js/script.js') }}" defer=""></script>
<script src="{{ asset('js/header.js') }}" defer=""></script>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(function () {
        var toUser = $('.active').attr('data-user');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#input-message').click(function () {
            scrollToBottom();
        });

        function loadMessageFromUser(id,unReadFromUser) {
            return $.ajax({
                url: '/load-message',
                method: 'post',
                data: {toUser: id, unread:unReadFromUser}
            });
        }

        function sendMessage(toUser, message) {
            return $.ajax({
                url: '/send-message',
                method: 'post',
                data: {toUser: toUser, message: message},
                cache: false
            });
        }

        function scrollToBottom() {
            $('body .chat-scroll').animate({
                scrollTop: $('.chat-scroll').get(0).scrollHeight
            }, 500);
        }

        function sentMessage() {
            let message = $("#input_message").val();
            if ($.trim(message) !== '' && toUser !== '' && typeof toUser !== 'undefined') {
                $('#input_message').val('');
                sendMessage(toUser, message);
                scrollToBottom();
            } else {
                alert("You need to select friend to text !!");
            }
        }

        $(document).on('click', '#sent_message', function () {
            sentMessage();
        });
        $('.user').click(function () {
            let unReadMessage = $(this).find('.unread');
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.bold-unread').removeClass('bold-unread');
            toUser = $(this).attr('data-user');
            let unReadFromUser = unReadMessage.text();
            if(unReadFromUser !== null){
                unReadMessage.text(null);
            }
            loadMessageFromUser(toUser,unReadFromUser)
                .done(response => {
                    $('#chat-right').html(response);
                    scrollToBottom();
                });
        });
        $(document).on('keyup', '#input_message', function (e) {
            if (e.keyCode == 13) {
                sentMessage();
            }
        });
        $(".chat-scroll").on('scroll', function () {
            if ($(this).scrollTop() === 0) {
                // code here
            }
        });

    })
</script>
</html>







