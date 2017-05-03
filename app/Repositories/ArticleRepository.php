<?php

namespace App\Repositories;

use App\Article;
use App\Tag;
use App\Category;
use App\User;
use App\Comment;

class ArticleRepository implements BlogRepositoryInterface
{
    protected $tag;

    protected $comment;


    public function __construct(Article $article, Tag $tag, Category $category, Comment $comment)
    {
        $this->model = $article;
        $this->tag = $tag;
        $this->category = $category;
        $this->comment = $comment;
    }


    public function queryActiveOrderByDate()
    {
        return $this->model
            ->select('id', 'created_at', 'updated_at', 'title', 'slug', 'summary', 'category_id')
            ->whereActive(true)
            ->latest();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
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

        $comments = $this->comment
            ->whereArticleId($article->id)
            ->with('user')
            ->get();
        return compact('article', 'comments');
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
