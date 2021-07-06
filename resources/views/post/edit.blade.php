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
        <div class="photo" style="display:inline">
            @foreach($post->post_photos->pluck("image_path") as $image_path)
                <div class="photo" style="display:inline">
                　   <img src="{{$image_path}}">     
                </div>
            @endforeach
        </div>
        <div class="tag" style="display:inline">
            @foreach($post->tags as $tag)
            <form action='/tags/{{$tag->id}}/delete' method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                    <span class="badge badge-pill badge-info">{{$tag->name}}</span>
                    <input type="submit"value="削除"/>
            </form>
            @endforeach
        </div>
        <form action='/posts/{{$post->id}}/update' method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="tag">
                <label>
                    タグの追加
                    <input type="text" name="tags" placeholder="タグ" value="{{$text}}">
                </label>
            </div>
            <div class="body">
                <h2>コメント</h2>
                <textarea type="text" name="post[body]">{{$post->body}}</textarea>　
                <p class="body_error" style="color:red">{{$errors->first('post.body')}}</p>
            </div>
            <input type="submit" value='保存'>
        </form>
        <div class="back"><a href="/">戻る</a></div>
    </body>
</html>
@endsection