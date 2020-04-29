@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-6 border_ offset-md-3 mt-5" style="background: white">
          <div class="text-dark" style="padding: 7px; font-size: 18px; font-style: italic;">Suggest for you </div>
            @foreach($users as $user)
            <div class="row pt-1">
            <div class="col-md-9">
              <div class="follow">
                 <a href='' class='text-dark'>
                            <div class='d-flex'>
                                <img src='/profiles/{{ $user->profile->profileImage() }}'  class='rounded'>
                                <div class='pl-2'>
                                    <b>{{ $user->username }}</b>
                                    <p class='text-dark'>Recommend for you</p>
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
    </div>
</div>
@endsection
@section('script')
@endsection
