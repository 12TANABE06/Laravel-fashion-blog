<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostPhoto extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'image_path'
    ]; 
    
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
