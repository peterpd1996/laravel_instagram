<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Images;
use Intervention\Image\Facades\Image;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use Images;
    public function index()
    {
        // lấy những user đã follow mình mà mình chưa follow lại 
        // lấy a follow b, b follow c => gợi ý cho a follow c;
        $id = auth()->user()->id;
        $usersFollowing = auth()->user()->following()->pluck('profiles.user_id')->toArray();
        if($usersFollowing == null)
        {
            return redirect()->route('follow');
        }
        $userFollower = User::getFollower(auth()->user()->profile->id);
        $usersSuggest = array_diff($userFollower->pluck('id')->toArray(), $usersFollowing);
        if(count($usersSuggest) < 5 )
        {
            // get user follow của những người mình đã follow tính chất bắc cầu;
            $moreUserFollower = DB::table('profile_user')
                                ->whereIn('user_id', $usersFollowing)
                                ->where('profile_id', '!=', $id)
                                ->pluck('profile_id')->toArray();
            $moreUserFollower = array_diff($moreUserFollower, $usersFollowing);
            $newSuggest = array_merge($usersSuggest, $moreUserFollower);
            $usersSuggest = array_unique($newSuggest);            
        }
        if(count($usersSuggest) < 5) 
        {
            // lay nhung user ngoai user suggest
            $notInListUserFollowedAndSuggest = array_merge($usersSuggest, $usersFollowing, [$id]);
            $newSuggest = User::whereNotIn('id', $notInListUserFollowedAndSuggest)->pluck('id')->toArray();
            $usersSuggest = array_merge($usersSuggest, $newSuggest);
        }
        $inforUsersSuggest = User::whereIn('id',$usersSuggest)->with('profile')->get();
        array_push($usersFollowing, $id);
        $posts = Post::WhereIn('user_id',$usersFollowing)->latest()->get();
        return view('posts.index',compact('posts', 'inforUsersSuggest'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function edit(Post $post)
    {
        return response()->json([
            'id' => $post->id,
            'image' => $post->image,
            'caption' =>  $post->caption,
        ]);
    }
    public function store(Request $request)
    {
        $data =  request()->validate([
            'image' => 'required|mimes:jpeg,png,bmp,gif,svg,mp4,qt|max:15000',
            'caption' => '',
        ],
        [
            'image.max' => 'The image or video may not be greater than 15 MB.'
        ]);
        $image = $this->uploadImage(request()->file('image'));
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->caption = $data['caption'] ?? '.';
        $post->image = $image;
        $post->save();
        return redirect("/");
    }
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }
    public function update(Request $request)
    {
        $dataPost = $request->only('caption');
        $isChangeImage = 0;
        $post = Post::findOrFail($request->post_id);
        if ($request->hasFile('image')) {
            $isChangeImage = 1;
            $this->deleteImage($post->image);
            $imgName = $this->uploadImage($request->file('image'));
            $dataPost['image'] = $imgName;
        }
        $post->update($dataPost);
        $dataPost['id'] = $request->post_id;
        $dataPost['isChangeImage'] = $isChangeImage;
        return response()->json($dataPost);
    }
    public function delete(Request $request)
    {
       $post = Post::findOrFail($request->post_id);
       $this->deleteImage($post->image);
       $post->delete();
    }
            
}
