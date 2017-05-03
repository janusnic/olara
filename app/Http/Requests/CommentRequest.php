<?php

namespace App\Http\Requests;

class CommentRequest extends Request
{
    public function rules()
    {
        $id = $this->comment;
        return [
            'comments' . $id => 'bail|required|max:65000',
        ];
    }
}
