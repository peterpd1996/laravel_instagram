<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostFavouriteController extends Controller
{
    public function store(Request $request)
    {
        //  auth()->user()->favorite->toArray() get post I saved
        try {
            $post_id = $request->input('post_id');
            $status =  auth()->user()->favorite()->toggle($post_id);
            return response()->json([
                'code' => 200,
                'data' => $status
            ],200);
        } catch ( \Exception $e) {
            return response()->json([
                'code' => 500
            ],200);
        }
    }

    public function getPostSaved()
    {
        $postsSaved = auth()->user()->favorite->toArray();
        return response()->json([
            'code' => 200,
            'data' => $postsSaved,
        ],200);
    }
}
