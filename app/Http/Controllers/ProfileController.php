<?php

namespace App\Http\Controllers;

use App\Profile;

use App\Post;

use App\Http\Requests\ProfileRequest;

use Illuminate\Support\Facades\Storage;



use Illuminate\Http\Request;

class ProfileController extends Controller
{
     public function show($user_id)
    {
        $profile = Profile::where('user_id',$user_id)->get();
    
        
        return view('profile.show')->with(['profile'=>$profile]);//
    }
    
     public function create()
    {
        return view('profike.create');
        //
    }
    
    public function edit(Profile $profile)
    {
        return view('edit')->with(['profile'=>$profile]);;
    }
    
     /*public function update(PostRequest $request, Post $post)
    {

        $input=$request['post.body'];
        $post->body=$input;
        $post->save();
        
        return redirect('/posts/'.$post->id);
    
    }*/
    
    public function destroy(Profile $profile,Request $request)
    {
        foreach ($post->post_photos->pluck("image_path") as $path) {
            //dd($path);
            Storage::disk('s3')->delete(parse_url($path,PHP_URL_PATH));
            }
        PostPhoto::query()->where('post_id','=',$post->id)->delete();
        $post->delete();
        return redirect('/');
    }
    
}
