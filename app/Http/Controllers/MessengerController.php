<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;

class MessengerController extends Controller
{
    public function index()
    {
    	$users_id = auth()->user()->following()->pluck('profiles.user_id')->toArray();
    	$users = User::WhereIn('id',$users_id)->get();
    	$messages = Message::getMesssage(auth()->user()->id,1);
    	return view('messages.index',compact('users','messages'));
    }
    public function loadMessage(Request $request)
    {
    	$toUser = $request->toUser;
        $user = User::find($toUser);
    	$messages = Message::getMesssage(auth()->user()->id,$toUser);
    	return view('messages.chat_content',compact('messages','user'));
    	
    }
    public function storeMessage(Request $request)
    {
        $fromUser = auth()->user()->id;
        $toUser = (int)$request->toUser;
        $message = $request->message;
        Message::create([
            'from' => $fromUser,
            'to' => $toUser,
            'message' => $message,
            'is_read' => Message::UN_READ, 
        ]);
        event(new NewMessage($fromUser,$toUser,$message));
    }
}
