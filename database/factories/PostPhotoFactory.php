<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostPhoto;
use App\Post;
use Faker\Generator as Faker;

$factory->define(PostPhoto::class, function (Faker $faker) {
    return [
        'post_id' => function(){
            return factory(App\Post::class)->create()->id;
        },
        'image_path' => 'https://fashion-blog-backet.s3.ap-northeast-1.amazonaws.com/posts/1o813Ds0IgnhJ197FbXHuKkACxbKbKI6HnzIzW9J.jpg',
    ];
});
