<?php

namespace App\Http\Controllers;

use App\Profile;

use App\Post;

use App\Like;

use App\User;

use App\Http\Requests\ProfileRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Policies\PostPolicy;

class ProfileController extends Controller
{
     public function show($user_id)
    {
        $like = new Like;
        $post = new Post;
        $user = User::find($user_id);
        $profile = Profile::where('user_id',$user_id)->first();
        $post = Post::where('user_id',$user_id)->orderBy('updated_at', 'DESC')->paginate(9);
        return view('profile.show')->with([
            'profile'=>$profile,
            'user'=>$user,
            'posts'=>$post,
            'like_model'=>$like]);
    }
    
    public function myshow()
    {
        $like = new Like;
        $user = Auth::user();
        $post = new Post;
        $profile = Profile::where('user_id',$user->id)->first();
        $post = Post::where('user_id',$user->id)->orderBy('updated_at', 'DESC')->paginate(9);
        return view('profile.mypage')->with([
            'profile'=>$profile,
            'posts'=>$post,
            'user'=>$user,
            'like_model'=>$like]);
        
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
            
        return redirect('/profiles/mypage');
        
    }
    
    public function edit(Profile $profile)
    {
        $user=Auth::user();
        $this->authorize('view', $profile);
        
        return view('profile.edit')->with(['profile'=>$profile]);
    }
    
     public function update(ProfileRequest $request, Profile $profile)
    {
        $user=Auth::user();
        $this->authorize('update', $profile);
        
        $input_name=$request['user.name'];
        $user = User::find($profile->user_id);
        $user->name=$input_name;
        $user->save();
        $input_body=$request['profile.body'];
        $profile->body=$input_body;
        if($request['profile.image_path']==null){
             $profile->save();
        }else{
            $path = Storage::disk('s3')->putFile('profiles', $request["profile.image_path"], 'public');
            $profile->image_path = Storage::disk('s3')->url($path);
            $profile->save();
            }
        
        return redirect('/profiles/mypage');
    
    }
    
    public function destroy(Profile $profile,Request $request)
    {
        $user=Auth::user();
        $this->authorize('delete', $profile);
        
        Storage::disk('s3')->delete(parse_url($profile->image_path,PHP_URL_PATH));
        $profile->image_path=null;
        $profile->save();
        
        return redirect('/profiles/'.$profile->id.'/edit');
    }
    
}
