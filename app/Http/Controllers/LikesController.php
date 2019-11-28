<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class LikesController extends Controller
{
    //
    public function store(Request $request)
    {
        $post_id = $request->input('post_id');
        auth()->user()->like()->toggle($post_id);

        $post = Post::find($post_id);
        $likes = $post->liked()->count();
        echo $likes;
        
        
        
    }
}
