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
       
    </head>
    <body>
        @if ($profile==Null)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{$user->name}}のページ</div>
                    </div>
                </div>
            </div>
        </div>
        @else
            @if ($profile->image_path != null)
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{$user->name}}</div>
                                <div class="photo">
                                    <label>プロフィール画像</label>
                                    <img class="d-block w-100 card-img-top rounded-circle" alt="First slide" src="{{$profile->image_path}}">
                                </div>    
                                <div class="card-body">
                                    <div class="body">
                                        <p class="card-text">自己紹介<br>{{$profile->body}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
             @else
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{$user->name}}</div>
                                <div class="photo">
                                    <labe>プロフィール画像がありません</label>
                                </div>    
                                <div class="card-body">
                                    <div class="body">
                                        <p class="card-text">自己紹介{{$profile->body}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
               
            @endif
        @endif
        <h2 style="text-align:center">投稿一覧</h2>
        <div class='paginate d-flex justify-content-center'>
            {{$posts->links()}}
        </div>
        <div class="posts">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="card col-4 " style="width:18rem">
                            @if (count($post->post_photos) == 2)
                                <img class="card-img-top" src="{{$post->post_photos[0]->image_path}}" alt="Card image cap">
                                <div class="card-img-overlay">
                                    <h4 class="card-title"><i class="fas fa-clone" style="text-righ"></i></h4>
                                </div>
                            @else
                                <img class="card-img-top" src="{{$post->post_photos[0]->image_path}}" alt="Card image cap">
                            @endif
                            <div class="card-header"><a href="/profiles/{{$post->user_id}}">{{$post->user->name}}</a></div>
                            <div class="card-body">
                                <div class="tag">
                                    @foreach($post->tags as $tag)
                                        <span class="badge badge-pill badge-info">{{$tag->name}}</span> 
                                    @endforeach
                                </div>
                                <p class="card-text">{{$post->body}}</p>
                                <div id="like">
                                    @if (Auth::check())
                                        @if ($like_model->like_exist(Auth::user()->id,$post->id))
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
                                <a href="/posts/{{$post->id}}" class="btn btn-light">詳細</a>
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