<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('posts')->truncate();//既存のデータの削除
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        factory(Post::class,10)->create(); 
        //
    }
}
