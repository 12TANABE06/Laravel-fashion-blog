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
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;



class ProfileController extends Controller
{
     public function show($user_id)
    {
        $like = new Like;
        $user = User::find($user_id);
        $profile = $user->profile;
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
        $profile = $user->profile;
        $post = Post::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->paginate(9);
        return view('profile.mypage')->with([
            'profile'=>$profile,
            'posts'=>$post,
            'user'=>$user,
            'like_model'=>$like]);
        
    }
    
    public function create()
    {
        return view('profile.create');
    
    }
     
    public function store(Profile $profile, ProfileRequest $request)
    {
        $input = $request['profile.body'];
        $profile->user_id = Auth::id();
        $profile->body = $input;
         if($request['profile.image_path'] == null) {
             $profile->save();
        }else{
            $file_path_image = '/thumbnail';
            $file_path = storage_path('app'.$file_path_image);
            
            $img = Image::make($request["profile.image_path"]);
            $img->limitColors(null);
            
            $img->encode('webp');
            $img->save($file_path);
            
            $upload_info = Storage::disk('s3')->putFile('profiles',new File($file_path), 'public');
            $path = Storage::disk('s3')->url($upload_info);
            $profile->image_path = $path;
            $profile->save();
            }
            
        return redirect('/profiles/mypage');
        
    }
    
    public function edit(Profile $profile)
    {
        
        $loginUser = Auth::user();
        if($loginUser->id === $profile->user_id) {
            return view('profile.edit')->with(['profile'=>$profile]);
        }else{
            return redirect('/');
        }
        
    }
    
     public function update(ProfileRequest $request, Profile $profile)
    {
        $loginUser = Auth::user();
        if ($loginUser->id === $profile->user_id) {
            $input_name = $request['user.name'];
            $user = User::find($profile->user_id);
            $user->name=$input_name;
            $user->save();
            $input_body = $request['profile.body'];
            $profile->body = $input_body;
           
            if(file_exists($request['profile.image_path'])) {
                $file_path_image = '/thumbnail';
                $file_path = storage_path('app'.$file_path_image);
                 
                $img = Image::make($request["profile.image_path"]);
                $img->limitColors(null);
                
                $img->encode('webp');
                $img->save($file_path);
                
                $upload_info = Storage::disk('s3')->putFile('profiles',new File($file_path), 'public');
                $path = Storage::disk('s3')->url($upload_info);
                $profile->image_path = $path;
                $profile->save();
                
            }else{
                $profile->save();
                }
        
            return redirect('/profiles/mypage');
        }else{
            return redirect('/');
        }
        
    
    }
    
    public function destroy(Profile $profile, Request $request)
    {
        $loginUser=Auth::user();
        if ($loginUser->id === $profile->user_id) {
            Storage::disk('s3')->delete(parse_url($profile->image_path, PHP_URL_PATH));
            $profile->image_path = null;
            $profile->save();
        
            return redirect('/profiles/mypage');
        }else{
            return redirect('/');
        }
        
    }
    
}
