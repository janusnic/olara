<?php

namespace App\Repositories;

use App\Article;
use App\Tag;
use App\Category;
use App\User;


class BlogRepository extends BaseRepository
{
    protected $tag;

    protected $comment;

    public function __construct(Article $article, Tag $tag, Category $category)
    {
        $this->model = $article;
        $this->tag = $tag;
        $this->category = $category;

    }

    protected function queryActiveOrderByDate()
    {
        return $this->model
            ->select('id', 'created_at', 'updated_at', 'title', 'slug', 'summary', 'category_id')
            ->whereActive(true)
            ->latest();
    }

    public function getActiveOrderByDate($n)
    {
        return $this->queryActiveOrderByDate()->paginate($n);
    }

    public function getActiveOrderByDateForTag($n, $id)
    {
        return $this->queryActiveOrderByDate()
            ->whereHas('tags', function ($q) use ($id) {
                $q->where('tags.id', $id);
            })->paginate($n);
    }


    public function getArticlesWithOrder($n, $orderby = 'created_at', $direction = 'desc')
    {
        $query = $this->model
            ->select('articles.id', 'articles.created_at', 'title', 'articles.seen', 'active', 'slug')
            ->orderBy($orderby, $direction);
        return $query->paginate($n);
    }


    public function getArticleBySlug($slug)
    {
        $article = $this->model->with('tags')->whereSlug($slug)->firstOrFail();

        return compact('article');
    }


    public function getArticleWithTags($article)
    {
        $tags = [];

        foreach ($article->tags as $tag) {
            array_push($tags, $tag->name);
        }

        return compact('article', 'tags');
    }


    public function getByIdWithTags($id)
    {
        return $this->model->with('tags')->findOrFail($id);
    }



    public function getSlug($comment_id)
    {
        return $this->comment->findOrFail($comment_id)->article->slug;
    }


    public function getTagById($tag_id)
    {
        return $this->tag->findOrFail($tag_id)->name;
    }
}
