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
        @if($profile)
            <a href='/profiles/create'>作成</a>
        @else($profile->id != null)
            <div class="setting" style="display:inline">
                <div class="update">
                    <a href='/profiles/{{$profile->id}}/edit'>編集</a>
                </div>
                <div class="user_name">
                    <h3>{{$profile->user->name}}</h3>
                </div>
                <div class="post">
                    <div class="photo">
                        <label>プロフィール画像</label>
                        <img src="{{$profile->image_path}}">     
                    </di>    
                <div class="body">
                    <label>自己紹介</label>
                    <h3>{{$profile->body}}</p>
                </div>
            </div>
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
                    <div class="body">
                        <h3>{{$post->body}}</p>
                    </div>    
                @endforeach
            </div>
        @endif
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