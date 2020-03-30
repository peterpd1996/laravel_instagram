<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;

class MessengerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userText = null;
        $messages = [];
        $id = auth()->user()->id;
    	$users_id = auth()->user()->following()->pluck('profiles.user_id')->toArray();
        $lastText = Message::where('from',$id)->latest()->take(1)->first(); // lay tin nhan cuoi cung cua mk gui cho ai
        if($lastText){
            $users_id = array_diff($users_id,[$lastText->to]);
            $userText = User::find($lastText->to); // get user mk nhan tin cuoi cung
            $messages = Message::getMesssage($id,$lastText->to);
        }
        $users = User::WhereIn('id',$users_id)->get();
    	return view('messages.index',compact('users','userText','messages'));
    }
    public function loadMessage(Request $request)
    {
        if($request->unread !== null){
            Message::updateMessageUnread($request->toUser, auth()->user()->id);
        }
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
