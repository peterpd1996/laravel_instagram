<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
        'title','description', 'user_id', 'url','profileImage'
    ];
    public function user()
    {
       return $this->belongsTo(User::class);
    }
    public function followers()
    {
    
         return $this->belongsToMany(User::class);
       
    }
    public function profileImage()
    {
        return $this->profileImage ? $this->profileImage : 'image.png';
    }
}
