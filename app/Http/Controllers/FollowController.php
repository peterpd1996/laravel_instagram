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
        $title = "Follower"; 
        $profileId = $request->profileId;
        $userIds = Db::table('profile_user')->where('profile_id', $profileId)->pluck('user_id')->toArray();
        $users = User::whereIn('id',$userIds)->with('profile')->get();
        return view('follows.show', compact('users','title'));
    }

    public function showFollowing()
    {
        $title = "Following"; 
        $profileId = $request->profileId;
        $userIds = Db::table('profile_user')->where('profile_id', $profileId)->pluck('user_id')->toArray();
        $users = User::whereIn('id',$userIds)->with('profile')->get();
        return view('follows.show', compact('users','title'));
    }
}
