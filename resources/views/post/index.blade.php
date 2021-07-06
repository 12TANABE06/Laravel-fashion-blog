<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>FashionBlog</title>

        //<link href="index.css" rel="stylesheet" type="text/css">
        
       

       
     </head>
     <body>
        <div class="blogtitle">
             <h1>FashionBlog</h1>
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
                    <button @click="favorite()">いいね</button>
                    <p>いいね数</p>
                </div>
            @endforeach
             <div class='paginate'>
                 {{$posts->links()}}
            </div>
            <script src="{{ mix('js/like.js') }}"></script>
     </body>
</html>
@endsection