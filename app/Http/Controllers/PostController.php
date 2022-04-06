<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostPhoto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use App\Tag;
use App\Like;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;



class PostController extends Controller
{
    
    public function index(Post $post)
    {
        $like = new Like;
        
        return view('post.index')->with(['like_model'=>$like, 'posts'=>$post->getPaginateLimit()]);
    }

   
    public function create()
    {
        return view('post.create');
        
    }

    
    public function store(Post $post, PostRequest $request, Tag $tag)
    {
        
        $input = $request['post.body'];
        $post->user_id = Auth::id();
        $post->body = $input;
        $post->save();
        
        
        
        foreach ($request->file('files') as $file) {
            $post_photo = new PostPhoto;
            $file_path_image = '/thumbnail';
            $file_path = storage_path('app'.$file_path_image);
            
            $img = Image::make($file["photo"]);
            $img->limitColors(null);
            
            $img->encode('webp');
            $img->save($file_path);
            
            $upload_info = Storage::disk('s3')->putFile('posts',new File($file_path), 'public');
            $path = Storage::disk('s3')->url($upload_info);
            
             
            $post_photo->post_id = $post->id;
            $post_photo->image_path = $path;
            $post_photo->save();
           
            Storage::disk('local')->delete($file_path_image); 
        }
        
        
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name'=>$tag]);
            array_push($tags, $record);
        }
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag->id);
        }
        $post->tags()->attach($tags_id);
        
        return redirect('/');
        
    }

    public function show(Post $post)
    {
        $like = new Like;
        
        return view('post.show')->with(['like_model'=>$like, 'post'=>$post]);
    }

    public function edit(Post $post) 
    {
        $user = Auth::user();
        $this->authorize('update', $post);
    
        $value = "";
        foreach ($post->tags as $tag) {
            $text = "#".$tag->name;
            $value .= $text;
        }
       
        return view('post.edit')->with(['post'=>$post, "tags"=>$value]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $user = Auth::user();
        $this->authorize('update', $post);
        
        $input = $request['post.body'];
        $post->body = $input;
        $post->save();
        
        $post->tags()->detach();
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name'=>$tag]);
            array_push($tags, $record);
        }
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag->id);
        }
        $post->tags()->attach($tags_id);
        
        return redirect('/posts/'.$post->id);
    
    }

    public function destroy(Post $post)
    {
        $user = Auth::user();
        $this->authorize('delete', $post);
        
        foreach ($post->post_photos->pluck("image_path") as $path) {
            Storage::disk('s3')->delete(parse_url($path, PHP_URL_PATH));
            PostPhoto::query()->where('post_id', '=',$post->id)->delete();
           
        }
       
        foreach ($post->tags->pluck("id") as $tag) {
                $post->tags()->detach($tag);   
            }
        $post->delete();
        
        return redirect('/');
    }
    
    
    public function search(Request $request, Post $post)
    {
        $like = new Like;
        
        if ($request->select == "name") {
            $user = new User;
            $input = $request->input;
            $posts = Post::whereHas('user', function ($query) use ($input) {
                $query->where('name', 'LIKE', "%{$input}%");
                })->orderBy('updated_at', 'DESC')->paginate(9);
                
            return view('post.search')->with(['like_model'=>$like, 'posts'=> $posts]);
            
        }elseif($request->select == "tag") {
            $tag = new Tag;
            $input = $request->input;
            $posts = Post::whereHas('tags', function ($query) use ($input) {
                $query->where('name', 'LIKE', "%{$input}%");
                })->orderBy('updated_at', 'DESC')->paginate(9);
                
            return view('post.search')->with(['like_model'=>$like, 'posts'=> $posts]);
            
        }else{
            $input = $request->input;
            $search = Post::Where('body', 'LIKE', "%{$input}%")->orderBy('updated_at', 'DESC')->paginate(9);
            
            return view('post.search')->with(['like_model'=>$like, 'posts'=> $search]);
            
        }
    }
    
    public function rank(Post $post)
    {
        $like = new Like;
        $posts = Post::withCount('likes')->orderBy('likes_count', 'desc')->paginate(9);
        
        return view('post.rank')->with(['like_model'=>$like, 'posts'=>$posts]);//
    }
}

