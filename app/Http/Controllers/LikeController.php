<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

use App\Post;

use App\User;

use Auth;

class LikeController extends Controller
{
     public function index($user_id)
    {
        $like = new Like;
        $post = new Post;
        $user = User::where("id", $user_id)->first();
        $post = $user->likes()->orderBy('updated_at', 'DESC')->paginate(9);
        return view('like.index')->with(['like_model'=>$like, 'posts'=>$post]);
    }
    public function store(Request $request)
    {
        dd("a");
        $like = new Like;
        $user_id = Auth::id();
        $post_id = $request->post_id;
        if ($like->like_exist($user_id, $post_id)) {
            
            Like::where('user_id', $user_id)->where('post_id', $post_id)->delete();
        }else{
            $like = new Like;
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        }
        $post = Post::find($post_id);
        $postLikesCount = $post->likes->count();
        
            
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        
        return response()->json($json);
    
}
    
}
