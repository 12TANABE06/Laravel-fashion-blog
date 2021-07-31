<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'use_id',
        'image_path',
        'body'
    ]; //
    public function getPaginateLimit(int $limit_count = 9)
   {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
   }
   public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function post_photos()
    {
        return $this->hasMany('App\PostPhoto',"post_id");
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
     public function likes()
    {
        return $this->belongsToMany('App\User',"likes");
    }
}

