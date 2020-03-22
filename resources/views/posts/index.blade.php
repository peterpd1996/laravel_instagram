@extends('layouts.app')
@section('content')
@include('posts.edit')
<!-- confirm delete  -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="delete-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Are you sure ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="modal-btn-yes">Yes</button>
        <button type="button" class="btn btn-default" id="modal-btn-no">No</button>
      </div>
    </div>
  </div>
</div>
<!-- end confirm delete -->
<div class="container pt-4">
    {{-- post --}}
    <div class="row post">
        <div class="col-md-6 offset-md-3  border_ mb-5" style="background: #fff">
            <form action="/p" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group d-flex pt-2">
                    <label for="caption" class=" col-form-label text-md-right"><img
                            src="/profiles/{{Auth::user()->profile->profileImage()}}" alt="" class="rounded"></label>
                    <div class="col-md-10">
                        <textarea class="form-control w-100" rows="3" id="caption"
                            class="form-control @error('caption') is-invalid @enderror" name="caption"
                            value="{{ old('caption') }}" autocomplete="caption" autofocus
                            placeholder="What's on your mind ???">
                        </textarea>
                    </div>
                </div>
                <div class="form-group d-flex ">
                    <div style="position: relative" class="ml-5">
                        <div id="iconUpload" class="iconUpload"> <i class="fa fa-picture-o" aria-hidden="true"></i> Photo/Video</div>
                        <input id="uploadNewPost"  type="file" name="image" id="image"
                            class="uploadNewPost @error('image') is-invalid @enderror" autocomplete="image" autofocus>
                        @error('image')
                        <span class="invalid-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button class=" btn btn-default ml-2">Post</button>
                </div>
                <div class="col-md-8 ml-5">
                    <img id="img_output"  src="" alt="" width="100px" height="100px" class="none border_" style="margin-bottom: 9px;">
                    <video id="video_output" controls class="none" width="100%"></video>
                </div>
            </form>
        </div>
    </div>
    {{-- end post --}}
    @foreach($posts as $post)
    <div class="row ">
        <div class="col-md-6 mb-5 p-0 border_ offset-md-3">
            <div>
                <div class="name d-flex align-items-center pt-2 pb-2 pl-2 " style="background-color: #fff">
                    <div>
                        <img src="/profiles/{{$post->user->profile->profileImage()}}" width="40px" height="40px" alt=""
                            class="rounded-circle mr-2">
                    </div>
                    <div class="font-weight-bold">
                        <a href="/profile/{{$post->user->id}}" class="text-dark text-decoration-none">
                            {{$post->user->username}}
                        </a>
                    </div>
                    <div class="text-right w-100" style="font-size: 10px;position: relative;">
                        @if(Auth::user()->id == $post->user->id)
                        <i class="fa fa-ellipsis-h post-action" style="padding: 6px;color: #00000082;cursor: pointer;position: absolute;right: 0px;top: -17px;" aria-hidden="true" id="action-post-{{$post->id}}"></i>
                        @endif
                        <div class="action_ none" style="z-index: 100">
                            <ul style="list-style: none;text-align: left;font-size: 15px;">
                                <li>
                                    <span class="icon" style="padding: 0px 5px;"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    <span class="edit-post" data-toggle="modal" data-target="#editPost" data-postId="{{$post->id}}">Edit post</button>
                                </li>
                                <li>
                                    <span class="icon" style="padding: 0px 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                    <span class="delete-post" data-post-delete="{{$post->id}}">Delete post</spann>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- image or video -->
        <a href="/p/{{$post->id}}" id="post-{{$post->id}}">
                @if(pathinfo($post->image, PATHINFO_EXTENSION) != 'mp4')
                <img src="/uploads/{{$post->image}}" class="img-fluid" id="image-post-{{$post->id}}">
                @else
                <video width="100%" height="600" controls style="background: black">
                  <source src="/videos/{{$post->image}}" type="video/mp4">
                </video>
                @endif
            </a>
            <!-- end image or video -->
            {{--  like --}}
            <div class="pt-3" style="background-color: #fff" style="overflow: auto">
                <div class="icon pl-2">
                    <i data-like_post="{{$post->id}}" id="like_{{$post->id}}"
                        class="fa fa-heart like_heart @if(auth()->user()->like->contains($post->id)) liked @endif"
                        aria-hidden="true"></i>
                    <a href=""><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                </div>
                {{-- show like --}}
                <b>
                    <div class="like pl-2" id="many_like_{{$post->id}}">
                        @php
                        $like = $post->liked->count();
                        if( $like == 0) {
                            $like ='' ;
                        }
                        else if($like == 1){
                             $like .=' like';
                        }
                        else {
                            $like .= ' likes';
                        }
                        echo $like;
                        @endphp
                    </div>
                </b>
                {{-- end show like --}}
                <span class=" pl-2">
                    <a class="text-dark text-decoration-none" href="/profile/{{$post->user->id}}">
                        <b> {{$post->user->username}} </b>
                    </a>
                    <span id="caption-post-{{$post->id}}">{{$post->caption}}</span>
                </span>
                <div class="comment pl-2">
                    @if($post->comment->count() > 2 )
                        <a href="/p/{{$post->id}}" class="view-all-comment text-color" style="font-size: 14px">View all {{ $post->comment->count() }} comments</a>
                    @endif
                    <ul style="list-style: none">
                        @foreach($post->getTowLatestComment() as $comment)
                            <li><b><a href='/profile/{{$comment->user->id}}'
                                        class="text-dark">{{$comment->user->username}}</a></b> {{$comment->comment}}
                            </li>
                        @endforeach
                         <div id="comment{{$post->id}}"></div>
                    </ul>
                </div>
                <div class="time pl-2 text-color" style="font-size: 11.7px;text-transform: uppercase;">{{ getTimeDistance($post->created_at) }}</div>
                <div class=" p-2 d-flex border_t" id="comment">
                    <input id="comment_{{$post->id}}" type="text" class="postCmt w-100 comment" style="border: none;"
                        placeholder="Add a comment.." height="30px" data-id="{{$post->id}}">
                    <a style="color:#3897f0;font-weight: bold;cursor: pointer" data-post={{$post->id}} class='post_comment'
                        id="post_{{$post->id}}">Post</a>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>
@endsection
@section('script')
@endsection
