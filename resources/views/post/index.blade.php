<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>FashionBlog</title>
        <script src="{{ mix('/js/like.js') }}"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        
        
       
     </head>
     <body>
         
        <div class="blogtitle">
             <h1>FashionBlog</h1>
        </div>
            <div class="row">
                <div class="mypage">
                    <a href='profiles/mypage/' class="btn btn-primary">マイページ</a>
                </div>
                <br>
                <div class="create">
                    <a href='/posts/create' class="btn btn-primary">新規投稿作成</a>
                </div>
                <br>
                <div class="rank">
                    <a href="/posts/rank" class="btn btn-primary">ランキング</a>
                </div>
            </div>
        
        <form action="/search" method="GET">
            @csrf
            <div class="title">
                <h2>検索</h2>
                <p>
                    <select name="select">
                         <option value="name">ユーザー名</option>
                        <option value="tag">タグ</option>
                        <option value="body">本文</option>
                    </select>
                </p>
                <input type="text" name="input"/>
            </div>
            <div class="button" >
                <input class="btn btn-primary w-auto" type="submit" value="検索">
            </div>
        </form>
        <div class='paginate d-flex justify-content-center'>
            {{$posts->links()}}
        </div>
        <div class="posts">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="card col-4 " style="width:18rem">
                            @if (count($post->post_photos) == 2)
                                <img class="card-img-top"src="{{$post->post_photos[0]->image_path}}" alt="Card image cap"> 
                                <div class="card-img-overlay">
                                    <h4 class="card-title"><i class="fas fa-clone" style="text-righ"></i></h4>
                                </div>
                            @else
                                <img class="card-img-top" src="{{$post->post_photos[0]->image_path}}" alt="Card image cap">
                            @endif
                            <div class="card-header"><a href="/profiles/{{$post->user_id}}">{{$post->user->name}}</a></div>
                            <div class="card-body">
                                <div class="tag">
                                    @foreach ($post->tags as $tag)
                                        <span class="badge badge-pill badge-info">{{$tag->name}}</span> 
                                    @endforeach
                                </div>
                                <p class="card-text">{{$post->body}}</p>
                                <div id="like">
                                    @if (Auth::check())
                                        @if ($like_model->like_exist(Auth::id(), $post->id))
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
                            </div>
                            <div class="card-footer">最終更新{{$post->updated_at}}</div>
                            
                    
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