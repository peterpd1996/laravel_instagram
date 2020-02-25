<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function searchUser(Request $request)
    {
        $user = $request->input('user');
        $users = User::where('username','like','%'.$user.'%')
                     ->orWhere('name','like','%'.$user.'%')->get();
        $result = "Không tìm thấy user nào";
        foreach($users as $user)
        {
            $result.="  
              <li class='border_b'>
                <a href='/profile/{$user->id}' class='text-dark'>
                    <div class='d-flex fix'>
                        <img src='/profiles/{$user->profile->profileImage()}'  class='rounded'>
                        <div class='pl-2'>
                            <b>{$user->username}</b>
                            <p class='text-dark'>{$user->name}</p>
                        </div>
                    </div>
                </a>
             </li> ";
        }
        echo $result;
    }
}
