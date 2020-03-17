@extends('layouts.app')
@section('content')
<div class="chat-page">
			<div class="main-wrapper">
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12">
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
											<input type="text" class="form-control" placeholder="Tìm kiếm">
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
			<!-- /Page Content -->
		</div>
		<!-- /Main Wrapper -->
		
		<!-- Voice Call Modal -->
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
</div>
@endsection
@section('js')
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@endsection