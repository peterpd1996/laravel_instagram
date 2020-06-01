@extends('layouts.app')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="showFollow">

    </div>
  </div>
</div>
<div class="container">
    <div class="row border_b">
        <div class="col-md-3 p-5">
            <img style="width: 180px;height: 180px" class="rounded-circle"
                src="/profiles/{{$user->profile->profileImage() ?? 'st.jpg'}}" alt="">
        </div>
        <div class="col-md-9 p-5">
            <div class=" d-flex justify-content-between">
                <div class="pr-3 d-flex align-items-center" style="font-size: 30px;font-weight: 100">

                    <div class="h4 mr-3 pt-2"> {{ $user->username }} </div>
                    <div id='app' class="pb-2">
                        @cannot('update',$user->profile)
                        <follow-button userid={{$user->id}} follows={{$follow}}></follow-button>
                        @endcannot
                    </div>
                    {{-- xem ở thằng policies/ProfilePolicy --}}
                    @can('update',$user->profile)
                    <a title="Edit profile" href="/profile/{{$user->id}}/edit"
                        style="font-size: 22px;color: #6c6967b8;">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="d-flex pb-4">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong>{{trans('profile.post')}}</div>
                <div id="follower" data-profile="{{$user->profile->id}}"  class="pr-5" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal"><strong id="followCount">{{$user->profile->followers->count()}}</strong>
                    {{trans('profile.follower')}}</div>
                <div id="following" data-user="{{$user->id}}" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal"><strong>{{$user->following->count()}}</strong>{{trans('profile.following')}}</div>
            </div>
            <div class="name">
                <h4>{{ $user->name ?? ''}}</h4>
            </div>
            <div class="title">{{ $user->profile->title ?? ''  }}</div>
            <div class="description">{{ $user->profile->description ?? ''}}</div>
            <div><a href="{{$user->profile->url}}">{{ $user->profile->url ?? 'N/A' }}</a></div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 tab-pane">
                <ul class="nav nav-tabs" style="width: 387px" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" data-toggle="tab" href="#tabs-1" role="tab"><i class="fa fa-table pr-2"></i>{{trans('profile.post')}}</a>
                    </li>
                    @can('view',$user->profile)
                    <li class="nav-item">
                        <a class="nav-link text-uppercase " data-toggle="tab" href="#tabs-2" role="tab"><i class=" fa fa-bookmark pr-2"></i>{{trans('profile.saved')}}</a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"><i class="fa fa-hashtag pr-2"></i>HASHTAG</a>
                    </li>
                </ul><!-- Tab panes -->
            </div>
    </div>
       <div class="tab-content">
            <div class=" tab-pane active" id="tabs-1" role="tabpanel">
                <div class="row">
                    @foreach($user->posts as $post)
                        <div class="col-lg-4 col-sm-6 mb-4" >
                            <a href="/p/{{$post->id}}">
                                @if(pathinfo($post->image, PATHINFO_EXTENSION) != 'mp4')
                                    <img src="/uploads/{{$post->image}}" class="image_profile img-thumbnail" id="image-post-{{$post->id}}">
                                @else
                                    <video width="100%" height="350px" controls style="background: black">
                                        <source src="/videos/{{$post->image}}" type="video/mp4">
                                    </video>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane" id="tabs-2" role="tabpanel">

                <div class="row">
                    <!--The best if statement of bananas I've ever written :))-->
                    @if($saved==[])
                        <p>{{trans('profile.message_saved')}}</p>
                    @endif
                        @foreach($saved as $save)
                            <div class="col-4 mb-4" >
                                <a href="/p/{{$save['id']}}">
                                    @if(pathinfo($save['image'], PATHINFO_EXTENSION) != 'mp4')
                                        <img src="/uploads/{{$save['image']}}" class="img-thumbnail image_profile" id="image-post-{{$save['id']}}">
                                    @else
                                        <video width="100%" height="350px" controls style="background: black">
                                            <source src="/videos/{{$save['image']}}" type="video/mp4">
                                        </video>
                                    @endif
                                </a>
                            </div>
                        @endforeach


                </div>
            </div>
            <div class="tab-pane" id="tabs-3" role="tabpanel">
                <p>Hashtag .....</p>
            </div>
        </div>
    </div>

</div>
@endsection
