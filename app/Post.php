<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];// everything is ok in the fild databases
    // // protected $fillable = [
    //     'caption','image', 'user_id',
    // ];
    public function user()
    {
        return $this->belongsTo(User::Class);
    }
    public function comment()
    {
            return $this->hasMany(Comment::Class);  
    }
    public function liked()
    {
        return $this->belongsToMany(User::class);
    }
  

   
}
