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
                        <input type="text" id="searchText" class="border_" placeholder="&#xF002; Search" size="23" style="font-family:Arial, FontAwesome;text-align: center;">
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
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12" style="padding: 0 !important">
							<div class="chat-window">
								<!-- Chat Left -->
								<div class="chat-cont-left">
									<div class="chat-header">
										<span>Tin nhắn</span>
									</div>
									<form class="chat-search">
										<div class="input-group">
											<div class="input-group-prepend">
												<i class="fa fa-search" aria-hidden="true"></i>
											</div>
											<input type="text" class="form-control" placeholder="Tìm kiếm" style="background:rgba(210, 210, 210, 0.51) !important">
										</div>
									</form>
									<div class="chat-users-list">
										<div class="chat-scroll">
											<a href="javascript:void(0);" class="media">
												<div class="media-img-wrap">
													<div class="avatar avatar-away">
														<img src="{{ asset('profiles/abv.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Nguyễn Quỳnh Nga</div>
														<div class="user-last-chat">Hihi anh khỏe không ạ?</div>
													</div>
													<div>
														<div class="last-chat-time block">2 min</div>
														<div class="badge badge-success badge-pill">15</div>
													</div>
												</div>
											</a>
											<a href="javascript:void(0);" class="media read-chat">
												<div class="media-img-wrap">
													<div class="avatar avatar-online">
														<img src="{{ asset('profiles/image.png')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Lê Quỳnh Mai</div>
														<div class="user-last-chat">Tối nay anh nhé </div>
													</div>
													<div>
														<div class="last-chat-time block">8:01 PM</div>
													</div>
												</div>
											</a>
											<a href="javascript:void(0);" class="media">
												<div class="media-img-wrap">
													<div class="avatar avatar-away">
														<img src="{{ asset('profiles/sunlight-landscape-sunset-sea-shore-sand-557147-wallhere.com.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Nguyễn Lan Hương</div>
														<div class="user-last-chat">Anh nhớ học bài nhaaaa</div>
													</div>
													<div>
														<div class="last-chat-time block">7:30 PM</div>
														<div class="badge badge-success badge-pill">3</div>
													</div>
												</div>
											</a>
											<a href="javascript:void(0);" class="media read-chat">
												<div class="media-img-wrap">
													<div class="avatar avatar-online">
														<img src="{{ asset('profiles/dem2.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Ngô Hương Lan</div>
														<div class="user-last-chat">Anh làm bài tập chưa thế</div>
													</div>
													<div>
														<div class="last-chat-time block">6:59 PM</div>
													</div>
												</div>
											</a>
												<a href="javascript:void(0);" class="media">
												<div class="media-img-wrap">
													<div class="avatar avatar-away">
														<img src="{{ asset('profiles/abv.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Nguyễn Quỳnh Nga</div>
														<div class="user-last-chat">Hihi anh khỏe không ạ?</div>
													</div>
													<div>
														<div class="last-chat-time block">2 min</div>
														<div class="badge badge-success badge-pill">15</div>
													</div>
												</div>
											</a>
											<a href="javascript:void(0);" class="media read-chat active">
												<div class="media-img-wrap">
													<div class="avatar avatar-online">
														<img src="{{ asset('profiles/image.png')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Lê Quỳnh Mai</div>
														<div class="user-last-chat">Tối nay anh nhé </div>
													</div>
													<div>
														<div class="last-chat-time block">8:01 PM</div>
													</div>
												</div>
											</a>
											<a href="javascript:void(0);" class="media">
												<div class="media-img-wrap">
													<div class="avatar avatar-away">
														<img src="{{ asset('profiles/sunlight-landscape-sunset-sea-shore-sand-557147-wallhere.com.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Nguyễn Lan Hương</div>
														<div class="user-last-chat">Anh nhớ học bài nhaaaa</div>
													</div>
													<div>
														<div class="last-chat-time block">7:30 PM</div>
														<div class="badge badge-success badge-pill">3</div>
													</div>
												</div>
											</a>
											<a href="javascript:void(0);" class="media read-chat">
												<div class="media-img-wrap">
													<div class="avatar avatar-online">
														<img src="{{ asset('profiles/dem2.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Ngô Hương Lan</div>
														<div class="user-last-chat">Anh làm bài tập chưa thế</div>
													</div>
													<div>
														<div class="last-chat-time block">6:59 PM</div>
													</div>
												</div>
											</a>
											<a href="javascript:void(0);" class="media read-chat">
												<div class="media-img-wrap">
													<div class="avatar avatar-online">
														<img src="{{ asset('profiles/dem2.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Ngô Hương Lan</div>
														<div class="user-last-chat">Anh làm bài tập chưa thế</div>
													</div>
													<div>
														<div class="last-chat-time block">6:59 PM</div>
													</div>
												</div>
											</a>
														<a href="javascript:void(0);" class="media read-chat">
												<div class="media-img-wrap">
													<div class="avatar avatar-online">
														<img src="{{ asset('profiles/dem2.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
												</div>
												<div class="media-body">
													<div>
														<div class="user-name">Ngô Hương Lan</div>
														<div class="user-last-chat">Anh làm bài tập chưa thế</div>
													</div>
													<div>
														<div class="last-chat-time block">6:59 PM</div>
													</div>
												</div>
											</a>

											
										</div>
									</div>
								</div>
								<!-- /Chat Left -->
								<!-- Chat Right -->
								<div class="chat-cont-right">
									<div class="chat-header">
										<a id="back_user_list" href="javascript:void(0)" class="back-user-list">
											<i class="fa fa-chevron-left" aria-hidden="true"></i>
										</a>
										<div class="media">
											<div class="media-img-wrap">
												<div class="avatar avatar-online">
													<img src="{{ asset('profiles/dem2.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
												</div>
											</div>
											<div class="media-body">
												<div class="user-name">Lê Quỳnh Mai</div>
												<div class="user-status">online</div>
											</div>
										</div>
										<div class="chat-options">
											<a href="javascript:void(0)" data-toggle="modal" data-target="#voice_call">
												<i class="fa fa-phone" aria-hidden="true"></i>
											</a>
											<a href="javascript:void(0)" data-toggle="modal" data-target="#video_call">
												<i class="fa fa-video-camera" aria-hidden="true"></i>
											</a>
										</div>
									</div>
									<div class="chat-body">
										<div class="chat-scroll">
											<ul class="list-unstyled">
												<li class="media sent">
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p>Hello em, em đang làm gì thế?</p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>8:30 AM</span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<li class="media received">
													<div class="avatar">
														<img src="{{ asset('profiles/249593.jpg')}}" alt="Attachment" class="avatar-img rounded-circle">
													</div>
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p>Dạ em đang chơi linh tinh ấy mà hehe.</p>
																<p>Anh ăn cơm chưa ạ?</p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>8:35 AM</span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
														<div class="msg-box">
															<div>
																<p>Cho anh xem mấy đứa bạn em xinh lém</p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>8:40 AM</span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
														<div class="msg-box">
															<div>
																<div class="chat-msg-attachments">
																	<div class="chat-attachment">
																		<img src="assets/img/students/student-06.jpg" alt="Attachment">
																		<div class="chat-attach-caption">Nga xinh.jpg</div>
																		<a href="#" class="chat-attach-download">
																			<i class="fas fa-download"></i>
																		</a>
																	</div>
																	<div class="chat-attachment">
																		<img src="{{ asset('profiles/249593.jpg')}}" alt="Attachment">
																		<div class="chat-attach-caption">Lan anh.jpg</div>
																		<a href="#" class="chat-attach-download">
																			<i class="fas fa-download"></i>
																		</a>
																	</div>
																</div>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>8:41 AM</span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<li class="media sent">
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p>Úi chà</p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>8:42 AM</span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<li class="media received">
													<div class="avatar">
														<img src="{{ asset('profiles/249593.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p>Ui rụng trứng mất .</p>
																<p>CHo em xin số anh ấy đi?</p>
																<p>Được không anh?</p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>8:55 PM</span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<li class="chat-date">Today</li>
												<li class="media received">
													<div class="avatar">
														<img src="{{ asset('profiles/249593.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p>Anh oiwiiiii đâu rồiiiii</p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>10:17 AM</span>
																		</div>
																	</li>
																	<li><a href="#">Edit</a></li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<li class="media sent">
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p>À anh vừa đi ỉa cái</p>
																<div class="chat-msg-actions dropdown">
																	<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<i class="fe fe-elipsis-v"></i>
																	</a>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a class="dropdown-item" href="#">Delete</a>
																	</div>
																</div>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>10:19 AM</span>
																		</div>
																	</li>
																	<li><a href="#">Edit</a></li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<li class="media received">
													<div class="avatar">
														<img src="{{ asset('profiles/249593.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
													</div>
													<div class="media-body">
														<div class="msg-box">
															<div>
																<div class="msg-typing">
																	<span></span>
																	<span></span>
																	<span></span>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="chat-footer">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="btn-file btn">
													<i class="fa fa-paperclip"></i>
													<input type="file">
												</div>
											</div>
											<input type="text" class="input-msg-send form-control" placeholder="Type something">
											<div class="input-group-append">
												<button type="button" class="btn msg-send-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>
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
										<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="fa fa-phone" aria-hidden="true"></i></a>
										<a href="voice-call.html" class="btn call-item call-start"><i class="fa fa-phone" aria-hidden="true"></i></a>
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
										<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="fa fa-phone" aria-hidden="true"></i></a>
										<a href="video-call.html" class="btn call-item call-start"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
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
</html>







