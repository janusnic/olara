<?php

use Illuminate\Database\Seeder;


class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
          'title' => str_random(10),
          'slug' => str_random(10),
          'summary' =>str_random(30),
          'content' =>str_random(255),
          'seo_title' =>str_random(10),
          'seo_key' =>str_random(25),
          'seo_desc' =>str_random(100),
        ]);
    }
}
