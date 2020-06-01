<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    //
    public function index()
    {
       $users  =  User::where('id','!=',auth()->user()->id)->get();
       return view('follows.index',compact('users'));
    }
    public function store(User $user)
    {
        auth()->user()->following()->toggle($user->profile->id);
        echo $user->profile->followers->count();
    }

    public function showFollower(Request $request)
    {
        $title = trans('profile.follower');
        $users = User::getFollower($request->profileId);
        return view('follows.show', compact('users','title'));
    }

    public function showFollowing(Request $request)
    {
        $title = trans('profile.following');
        $users = User::getFollowing($request->userId);
        return view('follows.show', compact('users','title'));
    }
}
