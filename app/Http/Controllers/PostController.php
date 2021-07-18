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

use App\Policies\PostPolicy;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Post $post)
    {
        $like = new Like;
        
        return view('post.index')->with(['like_model'=>$like,'posts'=>$post->getPaginateLimit()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post,PostRequest $request,Tag $tag)
    {
        $input=$request['post.body'];
        $post->user_id=Auth::user()->id;
        $post->body=$input;
        $post->save();
        foreach ($request->file('files') as $file) {
            $post_photo = new PostPhoto;
            $path = Storage::disk('s3')->putFile('posts', $file["photo"], 'public');
            $post_photo->image_path = Storage::disk('s3')->url($path);
            $post_photo->post_id= $post->id;
            $post_photo->save();
        
        }
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);
        $tags=[];
        foreach($match[1] as $tag){
            $record=Tag::firstOrCreate(['name'=>$tag]);
            array_push($tags,$record);
        }
        $tags_id=[];
        foreach($tags as $tag){
            array_push($tags_id,$tag->id);
        }
        $post->tags()->attach($tags_id);
        
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $like = new Like;
         return view('post.show')->with(['like_model'=>$like,'post'=>$post]);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post){
        $user=Auth::user();
        $this->authorize('view', $post);
    
        $value="";
        foreach($post->tags as $tag){
            $text="#".$tag->name;
            $value.=$text;
        }
        return view('post.edit')->with(['post'=>$post,"text"=>$value]);
    }
        
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $user=Auth::user();
        $this->authorize('update', $post);
        
        $post->tags()->detach();
        $input=$request['post.body'];
        $post->body=$input;
        $post->save();
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);
        $tags=[];
        foreach($match[1] as $tag){
            $record=Tag::firstOrCreate(['name'=>$tag]);
            array_push($tags,$record);
        }
        $tags_id=[];
        foreach($tags as $tag){
            array_push($tags_id,$tag->id);
        }
        $post->tags()->attach($tags_id);
        
        return redirect('/posts/'.$post->id);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Post $post)
    {
        $user=Auth::user();
        $this->authorize('delete', $post);
        
        foreach ($post->post_photos->pluck("image_path") as $path) 
            PostPhoto::query()->where('post_id','=',$post->id)->delete();
            foreach($post->tags->pluck("id") as $tag){
                $post->tags()->detach($tag);   
            }
        $post->delete();
        return redirect('/');
    }
    
    
    public function search(Request $request,Post $post)
    {
        $like = new Like;
        if($request->select=="name"){
            $user = new User;
            $input = $request->input;
            $posts = Post::query()->whereHas('user', function ($query) use ($input) {
                $query->where('name', 'LIKE', "%{$input}%");
                })->orderBy('updated_at', 'DESC')->paginate(9);
            return view('post.search')->with(['like_model'=>$like,'posts'=> $posts]);
        }elseif($request->select=="tag"){
            $tag = new Tag;
            $input = $request->input;
            $posts = Post::query()->whereHas('tags', function ($query) use ($input) {
                $query->where('name', 'LIKE', "%{$input}%");
                })->orderBy('updated_at', 'DESC')->paginate(9);
            return view('post.search')->with(['like_model'=>$like,'posts'=> $posts]);
        }else{
            $input = $request->input;
            $query = Post::query();
            $search = $query->Where('body','LIKE',"%{$input}%")->orderBy('updated_at', 'DESC')->paginate(9);
            return view('post.search')->with(['like_model'=>$like,'posts'=> $search]);
            
        }
    }
}

