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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="back"><a href="/" class="btn btn-primary">戻る</a></div>
                        <div class="card-header"><a href="/profiles/{{$post->user_id}}">{{$post->user->name}}</a></div>
                        @if(count($post->post_photos)==2)
                            <div class="container"> 
                                <div id="carouselExampleControls" class="carousel slide"　data-ride="false" data-warp="true" data-touch="false" data-interval="false" >
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <a href="/posts/{{$post->id}}"><img class="d-block w-100 card-img-top" alt="First slide"src="{{$post->post_photos[0]->image_path}}"></a>
                                        </div>
                                        <div class="carousel-item">
                                            <a href="/posts/{{$post->id}}"><img class="d-block w-100 card-img-top" alt="Second slide"src="{{$post->post_photos[1]->image_path}}"></a>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="botton" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">前に戻る</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="botton" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">次に進む</span>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="container"> 
                                <a href="/posts/{{$post->id}}"><img class="d-block w-100 card-img-top" alt="First slide"src="{{$post->post_photos[0]->image_path}}"></a>
                            </div>
                        @endif
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
                            <div class="setting" style="display:inline">
                                @if(Auth::check())
                                    @if(Auth::user()->id==$post->user_id)
                                    <div class="update">
                                        <a href='/posts/{{$post->id}}/edit' class="btn btn-primary">編集</a>
                                    </div>
                                    @endif
                                @endif
                            <div class="card-footer">最終更新{{$post->updated_at}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </body>
</html>
@endsection