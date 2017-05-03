<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Article;

class RecentPosts extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $articles = Article::latest()->get();

        return view("widgets.recent_posts", [
            'config' => $this->config, 'articles' => $articles
        ]);
    }
}
