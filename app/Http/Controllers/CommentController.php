<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Events\NewComment;
class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $post_id = $request->input('post_id');
        $comment = $request->input('comment');
        Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $comment,
        ]);
        $comment = "<li>
                        <b>
                            <a href='/profile/{$user_id}' class='text-dark'>".auth()->user()->username."</a>
                        </b> ".$comment.
                        "<div class='text-color'>".getTimeDistance(date("Y-m-d H:i:s"))."</div>".
                    "</li>";
        event(new NewComment($comment,$post_id)); 
    }
    public function fetch(Request $request)
    {
        $post_id = $request->input('post_id');
        $comments = Post::find($post_id)->comment;
        $cmt = '';      
        foreach($comments as $comment)
        {
            $cmt.=" <li><b><a href='/profile/{$comment->user->id}' class='text-dark'>{$comment->user->username}</a></b> {$comment->comment}</li>";
        }
        echo $cmt;

    }
}
