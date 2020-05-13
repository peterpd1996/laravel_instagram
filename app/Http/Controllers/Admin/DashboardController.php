<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $count_post=Post::count();
        $count_user=User::count();
        $data=[
            'count_post' => $count_post,
            'count_user'=>$count_user

        ];
        return view('admin.dashboard',$data);
    }
}
