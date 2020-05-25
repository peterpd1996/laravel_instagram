<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccountAdminController extends Controller
{
    public function  index(){
//        $users=User::with('profile')->paginate('15');
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('admin.account',compact('users'));
    }
    public function blockUser(Request $request)
    {
    	$user = User::find($request->userId);
    	if($user->is_block)
    	{
    		return false;
    	}
    	$message =  $user->update(
    			[
    			  'is_block' => 1,
    			  'time_block' => Carbon::now()->addDays($request->timeBlock),
    			]
    		);
    	$users = User::where('id', '!=', auth()->user()->id)->get();
    	return view('admin.tableAcount',compact('users'));
    }
    public function unBlock(Request $request) {
    	$user = User::find($request->userId);
    	$user->update(['is_block' => 0]);
    	$users = User::where('id', '!=', auth()->user()->id)->get();
    	return view('admin.tableAcount',compact('users'));
    }
}
