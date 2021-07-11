<?php

namespace App\Http\Controllers;

use App\Profile;

use App\Post;

use App\User;

use App\Http\Requests\ProfileRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
     public function show($user_id)
     {
        $post = new Post;
        $profile = Profile::where('user_id',$user_id)->first();
        $post = Post::where('user_id',$user_id)->paginate(5);
        return view('profile.show')->with([
            'profile'=>$profile,
            'posts'=>$post]);
    }
    
    public function mypage_show($user_id)
    {
        
        $post = new Post;
        $profile = Profile::where('user_id',$user_id)->first();
        $post = Post::where('user_id',$user_id)->paginate(5);
        return view('profile.mypage')->with([
            'profile'=>$profile,
            'posts'=>$post]);
    }
     public function create()
    {
        return view('profile.create');
        //
    }
     
     public function store(Profile $profile,ProfileRequest $request)
    {
        $input=$request['profile.body'];
        $profile->user_id=Auth::user()->id;
        $profile->body=$input;
         if($request['profile.image_path']==null){
             $profile->save();
        }else{
            $path = Storage::disk('s3')->putFile('profiles', $request["profile.image_path"], 'public');
            $profile->image_path = Storage::disk('s3')->url($path);
            $profile->save();
            }
            
        return redirect('/profiles/'.$profile->user_id);
        
    }
    
    public function edit(Profile $profile)
    {
        return view('profile.edit')->with(['profile'=>$profile]);
    }
    
     public function update(ProfileRequest $request, Profile $profile)
    {

        $input=$request['profile.body'];
        $profile->body=$input;
        if($request['profile.image_path']==null){
             $profile->save();
        }else{
            $path = Storage::disk('s3')->putFile('profiles', $request["profile.image_path"], 'public');
            $profile->image_path = Storage::disk('s3')->url($path);
            $profile->save();
            }
        
        return redirect('/profiles/'.$profile->user_id);
    
    }
    
    public function destroy(Profile $profile,Request $request)
    {
        Storage::disk('s3')->delete(parse_url($profile->image_path,PHP_URL_PATH));
        $profile->image_path=null;
        $profile->save();
        return redirect('/profiles/'.$profile->user_id);
    }
    
}
