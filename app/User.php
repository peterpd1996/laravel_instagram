<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password',
    ];

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
    public function like()
    {
           return $this->belongsToMany(Post::class);  
    }
    public function checkLiked($id)
    {
        
        return auth()->user()->like->contains($id);
    }
    
}
