<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BlockController extends Controller
{
   public function index()
   {
   	  $timeBlock = User::find(auth()->user()->id)->time_block;
   	  return view('block.index',compact('timeBlock'));
   }
}
