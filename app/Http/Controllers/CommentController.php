<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Object_;

class CommentController extends Controller
{
    public function postComment(Model $commentable){
        dd($commentable);
    }
}
