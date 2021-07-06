<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
          'posts_id','user_id','like'
     ];
     public function like_exist($id, $post_id)
    {
        $exist = Like::where('user_id', '=', $id)->where('post_id', '=', $post_id)->get();
        if (!$exist->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }
     
     public function user()
    {
        return $this->belongsTo('App\User');
    }
     public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
