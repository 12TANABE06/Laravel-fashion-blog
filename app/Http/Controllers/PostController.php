<?php

namespace App\Http\Controllers;

use App\Post;

use App\PostPhoto;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
      
        return view('post.index')->with(['posts'=>$post->getPaginateLimit()]);
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
    public function store(Post $post,PostRequest $request)
    {
        $input=$request['post.body'];
        $post->user_id=Auth::user()->id;
        $post->body=$input;
        $post->save();
        foreach ($request->file('files') as $file) {
            $post_photo = new PostPhoto;
            $path = Storage::disk('s3')->putFile('blog', $file["photo"], 'public');
            $post_photo->image_path = Storage::disk('s3')->url($path);
            $post_photo->post_id= $post->id;
            $post_photo->save();
            
         }
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
         return view('post.show')->with(['post'=>$post]);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit')->with(['post'=>$post]);;
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

        $input=$request['post.body'];
        $post->body=$input;
        $post->save();
        
        return redirect('/posts/'.$post->id);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Post $post,Request $request)
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