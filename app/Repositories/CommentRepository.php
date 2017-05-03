<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function getCommentsWithPostsAndUsers($n)
    {
        return $this->model
            ->with('article', 'user')
            ->oldest('seen')
            ->latest()
            ->paginate($n);
    }

    public function store($inputs, $user_id)
    {
        $this->model->content = $inputs['comments'];
        $this->model->article_id = $inputs['article_id'];
        $this->model->user_id = $user_id;

        $this->model->save();
    }
    public function updateContent($content, $id)
    {
        $comment = $this->getById($id);

        $comment->content = $content;

        $comment->save();
    }

    public function update($seen, $id)
    {
        $comment = $this->getById($id);

        $comment->seen = $seen == 'true';

        $comment->save();
    }
}
