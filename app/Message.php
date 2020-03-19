<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user()
    {
        return $this->belongsTo(User::Class);
    }
    public static function getMesssage($fromUser,$toUser){
        return Message::where([['from','=',$fromUser],['to','=', $toUser]])
    						->orWhere([['to','=',$fromUser],['from','=', $toUser]])->get();
    }
}
