<?php

namespace App\Repositories;

interface BlogRepositoryInterface
{
    
    public function queryActiveOrderByDate();
    public function getById($id);
    public function getActiveOrderByDate($n);
    public function getActiveOrderByDateForTag($n, $id);
    public function getArticlesWithOrder($n, $orderby = 'created_at', $direction = 'desc');
    public function getArticleBySlug($slug);
    public function getArticleWithTags($article);
    public function getByIdWithTags($id);
    public function getSlug($comment_id);
    public function getTagById($tag_id);

}
