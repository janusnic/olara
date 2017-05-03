<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;

class InsertDummyPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:dummy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app()->setLocale('en');

        $post1 = new Post();
        $post1->title = 'My Awesome Habits';
        $post1->content = "I eat my dinner in my bathtub Then I go to sex clubs Watching freaky people gettin' it on It doesn't make me nervous If anything I'm restless Yeah, I've been around and I've seen it all ";
        $post1->save();

        $post2 = new Post();
        $post2->title = 'The Second Amazing Habits';
        $post2->content = "I get home, I got the munchies Binge on all my Twinkies Throw up in the tub Then I go to sleep And I drank up all my money Dazed and kinda lonely";
        $post2->save();

        app()->setLocale('uk');

        $post1->title = 'Мої Приголомшливі Звички';
        $post1->content = 'Я їм мій обід в моїй ванні Тоді я йду в секс-клуби Дивлячись химерні люди отримує його Це не змушує мене нервувати Якщо щось я неспокійний Так, я був навколо, і я бачив все це';
        $post1->save();

        $post2->title = 'Мої Дивовижні Звички';
        $post2->content = 'Я повертаюся додому, я отримав бутерброди Розгул на все моє Twinkies Киньте в ванну Тоді я йду спати І я випив все мої гроші Приголомшений і свого роду одиноким';
        $post2->save();
    }
}
