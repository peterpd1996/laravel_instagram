<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comment;
use App\Post;
use App\User;
class NotificationController extends Controller
{
    public function show(Request $request)
    {
        $user_id = auth()->user()->id;
        $post_id = auth()->user()->posts->pluck('id');  // lấy id post những bài mình đăng
        // láy tất cả các comment bài mình đăng và không lấy những cmt của mình
        $commentUnRead = Comment::whereIn('post_id',$post_id)->where('user_id','!=',$user_id)->orderBy('id','DESC')->get();   // lấy comment những bài mình đăng chưa xem và k phải mình bình luận chính bài của mình
            if($request->input('stt') != '')
            {
                // update lại những cmt đó
                 Comment::whereIn('post_id',$post_id)->update(['status'=>'1']);
                 DB::table('post_user')->whereIn('post_id',$post_id)->update(['status'=>'1']);
            }
            $notif = "";
            if($commentUnRead->count() > 0)
            {
                foreach ($commentUnRead as $cmt) {
                    $post = Post::find($cmt->post_id);
                    $image = getImage($post->image);
                    $message = trans('notification.commented',['comment' => $cmt->subComment($cmt->comment)]);
                    $notif .="   
                           <li class='border_b'>
                                <a href='/p/{$post->id}' class='text-dark'>
                                    <div class='d-flex fix align-items-center'>
                                        <img src='/profiles/{$cmt->user->profile->profileImage()}'  class='rounded'>
                                        <span class='ml-2 userLikeOrCmt'><b>{$cmt->user->username} </b>{$message}</span>
                                            {$image} 
                                    </div>
                                </a>
                            </li>     
                ";
                }
            }
 // láy tất cả các like bài mình đăng và không lấy những like của mình
            $likes = DB::table('post_user')->whereIn('post_id',$post_id)->where('user_id','!=',$user_id)->orderBy('id','DESC')->get();
            if($likes->count() > 0)
            {
                foreach($likes as $like)
                {
                    $user = User::find($like->user_id);
                    $post = Post::find($like->post_id);
                    $image = getImage($post->image);
                    $message = trans('notification.liked');
                    $notif .="
                  <li class='border_b'>
                                <a href='/p/{$post->id}' class='text-dark'>
                                    <div class='d-flex fix align-items-center'>
                                        <img src='/profiles/{$user->profile->profileImage()}' class='rounded'>
                                        <span class='ml-2 userLikeOrCmt'><b>{$user->username} </b>{$message}</span>
                                        <div class='imageLikeOrCmt'>
                                             {$image}
                                        </div>
                                    </div>
                                </a>
                            </li>
                    " ;
                }
            }
            // đếm những bài post của mình bao nhiêu like
            $countLikesUnSeen = DB::table('post_user')->whereIn('post_id',$post_id)->where([
                ['user_id','!=',$user_id],
                ['status','=','0']
            ])->count();
            $countCommentUnRead = Comment::whereIn('post_id',$post_id)->where([
                ['user_id','!=',$user_id],
                ['status','=','0']
            ])->count();
            $data = ['notification' => $notif,
                     'unseen_total' => $countLikesUnSeen + $countCommentUnRead
            ];
            echo json_encode($data); 
    }
}
