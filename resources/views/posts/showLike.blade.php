    <ul style="list-style: none;">
        @foreach($users as $user)
        <li class='border_b'>
            <a href='/profile/{{$user->id}}' class='text-dark'>
                <div class='d-flex fix'>
                    <img src='/profiles/{{$user->profile->profileImage()}}'  class='rounded'>
                    <div class='pl-2'>
                        <b>{{$user->username}}</b>
                        <p class='text-dark'><i aria-hidden="true" class="fa fa-heart like_heart  liked "></i></p>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
