@extends('layouts.app')
@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col-sm-7 p-0 ">
            <!-- image post -->
               @if(pathinfo($post->image, PATHINFO_EXTENSION) != 'mp4')
                <img src="/uploads/{{$post->image}}" class="img-fluid w-100 border-img" id="image-post-{{$post->id}}">
                @else
                <video width="100%" height="600" controls style="background:black">
                  <source src="/videos/{{$post->image}}" type="video/mp4">
                Your browser does not support the video tag.
                </video>
                @endif
                <!-- end image or video post -->
        </div>
        <div class="p-0 border_ col-sm-4 " style="background: #fff;position: relative">
            <div class="name d-flex p-3 align-items-center border_b">
                <div>
                    <img src="/profiles/{{$post->user->profile->profileImage()}}" width="40px" height="40px" alt=""
                        class="rounded-circle mr-2 img-thumbnail ">
                </div>
                <div class="font-weight-bold">
                    <a href="/profile/{{$post->user->id}}" class="text-dark text-decoration-none">
                        {{$post->user->username}}
                    </a>
                </div>
            </div>
            <div class="cmt" style="height: 500px;overflow:auto">
                <p class="p-3 m-0">
                    <span class="font-weight-bold">
                        <a class="text-dark text-decoration-none" href="/profile/{{$post->user->id}}">
                            {{$post->user->username}}
                        </a>
                    </span>
                    <span>{{$post->caption}}</span>
                    <span class="text-color" style="display: block;">{{ getTimeDistance($post->created_at) }}</span>
                </p>
                <div class="comment pl-3" id="commentHeight">
                    <ul style="list-style: none">
                        @php
                        $comments = $post->comment;
                        @endphp
                        @foreach($comments as $comment)
                        <li>
                            <b>
                                <a href="/profile/{{$comment->user->id}}"
                                    class="text-dark">{{$comment->user->username}}
                                </a>
                            </b>
                            <span>{{$comment->comment}}</span>
                            <div class="text-color">{{ getTimeDistance($comment->created_at) }}</div>
                        </li>
                        @endforeach
                        <div id="comment{{$post->id}}"></div>
                    </ul>
                </div>
            </div>
            <div class="w-100" style="position: absolute;bottom: 0px;background: white;position: absolute;bottom: 0px">
                <div class="icon p-3 border_b border_t">
                    <div class="icon">
                        <i data-like_post="{{$post->id}}" id="like_{{$post->id}}"
                            class="fa fa-heart like_heart @if(auth()->user()->like->contains($post->id)) liked @endif"
                            aria-hidden="true"></i>
                        <a href=""><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                    </div>
                    <b>
                        <div class="like pl-1"  id="many_like_{{$post->id}}" style="cursor: pointer">
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
                </div>
                <div class=" p-2 d-flex w-100" >
                    <input id="comment_{{$post->id}}" type="text" class="w-100 comment" style="border: none" placeholder="Add a comment.."
                        height="30px" autofocus data-id="{{$post->id}}">
                        <a style="color:#3897f0;font-weight: bold;cursor: pointer" data-post={{$post->id}}
                            id="post_{{$post->id}}" class='post_comment'>Post</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
