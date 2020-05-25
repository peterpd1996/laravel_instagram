<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Events\NotifiLikeAndComment;

class LikeController extends Controller
{
    
    public function store(Request $request)
    {
        $postId = $request->input('post_id');
        $username = auth()->user()->username;
        $post = Post::find($postId);
        $toUser = $post->user->id;
        $userId = auth()->user()->id;
        $like = auth()->user()->like()->toggle($postId);
        if (count($like["attached"]) != 0 && $userId != $toUser) {
        	event(new NotifiLikeAndComment(auth()->user()->profile->profileImage() ,$username, "liked", $postId, $toUser)); 
        } 
        $likes = $post->liked()->count();
        return $likes;
 	}
}
