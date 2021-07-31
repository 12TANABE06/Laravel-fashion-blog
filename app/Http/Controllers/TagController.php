<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

use App\Post;

class TagController extends Controller
{
    /*public function addition(Request $request, Post $post,Tag $tag)
    {
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
    
    }*/
    
    /*public function destroy(Tag $tag)
    {
        
        $post->tags()->detach($tag);   
        return redirect('/posts/'.$post->id.'/edit');
    }*/
}
