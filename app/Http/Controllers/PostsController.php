<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // lấy những user mà user đăng nhập hiện tại đang following
        $users_id = auth()->user()->following()->pluck('profiles.user_id')->toArray();
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
    public function store()
    {

        $data =  request()->validate([
            'caption' => '',
            'image' => ['required','image'],
        ]);
      
        $file = request()->file('image');
        $image = $file->getClientOriginalName();
        $file->move('uploads',$image);
        $imageResize = Image::make("uploads/{$image}")->resize(600,600);
        $imageResize->save();
       
        // để lây cả user_id thông qua thằng user này có thể thông qua thằng post này để tạo
    //    $test =  auth()->user()->posts()->create([
    //         'caption' => $data['caption'],
    //         'image' => $image
    //     ]);
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->caption = $data['caption'] ?? '';
        $post->image = $image;
        $post->save();
        return redirect("/");   
    }
    public function show(\App\Post $post) 
    /* hoặc mình có thể truyền tham số trực tiếp kiểu 
    show(\App\Post $post) nếu không có né cũng trả về page not found
    thì không cần phải fileOrFaild nữa lúc này thằng post nó là một dối tượng luôn 
    không cần phải find nữa
    */
    {
        // nếu ở trên truyền như kia thì mình k cần find nữa
        //$post =  Post::findOrFail($post);
        return view('posts.show',compact('post'));
    }
}
