<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
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
}
