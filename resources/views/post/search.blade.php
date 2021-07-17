<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FashionBlog</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{{ mix('/js/like.js') }}"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet" type="text/css">

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
            <div id="like">
                @if(Auth::check())
                    @if($like_model->like_exist(Auth::user()->id,$post->id))
                        <p class="favorite-marke">
                            <a class="js-like-toggle loved" href='' data-postid="{{ $post->id }}"><i class="fas fa-heart">いいね</i></a>
                            <span class="likesCount">{{$post->likes->count()}}</span>
                        </p>
                    @else
                        <p class="favorite-marke">
                            <a class="js-like-toggle" href='' data-postid="{{ $post->id }}"><i class="fas fa-heart" >いいね</i></a>
                            <span class="likesCount">{{$post->likes->count()}}</span>
                        </p>
                    @endif​
                @else
                    <p class="favorite-marke">
                        <i class="fas fa-heart">いいね</i>
                        <span class="likesCount">{{$post->likes->count()}}</span>
                    </p>
                @endif
            </div>
        @endforeach
            <div class='paginate'>
                {{$posts->links()}}
            </div>
    </body>
</html>
@endsection