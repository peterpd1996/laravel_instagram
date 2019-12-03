<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comment;
use App\Post;
use App\User;
class NotificationsController extends Controller
{
    public function show(Request $request)
    {
        $user_id = auth()->user()->id;
        $post_id = auth()->user()->posts->pluck('id');  // lấy id post những bài mình đăng

        

    

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
                    $notif .="   
                        <li class='border_b'>
                            <a  href='/p/{$cmt->post_id}' class='text-dark'>
                                <div class='d-flex fix'>
                                <img src='/profiles/{$cmt->user->profile->profileImage()}'  class='rounded'>
                                    <b class='pl-2 pt-2'>{$cmt->user->username}</b>
                                    <div class='notificmt'>commented on your photo:{$cmt->subComment($cmt->comment)}</div>
                                    <img class='mr-2 w-img' src='/uploads/{$post->image}'>
                                    
                                </div>  
                            </a>
                        </li>        
                ";
                }
            }
        
           

            $likes = DB::table('post_user')->whereIn('post_id',$post_id)->where('user_id','!=',$user_id)->orderBy('id','DESC')->get();
            if($likes->count() > 0)
            {
                foreach($likes as $like)
                {
                    $user = User::find($like->user_id);
                    $post = Post::find($like->post_id);
                    $notif .="
                    <li class='border_b'>
                        <a href='/p/{$cmt->post_id}' class='text-dark'>
                        <div class='d-flex fix align-items-center'>
                            <img src='/profiles/{$user->profile->profileImage()}'  class='rounded'>
                            <b class='pl-2'>{$user->username}</b>
                            <div class='pl-1'>liked your photo</div>
                            <div style='margin-left: 168px'>
                                <img src='/uploads/{$post->image}' class='w-img'>
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
