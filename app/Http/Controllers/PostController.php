<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Images;
use Intervention\Image\Facades\Image;
use App\Post;
use App\User;
use Carbon\Carbon;

class PostController extends Controller
{
    use Images;
    public function index()
    {
        // lấy những user mà user đăng nhập hiện tại đang following
        $users_id = auth()->user()->following()->pluck('profiles.user_id')->toArray();
        if($users_id == null)
        {
            return redirect()->route('follow');
        }
        array_push($users_id,auth()->user()->id);

        // pluck là phương thức mình lấy ra một cột nào đó
        //vd $name = DB::table('users')->where('name', 'John')->pluck('name'); chỉ lấy ra cột name
        // select profiles.user_id
        // from profiles inner join profile_user on profiles.id = profile_user.profile_id
        // where profile_user.user_id = 1    auth()->user()->id
        $posts = Post::WhereIn('user_id',$users_id)->latest()->get();
        // orderBy('created_at','DESC') = latest()
        return view('posts.index',compact('posts'));
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
