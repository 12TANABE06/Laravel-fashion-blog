<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    
 protected $fillable = [
        'image_path',
        'body'
    ];
    
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
