@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ml-4" >
        <div class="col-md-3 p-5">
            <img style="width: 180px;height: 180px" class="rounded-circle" src="/profiles/{{$user->profile->profileImage() ?? 'st.jpg'}}" alt="">
        </div>
        
        <div class="col-md-9  p-5">
            <div class=" d-flex justify-content-between">
                <div class="pr-3 d-flex align-items-center" style="font-size: 30px;font-weight: 100">
                    
                                <div class="h4 mr-3 pt-2">  {{ $user->username }} </div>
                            <div id='app' class="pb-2">
                                @cannot('update',$user->profile)
                                
                                        <follow-button userid={{$user->id}} follows={{$follow}}></follow-button>
                                
                                @endcannot
                            </div>

                
                    
                    {{-- xem ở thằng policies/ProfilePolicy --}}
                        @can('update',$user->profile)
                            <a title="Edit profile" href="/profile/{{$user->id}}/edit" style="font-size: 22px;color: #6c6967b8;" >
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </a>
                        @endcan
                        

                </div>
                   
              @can('update',$user->profile)
                {{-- nếu đúng profile của mình thì nó mới hiển thị --}}
                     <a title="Add new post"  href="/p/create" class="btn btn-primary">Add new post</a>
              @endcan
               
            </div>
            <div class="d-flex pb-4">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
            <div class="pr-5"><strong>{{$user->profile->followers->count()}}</strong> followers</div>
            <div><strong>{{$user->following->count()}}</strong> following</div>
                
            </div>
            <div class="name"><h4>{{ $user->name ?? ''}}</h4></div>
           <div class="title">{{ $user->profile->title ?? ''  }}</div>
          <div class="description">{{ $user->profile->description ?? ''}}</div>
        <div><a href="{{$user->profile->url}}">{{ $user->profile->url ?? 'N/A' }}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
         
                <div class="col-4 mb-4"  >
                    <a href="/p/{{$post->id}}">
                         <img src="/uploads/{{ $post->image }}" alt="" class="w-100">
                    </a>
                </div>
         
        @endforeach
    </div>
</div>
@endsection
