
									<div class="chat-header">
										<a id="back_user_list" href="javascript:void(0)" class="back-user-list">
											<i class="fa fa-chevron-left" aria-hidden="true"></i>
										</a>
										<div class="media">
											<div class="media-img-wrap">
												<div class="avatar avatar-online">
													<img src="/profiles/{{ $user->profile->profileImage() }}" alt="User Image" class="avatar-img rounded-circle">
												</div>
											</div>
											<div class="media-body">
												<div class="user-name">{{ $user->username }}</div>
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
												@foreach($messages as $message)
												<li class="media {{(auth()->user()->id == $message->from) ? 'sent' : 'received'}}">
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p>{{$message->message}}</p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>{{ getTimeFormat($message->created_at) }}</span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												@endforeach
												<div id="xinchaocacban"></div>
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
											<input type="text" class="input-msg-send form-control" placeholder="Type something" 
											  id="input_message">
											<div class="input-group-append" >
												<button type="button" class="btn msg-send-btn" id="sent_message"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>
								