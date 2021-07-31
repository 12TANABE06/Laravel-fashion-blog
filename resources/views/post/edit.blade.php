<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FashionBlog</title>

        <!-- Fonts -->
        <!--<link href="index.css" rel="stylesheet" type="text/css">-->

       
     </head>
     <body>
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">投稿の編集</div>
                    <form action='/posts/{{$post->id}}/delete', method="POST" style="display:inline" id="button">
                        @csrf
                        @method('DELETE')
                        <input type="submit" onclick="return delet()"class="btn btn-primary" value="投稿の削除"/>
                    </form>
                    @if(count($post->post_photos)==2)
                            <div class="container"> 
                                <div id="carouselExampleControls" class="carousel slide"　data-ride="false" data-warp="true" data-touch="false" data-interval="false" >
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100 card-img-top" alt="First slide"src="{{$post->post_photos[0]->image_path}}">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100 card-img-top" alt="Second slide"src="{{$post->post_photos[1]->image_path}}">
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
                               <img class="card-img-top" alt="First slide"src="{{$post->post_photos[0]->image_path}}">
                            </div>
                        @endif

                    <div class="card-body">
                        <form action='/posts/{{$post->id}}/update' method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">タグ</label>
                                <div class="col-6">
                                    <input type="text" name="tags" class="form-control" value="{{$tags}}">
                                </div>
                            </div>    
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">コメント</label>
                                <div class="col-6">
                                    <textarea type="text" name="post[body]" class="form-control">{{$post->body}}</textarea>　
                                    <p class="body_error" style="color:red">{{$errors->first('post.body')}}</p>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value='保存'>
                        </form>
                        <br><a href="/" class="btn btn-primary">戻る</a></div>
                    
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