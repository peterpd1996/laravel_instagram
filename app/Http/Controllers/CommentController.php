<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Events\NewComment;
use App\Events\NotifiLikeAndComment;
class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $postId = $request->input('post_id');
        $comment = $request->input('comment');
        $username = auth()->user()->username;
        $toUser = Post::find($postId)->user->id;
        Comment::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'comment' => $comment,
        ]);
        $comment = "<li>
                        <b>
                            <a href='/profile/{$userId}' class='text-dark'>".auth()->user()->username."</a>
                        </b> ".$comment.
                        "<div class='text-color font-time'>".getTimeDistance(date("Y-m-d H:i:s"))."</div>".
                    "</li>";

        event(new NewComment($comment,$postId));
        if($userId != $toUser) { // check khong phai tu minh comment bai biet cua minh thi khong can thong bao
            event(new NotifiLikeAndComment(auth()->user()->profile->profileImage() ,$username, "commented on", $postId, $toUser)); 
        }
       
    }
    public function fetch(Request $request)
    {
        $postId = $request->input('post_id');
        $comments = Post::find($postId)->comment;
        $cmt = '';      
        foreach($comments as $comment)
        {
            $cmt.=" <li><b><a href='/profile/{$comment->user->id}' class='text-dark'>{$comment->user->username}</a></b> {$comment->comment}</li>";
        }
        echo $cmt;

    }
}
