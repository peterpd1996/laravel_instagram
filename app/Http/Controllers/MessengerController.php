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
        $id = auth()->user()->id;
    	$users_id = auth()->user()->following()->pluck('profiles.user_id')->toArray();
        $lastText = Message::where('from',$id)->latest()->take(1)->first(); // lay tin nhan cuoi cung cua mk gui cho ai
        $users_id = array_diff($users_id,[$lastText->to]); // get user mk nhan tin cuoi cung
        $userText = User::find($lastText->to);
        $users = User::WhereIn('id',$users_id)->get();
    	$messages = Message::getMesssage($id,$lastText->to);
    	return view('messages.index',compact('users','userText','messages'));
    }
    public function loadMessage(Request $request)
    {
    	$toUser = $request->toUser;
        $userText = User::find($toUser);
    	$messages = Message::getMesssage(auth()->user()->id,$toUser);
    	return view('messages.chat_content',compact('messages','userText'));
    	
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
