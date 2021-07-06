<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FashionBlog</title>

        <!-- Fonts -->
        <link href="index.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="back"><a href="/">戻る</a></div>
        <div class="name">
           <h1>検索結果</h1>
        </div>
       -------------------
       @foreach($posts as $post)
            <div class="user_name">
                <a href="/profiles/{{$post->user->id}}"><h3>{{$post->user->name}}</h3></a>
            </div>
            <div class="photo" style="display:inline">
                @foreach($post->post_photos->pluck("image_path") as $image_path)
                    <a href="/posts/{{$post->id}}"><img src="{{$image_path}}"></a>  
                @endforeach
            </div>
            <div class="tag">
                @foreach($post->tags as $tag)
                    <span class="badge badge-pill badge-info">{{$tag->name}}</span> 
                @endforeach
            </div>
            <div class="body">
                <h3>{{$post->body}}</p>
            </div>    
        @endforeach
            <div class='paginate'>
                {{$posts->links()}}
            </div>
    </body>
</html>
@endsection