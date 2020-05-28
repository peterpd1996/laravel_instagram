<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 21px"><b>{{$title}}</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" >
    <ul style="list-style: none;">
        @foreach($users as $user)
        <li class='border_b'>
            <a href='/profile/{{$user->id}}' class='text-dark'>
                <div class='d-flex fix'>
                    <img src='/profiles/{{$user->profile->profileImage()}}'  class='rounded'>
                    <div class='pl-2'>
                        <b>{{$user->username}}</b>
                        <p class='text-dark'>{{$user->name}}</p>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>