<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $totalPost=Post::count();
        $totalUser=User::count();
        $totalMonthInYear = [];
        $totalPostInWeek = [];
        $totalUserInYear = [];
        $totalUserInWeek = [];
        for($day = 1; $day <= 7; $day++)
        {
        	$totalPostInDay = Post::whereDay('created_at', $day)->count('id');
        	$totalUserInDay = User::whereDay('created_at', $day)->count('id');
        	$nameDay = $day + 1;
        	if($day < 7) {
        		$dataPost = [
	        	 'name'=>'Thứ '.$nameDay,
		         'y'=>$totalPostInDay,
		         'drilldown'=>'Thứ '.$nameDay
	        	];
	        	$dataUser = [
	        	 'name'=>'Thứ '.$nameDay,
		         'y'=>$totalUserInDay,
		         'drilldown'=>'Thứ '.$nameDay
	        	];
        	} else {
        		$dataPost = [
	        	 'name'=>'Chủ nhật',
		         'y'=>$totalPostInDay,
		         'drilldown'=>'Chủ nhật'
	        	];
	        	$dataUser = [
	        	 'name'=>'Chủ nhật',
		         'y'=>$totalUserInDay,
		         'drilldown'=>'Chủ nhật'
	        	];
        	}
        	
	        $totalPostInWeek[] = $dataPost;
	        $totalUserInWeek[] = $dataUser;
        }
        for($month = 1; $month <=  12; $month ++) 
        {
	        $totalPostMonth = Post::whereMonth('created_at', $month)->count('id');
	        $data = [
	        	 'name'=>'Tháng '.$month,
		          'y'=>$totalPostMonth,
		          'drilldown'=>'tháng '.$month
	        ];
	        $totalMonthInYear[] = $data;
        }
 
        $totalMonthInYear = json_encode($totalMonthInYear);
        $totalPostInWeek = json_encode($totalPostInWeek);
        $totalUserInWeek = json_encode($totalUserInWeek);
        $totalUserCreateInDay = User::whereMonth('created_at', date('m'))->count('id');
        $totalUserCreateInMonth = User::whereMonth('created_at', date('m'))->count('id');
        return view('admin.dashboard',compact('totalPost','totalUser', 'totalMonthInYear', 'totalPostInWeek', 'totalUserInWeek'));
    }
}
