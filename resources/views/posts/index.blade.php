@extends('layouts.app')
@section('content')
@include('posts.edit')
{{-- show like modal --}}
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
Launch demo modal
</button> --}}
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Liked</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="showLike">
            </div>
        </div>
    </div>
</div>
{{-- end show like --}}
<!-- confirm delete  -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="delete-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('home.post.delete_message') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal-btn-yes">{{ trans('home.post.delete_confirm') }}</button>
                <button type="button" class="btn btn-default" id="modal-btn-no">{{ trans('home.post.close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- end confirm delete -->
<div class="container pt-4">
    {{-- post --}}
    <div class="row post">
        <div class="col-md-7 border_ mb-5 form-post">
            <form action="/p" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group d-flex pt-2">
                    <label for="caption" class=" col-form-label text-md-right"><img
                        src="/profiles/{{Auth::user()->profile->profileImage()}}" alt="" class="rounded image"></label>
                    <div class="col-md-10">
                        <textarea class="form-control w-100" rows="3" id="caption"
                            class="form-control @error('caption') is-invalid @enderror" name="caption"
                            value="{{ old('caption') }}" autocomplete="caption" autofocus
                            placeholder="{{trans('home.form_post.title')}}">
                        </textarea>
                    </div>
                </div>
                <div class="form-group d-flex ">
                    <div style="position: relative" class="ml-5">
                        <div id="iconUpload" class="iconUpload"> <i class="fa fa-picture-o" aria-hidden="true"></i>{{trans('home.form_post.photo_video')}}</div>
                        <input id="uploadNewPost"  type="file" name="image" id="image"
                            class="uploadNewPost @error('image') is-invalid @enderror" autocomplete="image" autofocus>
                    </div>
                    <button class=" btn btn-default ml-2 post_">{{trans('home.form_post.post')}}</button>
                </div>
                @error('image')
                <span class="invalid-error" role="alert">
                <strong class="ml-5">{{ $message }}</strong>
                </span>
                @enderror
                <div class="col-md-8 ml-5">
                    <img id="img_output"  src="" alt="" class="none border_" style="margin-bottom: 9px;">
                    <video id="video_output" controls class="none" width="100%"></video>
                </div>
            </form>
        </div>
        <div class="col-md-5 " id="suggest_friend">
            <div class="row profile">
                <a href="/profile/5" class="text-dark">
                    <div class="d-flex fix">
                        <img src="/profiles/{{auth()->user()->profile->profileImage()}}" class="rounded">
                        <div class="pl-2">
                            <b>{{ auth()->user()->username}}</b>
                            <p class="text-dark">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                </a>
            </div>
         @if(count($inforUsersSuggest) > 0)
            <div class="suggest">
                <div class="row pb-2">
                    <div class="col-md-7" style="color: gray;font-size: 15px;font-weight: bold;">Suggestions For You</div> 
                </div>
                @foreach($inforUsersSuggest as $user)
                 <div class="row pt-1">
                    <div class="col-md-7">
                    <div class="follow">
                         <a href='/profile/{{$user->profile->id}}' class='text-dark'>
                                    <div class='d-flex'>
                                        <img src='/profiles/{{$user->profile->profileImage()}}'  class='rounded'>
                                        <div class='pl-2'>
                                            <b>{{$user->username}}</b>
                                            <p class='text-dark'>{{ $user->name }}</p>
                                        </div>
                                    </div>
                         </a>
                    </div>
                    </div>
                    <div class="col-md-2">
                         <follow-button userid="{{$user->id }}" follows={{ auth()->user()->isFollow($user->id)}}></follow-button>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        </div>
    </div>
    {{-- end post --}}
    @foreach($posts as $post)
    <div class="row ">
        <div class="col-md-7 mb-5 p-0 border_ ">
            <div>
                <div class="name d-flex align-items-center pt-2 pb-2 pl-2 " style="background-color: #fff">
                    <div>
                        <img src="/profiles/{{$post->user->profile->profileImage()}}" alt=""
                            class="rounded-circle mr-2 image">
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
                                    <span class="edit-post" data-toggle="modal" data-target="#editPost" data-postId="{{$post->id}}">{{ trans('home.post.edit') }}</span>
                                </li>
                                <li>
                                    <span class="icon" style="padding: 0px 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                    <span class="delete-post" data-post-delete="{{$post->id}}">{{ trans('home.post.delete') }}</span>
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
                    <a href="/p/{{$post->id}}"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                    {{--start favorite--}}
                    <span class="favorite fa-pull-right" data-favorite-post="{{$post->id}}" style="cursor: pointer;padding-right:6px"><i id="favorite_{{$post->id}}"  style="color:#949090cf" class="fa fa-bookmark @if(auth()->user()->favorite->contains($post->id)) saved @endif" aria-hidden="true"></i></span>
                    {{--end favorite--}}
                </div>
                {{-- show like --}}
                <b>
                    <div style="cursor: pointer;" class="like pl-2" data-like="{{$post->id}}" id="many_like_{{$post->id}}" data-toggle="modal" data-target="#exampleModalCenter">
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
                    <a href="/p/{{$post->id}}" class="view-all-comment text-color" style="font-size: 14px">{{trans('home.post.view_comment',['comment' => $post->comment->count()])}}</a>
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
                        placeholder="{{trans('home.post.comment')}}" height="30px" data-id="{{$post->id}}">
                    <a style="color:#3897f0;font-weight: bold;cursor: pointer" data-post={{$post->id}} class='post_comment'
                    id="post_{{$post->id}}">{{trans('home.post.post_comment')}}</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div id="alert_popover">
        <div class="wrapper">
            <div id="notification_{{auth()->user()->id}}" class="noti_check">
                {{--         
                <a href="/p/5" class="text-dark">
                    <div class="alert_default border_ alert">
                        <div href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-left:23px;cursor: pointer;">&times;</div>
                        <div class="d-flex">
                            <div><img class="rounded-circle pr-1 image" src="/profiles/image.png"></div>
                            <div>
                                <div><strong class="pr-1">DungManh</strong>comment your post</div>
                            </div>
                        </div>
                    </div>
                </a>
                --}}
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
$('.noti_check').bind('DOMSubtreeModified', function(){
   setTimeout(function(){
        $('.noti_check').remove();
   },5000);
});

</script>

@endsection