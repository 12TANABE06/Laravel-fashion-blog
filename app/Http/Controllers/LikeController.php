<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

use App\Post;

use App\User;

use Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $id = Auth::id();
        $like=Like::where('posts_id',$post)->where('user_id',$user->id)->first();
        if($like->like_exist($id,$post->id)){
           $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        }else{
            $like = new Like;
            $like->post_id = $post->post_id;
            $like->user_id = $id;
            $like->save();
        }
        $postLikesCount = $post->loadCount('likes')->likes_count;

        return response()->json($postLikesCount); 
    }
}
