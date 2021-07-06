<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FashionBlog</title>
        <link href="index.css" rel="stylesheet" type="text/css">

       
    </head>
    <body>
        <div class="setting" style="display:inline">
            <div class="update">
                <a href='/posts/{{$post->id}}/edit'>編集</a>
            </div>
            <form action='/posts/{{$post->id}}/delete', method="POST" style="display:inline" id="button">
                @csrf
                @method('DELETE')
                <input type="submit" onclick="return delet()" value="削除"/>
            </form>
        <div class="user_name">
                    <a href="/profiles/{{$post->user->id}}"><h3>{{$post->user->name}}</h3></a>
        </div>
        <div class="post">
            <div class="photo">
                @foreach($post->post_photos->pluck("image_path") as $image_path)
                
                    <img src="{{$image_path}}">     
                @endforeach
            </di>
            <div class="tag">
                @foreach($post->tags as $tag)
                    <span class="badge badge-pill badge-info">{{$tag->name}}</span> 
                @endforeach
            </div>
            <div class="body">
                <h3>{{$post->body}}</p>
            </div>
        </div>
        
        <div class="back"><a href="/">戻る</a></div>
        
        <script>
            function delet(){
                if(confirm("削除してもよろしいですか？")){
                    
                document.getElementById("button").submit();
                }
                else{
                    return false;
                    
                }
              
       }
       </script>
    </body>
</html>
@endsection