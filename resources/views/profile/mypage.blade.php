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
        @if($profile==Null)
            <h1>プロフィールが作成されていません</h1>
            <a href='/profiles/create'><h2>[プロフィール作成]</h2></a>
            <a href='/likes/{{Auth::id()}}'>「いいねした投稿」</a>
            <div class="posts">
                <a href="/posts/create"><h2>[新規投稿作成]</h2></a>
                @foreach($posts as $post)
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
        @else
            @if($profile->image_path!=null)
                <div class="setting" style="display:inline">
                    <div class="update">
                        <a href='/profiles/{{$profile->id}}/edit'>プロフィールの編集</a>
                    </div>
                    <div class="user_name">
                        <h3>{{$profile->user->name}}</h3>
                    </div>
                    <div class="profile">
                        <div class="photo">
                            <label>プロフィール画像</label>
                            <img src="{{$profile->image_path}}">     
                        </div>    
                        <div class="body">
                            <label>自己紹介</label>
                            <h3>{{$profile->body}}</p>
                        </div>
                    </div>
                </div>
                <a href='/likes/{{Auth::id()}}'>「いいねした投稿」</a>
                <div class="posts">
                    @foreach($posts as $post)
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
            @else
                <div class="setting" style="display:inline">
                    <div class="update">
                        <a href='/profiles/{{$profile->id}}/edit'>プロフィールの編集</a>
                    </div>
                    <div class="user_name">
                        <h3>{{$profile->user->name}}</h3>
                    </div>
                    <div class="profile">
                        <div class="photo">
                            <label>プロフィール画像がありません</label>
                        </div>    
                        <div class="body">
                            <label>自己紹介</label>
                            <h3>{{$profile->body}}</p>
                        </div>
                    </div>
                </div>
                <a href='/likes/{{Auth::id()}}'>「いいねした投稿」</a>
                <div class="posts">
                    @foreach($posts as $post)
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
        @endif
        <div class='paginate'>
                 {{$posts->links()}}
            </div>
    </body>
</html>
@endsection