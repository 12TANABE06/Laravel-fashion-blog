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
        @if($profile->image_path!=null)
        <form action='/profiles/{{$profile->id}}/delete', method="POST" style="display:inline" id="button">
            @csrf
            @method('DELETE')
            <input type="submit" onclick="return delet()" value="プロフィール画像の削除"/>
        </form>
        <form action='/profiles/{{$profile->id}}/update' method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <div class="profile">
                <div class="photo">
                    <label>プロフィール画像</label>
                    <img src="{{$profile->image_path}}">     
                </div>    
            <div class="body">
                <h2>自己紹介</h2>
                <textarea type="text" name="profile[body]">{{$profile->body}}</textarea>　
                <p class="body_error" style="color:red">{{$errors->first('profile.body')}}</p>
            </div>
            <input type="submit" value='保存'>
        </form>
        @else
        <form action='/profiles/{{$profile->id}}/update' method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <label>プロフィール画像がありません</label>
            <div class="photo" style="display:inline">
                <input type='file' name="profile[image_path]" placeholder="ファイル"/>
                 <p class="files_error" style="color:red">{{$errors->first('profile.image_path')}}</p>
            </div>
            <div class="body">
                <h2>自己紹介</h2>
                <textarea type="text" name="profile[body]">{{$profile->body}}</textarea>　
                <p class="body_error" style="color:red">{{$errors->first('profile.body')}}</p>
            </div>
            <input type="submit" value='保存'>
        </form>
        @endif
        <div class="back"><a href="/profiles/{{$profile->user_id}}">戻る</a></div>
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