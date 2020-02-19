<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id','post_id', 'comment',
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::Class);
    }
    public function subComment($comment)
    {
        $cmt = strlen($comment) > 24 ? substr( $comment, 0, 23) : $comment;
        return " \"".$cmt."..\" ";
    }
    public function getTowLatestComment()
    {
        if(Comment::count() > 2)
            return $this->comment::orderBy('id', 'desc')->take(2)->get();
        return 0;    
    }

    
}
