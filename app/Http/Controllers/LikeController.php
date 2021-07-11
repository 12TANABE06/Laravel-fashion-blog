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
        $user = User::where("id",$user_id)->first();
        $like = Like::Where('user_id',$user_id)->get();
        $post = $user->like->count();
        dd($post);
        $post = $post->withCount('like')->orderBy('updated_at', 'DESC')->paginate(5);
        dd($post);
      
        return view('like.index')->with(['like_model'=>$like,'posts'=>$post]);
    }
    public function store(Request $request)
    {
        $like = new Like;
        $user_id=Auth::user()->id;
        $post_id=$request->post_id;
        if($like->like_exist($user_id,$post_id)){
            
            Like::where('user_id', $user_id)->where('post_id', $post_id)->delete();
        }else{
            $like = new Like;
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        }
        $post = Post::find($post_id);
        $postLikesCount = Post::withCount('like')->findOrFail($post_id)->like_count;
        
            
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        
        return response()->json($json);
    
}
    
}
