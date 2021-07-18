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
        <div class="back"><a href="/" class="btn btn-primary">戻る</a></div>
        <div class="name">
           <h1>検索結果</h1>
        </div>
       -------------------
        <div class='paginate d-flex justify-content-center'>
            {{$posts->links()}}
        </div>
        <div class="posts">
            <div class="container-fluid">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="card col-4 " style="width:18rem">
                            @if(count($post->post_photos)==2)
                                <a href="/posts/{{$post->id}}"><img class="card-img-top h-100" src="{{$post->post_photos[0]->image_path}}"alt="Card image cap"></a> 
                                <div class="card-img-overlay">
                                    <h4 class="card-title"><i class="fas fa-clone" style="text-righ"></i></h4>
                                </div>
                            @else
                                <a href="/posts/{{$post->id}}"><img class="card-img-top h-100" src="{{$post->post_photos[0]->image_path}}"alt="Card image cap"></a>
                            @endif
                            <div class="card-header">{{$post->user->name}}</div>
                            <div class="card-body">
                            <div class="tag">
                                @foreach($post->tags as $tag)
                                    <span class="badge badge-pill badge-info">{{$tag->name}}</span> 
                                @endforeach
                            </div>
                            <p class="card-text">{{$post->body}}</p>
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
                            <a href="/posts/{{$post->id}}" class="btn btn-primary">詳細</a>
                            <div class="card-footer">最終更新{{$post->updated_at}}</div>
                            </div>
                    
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class='paginate d-flex justify-content-center'>
            {{$posts->links()}}
        </div>
    </body>
</html>
@endsection