<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BlogRepository;
use App\Article;
use App\Tag;
use App\User;
use App\Category;
//use App\Repositories\BlogRepository;

class IndexController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    //public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }


    public function index()
    {
        // $articles = $this->blogRepository->getActiveOrderByDate(2);
        // return view('front.index', compact('articles'));
        $articles = Article::paginate(5);
        return view('front.index', compact('articles'));
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
