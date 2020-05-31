<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = 1;
    const BLOCK = 1;

    const FOLLOW = 3;
    const FOLLOWING = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany(Post::Class)->orderBy('created_at','DESC');
    }
    public function profile()
    {
       return $this->hasOne(Profile::Class);
    }
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
    public function isFollow($user_id)
    {
        return (auth()->user()) ? auth()->user()->following->contains($user_id) : false;
    }
    public function like()
    {
           return $this->belongsToMany(Post::class);
    }
    public function checkLiked($id)
    {
        return auth()->user()->like->contains($id);
    }
    public function message()
    {
        return $this->hasMany(Message::Class);
    }
    public function favorite()
    {
        return $this->belongsToMany('App\Post', 'post_user_favorite_post');
    }
    public function countMessageUnread($fromUser, $toUser)
    {
       $count =  Message::where([
            ['from', $fromUser],
            ['to', $toUser],
            ['is_read', Message::UN_READ]
        ])->count();
       return $count > 0 ? $count : null;
    }
    public static function getLastMessageWithUser($fromUser, $toUser)
    {
       $lastMessage =  Message::where([
        ['from','=',$fromUser],
        ['to','=', $toUser]])
        ->orWhere([
            ['to','=',$fromUser],
            ['from','=', $toUser]
        ])->latest()->limit(1)->get();
       return $lastMessage[0]->message ?? trans('message.say_hi');
    }

    public static function getFollower( $profileId) 
    {
        $userIds = Db::table('profile_user')->where('profile_id', $profileId)->pluck('user_id')->toArray();
        return User::whereIn('id',$userIds)->with('profile')->get();
    }
    public static function getFollowing ($userId)
    {
        $userIds = User::find($userId)->following()->pluck('profiles.user_id')->toArray();
        return User::whereIn('id',$userIds)->with('profile')->get();
    }

}
