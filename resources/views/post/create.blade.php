<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FashionBlog</title>
       
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">新規投稿作成</div>

                    <div class="card-body">
                        <form action='/posts/store' method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">画像ファイル</label>
                                <div class="col-6">
                                    <input type='file' name="files[][photo]" class="form-control-file" multiple  placeholder="ファイル" required/>
                                    <p class="files_error" style="color:red">{{$errors->first('files.*.photo')}}</p>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">タグ</label>
                                <div class="col-6">
                                    <input type="text" name="tags" class="form-control" placeholder="＃タグ" value={{old('tags')}}>
                                </div>
                            </div>    
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">コメント</label>
                                <div class="col-6">
                                    <textarea type="text" name="post[body]" class="form-control" placeholder="コメント">{{old("post.body")}}</textarea>　
                                    <p class="body_error" style="color:red">{{$errors->first('post.body')}}</p>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-light" value='保存'>
                        </form>
                        <br><a href="/" class="btn btn-light">キャンセル</a></div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>    
    </body>
</html>
@endsection