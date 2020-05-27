@foreach($users as $user)
<div class="row pt-1">
    <div class="col-md-9">
        <div class="follow">
            <a href='' class='text-dark'>
                <div class='d-flex'>
                    <img src='/profiles/{{ $user->profile->profileImage() }}'  class='rounded'>
                    <div class='pl-2'>
            <a class="text-dark" href="/profile/{{$user->id}}"><b>{{ $user->username }}</b></a>
            <p class='text-dark'><i aria-hidden="true" class="fa fa-heart like_heart  liked "></i></p>
            </div>
            </div>
            </a>
        </div>
    </div>
    <div class="col-md-2">
        <follow-button userid="{{$user->id }}" follows={{ auth()->user()->isFollow($user->id)}}>
        </follow-button>
    </div>
</div>
@endforeach
