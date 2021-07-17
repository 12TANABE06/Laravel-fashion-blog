<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>FashionBlog</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{{ mix('/js/like.js') }}"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
       

       
     </head>
     <body>
         
        <div class="blogtitle">
             <h1>FashionBlog</h1>
        </div>
            <div class="mypage">
                <a href='profiles/mypage/'>マイページ</a>
            </div>
        <div class="create">
            <a href='/posts/create'>新規投稿作成</a>
        </div>
        <form action="/posts/search" method="GET">
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
                <input type="text" name="input" placeholder="タイトル"/>
            </div>
            <div class="button">
                <input type="submit" value="検索">
            </div>
        </form>
        
        <div class="posts">
            <div class="container">
                <div class="row">
            @foreach($posts as $post)
            <div class="card" style="width:18rem">
                @foreach($post->post_photos->pluck("image_path") as $image_path)
                    <a href="/posts/{{$post->id}}"><img class="card-img-top"src="{{$image_path}}"alt="Card image cap"></a>  
                @endforeach
                <h5 class="card-title">{{$post->user->name}}</h5>
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
                </div>
                    
            </div>
            @endforeach
            </div>
        </div>
               
             <div class='paginate'>
                 {{$posts->links()}}
            </div>
     
     </body>

</html>
@endsection