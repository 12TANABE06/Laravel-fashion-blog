<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FashionBlog</title>

        <!-- Fonts -->
        

       
     </head>
     <body>
        
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">プロフィールの編集</div>
                        @if ($profile->image_path != null)
                            <form action='/profiles/{{$profile->id}}/delete' method="POST" style="display:inline" id="button">
                                @csrf
                                @method('DELETE')
                                <input type="submit" onclick="return delet()" class="btn btn-light" value="プロフィール画像の削除"/>
                            </form>
                            <div class="photo">
                                <img class="card-img-top rounded-circle" alt="First slide" src="{{$profile->image_path}}">
                            </div>
                            <div class="card-body">
                                <form action='/profiles/{{$profile->id}}/update' method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">名前</label>
                                        <div class="col-6">
                                            <input type="text" name="user[name]" class="form-control" value={{$profile->user->name}}>　
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">自己紹介</label>
                                        <div class="col-6">
                                            <textarea type="text" name="profile[body]" class="form-control">{{$profile->body}}</textarea>　
                                            <p class="body_error" style="color:red">{{$errors->first('profile.body')}}</p>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-light" value='保存'>
                                </form>
                                <br><a href="/" class="btn btn-light">戻る</a>
                            </div>
                        @else
                            <div class="card-body">
                                <form action='/profiles/{{$profile->id}}/update' method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">プロフィール画像がありません</label>
                                        <div class="col-6">
                                            <input type='file' name="profile[image_path]" class="form-control-file" placeholder="ファイル" />
                                            <p class="files_error" style="color:red">{{$errors->first('profile.image_path')}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">名前</label>
                                        <div class="col-6">
                                            <input type="text" name="user[name]" class="form-control" value={{$profile->user->name}}>　
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">自己紹介</label>
                                        <div class="col-6">
                                            <textarea type="text" name="profile[body]" class="form-control">{{$profile->body}}</textarea>　
                                            <p class="body_error" style="color:red">{{$errors->first('profile.body')}}</p>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-light" value='保存'>
                                </form>
                                <br><a href="/" class="btn btn-light">戻る</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>    
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