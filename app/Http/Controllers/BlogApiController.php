<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Tag;
use App\User;
use App\Category;


class BlogApiController extends Controller
{
    private $items;
    
    public function __construct(Article $items)
    {
        $this->items = $items;
    }
    
    
    public function index()
    {
        $items = $this->items->paginate(5);
        
        return response()->json($items);
    }


    public function show(Request $request, $slug)
    {
        $user = $request->user();
        return view('front.show', array_merge($this->blogRepository->getArticleBySlug($slug), compact('user')));
    }

    public function tag(Request $request)
    {
        $tag = $request->input('tag');
        $articles = $this->blogRepository->getActiveOrderByDateForTag(2, $tag);
        $links = $articles->appends(compact('tag'))->links();
        $info = 'Tags: ' . '<strong>' . $this->blogRepository->getTagById($tag) . '</strong>';

        return view('front.index', compact('articles', 'links', 'info'));
    }

    
}
