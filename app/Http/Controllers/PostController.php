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
                })->orderBy('updated_at', 'DESC')->paginate(5);
            return view('post.search')->with(['like_model'=>$like,'posts'=> $posts]);
        }elseif($request->select=="tag"){
            $tag = new Tag;
            $input = $request->input;
            $posts = Post::query()->whereHas('tags', function ($query) use ($input) {
                $query->where('name', 'LIKE', "%{$input}%");
                })->orderBy('updated_at', 'DESC')->paginate(5);
            return view('post.search')->with(['like_model'=>$like,'posts'=> $posts]);
        }else{
            $input = $request->input;
            $query = Post::query();
            $search = $query->Where('body','LIKE',"%{$input}%")->orderBy('updated_at', 'DESC')->paginate(5);
            return view('post.search')->with(['like_model'=>$like,'posts'=> $search]);
            
        }
    }
}

/*@if(count($post->post_photos)==2)
                    <div class="container"> 
                        <div id="carouselExampleControls" class="carousel slide"　data-ride="false" data-warp="true" data-touch="false" data-interval="false" >
                            <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a href="/posts/{{$post->id}}"><img class="d-block w-100 card-img-top" alt="First slide"src="{{$post->post_photos[0]->image_path}}"></a>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="/posts/{{$post->id}}"><img class="d-block w-100 card-img-top" alt="Second slide"src="{{$post->post_photos[1]->image_path}}"></a>
                                    </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="botton" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">前に戻る</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="botton" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">次に進む</span>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="container"> 
                        <a href="/posts/{{$post->id}}"><img class="d-block w-100 card-img-top" alt="First slide"src="{{$post->post_photos[0]->image_path}}"></a>
                    </div>
                @endif*/