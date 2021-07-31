<?php

use Illuminate\Database\Seeder;
use App\PostPhoto;

class PostPhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('post_photos')->truncate();
        factory(PostPhoto::class,10)->create(); 
        
        //
    }
}
