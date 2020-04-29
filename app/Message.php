<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $guarded = [];
	const UN_READ = 0;
	const READ = 1;
    public function user()
    {
        return $this->belongsTo(User::Class);
    }
    public static function getMesssage($fromUser,$toUser){
        return Message::where([['from','=',$fromUser],['to','=', $toUser]])
            ->orWhere([['to','=',$fromUser],['from','=', $toUser]])->get();
    }
    public static function updateMessageUnread($fromUser,$toUser)
    {
        Message::where([
            ['from','=',$fromUser],
            ['to','=', $toUser],
            ['is_read','=',Message::UN_READ]
        ])->update(['is_read'=>Message::READ]);

    }

}
