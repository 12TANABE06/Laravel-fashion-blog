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
        <a href="/" class="btn btn-primary">戻る</a>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">プロフィール作成</div>

                    <div class="card-body">
                        <form action='/profiles/store' method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">プロフィール画像</label>
                                <div class="col-6">
                                    <input type='file' name="profile[image_path]" class="form-control-file" placeholder="ファイル" />
                                    <p class="files_error" style="color:red">{{$errors->first('profile.image_path')}}</p>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">自己紹介</label>
                                <div class="col-6">
                                    <textarea type="text" name="profile[body]" class="form-control" placeholder="コメント">{{old("profile.body")}}</textarea>　
                                    <p class="body_error" style="color:red">{{$errors->first('profile.body')}}</p>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value='保存'>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
@endsection