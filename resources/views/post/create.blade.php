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
        <form action='/posts/store' method="POST" enctype="multipart/form-data">
            @csrf
             <label>画像ファイル</label>
            <div class="photo" style="display:inline">
                <input type='file' name="files[][photo]" multiple  placeholder="ファイル" required/>
                 <p class="files_error" style="color:red">{{$errors->first('files.*.photo')}}</p>
            </div>
            <div class="body">
                <h2>コメント</h2>
                <textarea type="text" name="post[body]"  placeholder="コメント">{{old("post.body")}}</textarea>　
                <p class="body_error" style="color:red">{{$errors->first('post.body')}}</p>
            </div>
            <input type="submit" value='保存'>
        </form>
        <div class="back"><a href="/">戻る</a></div>
    </body>
</html>
@endsection