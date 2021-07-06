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
        <h1>新規投稿作成</h1>
        <form action='/posts/store' method="POST" enctype="multipart/form-data">
            @csrf
            <div class="photo">
                <label>
                     画像ファイル
                     <input type='file' name="files[][photo]" multiple  placeholder="ファイル" required/>
                     <p class="files_error" style="color:red">{{$errors->first('files.*.photo')}}</p>
                </label>
            </div>
            <div class="tag">
                <label>
                    タグ
                    <input type="text" name="tags" placeholder="タグ" value={{old('tags')}}>
                </label>
            </div>
            <div class="body">
                <label>
                    コメント
                    <textarea type="text" name="post[body]"  placeholder="コメント">{{old("post.body")}}</textarea>　
                    <p class="body_error" style="color:red">{{$errors->first('post.body')}}</p>
                </label>
            </div>
            <input type="submit" value='保存'>
        </form>
        <div class="back"><a href="/">戻る</a></div>
    </body>
</html>
@endsection