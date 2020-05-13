<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountAdminController extends Controller
{
    public function  index(){
//        $users=User::with('profile')->paginate('15');
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*', 'profiles.profileImage', 'profiles.url','profiles.description')
            ->get();
        return view('admin.account',compact('users'));
    }
}
