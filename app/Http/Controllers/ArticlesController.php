<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Tag;
use App\Category;
use Purifier;

 class ArticlesController extends Controller
{
    //protected $user;
    public function __construct()
    {
        //$this->middleware('isAdmin');
        //  $this->middleware('auth');
        //  $this->user =  \Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.create')->withCategories($categories)->withTags($tags);
    }

    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
                'title'         => 'required|max:255',
                'category_id'   => 'required|integer',
                'summary'      => 'required',
                'content' => 'required'
            ));

        // store in the database
        $post = new Article;

        $post->title = $request->title;
        // $post->slug = str_slug($post->title);
        $post->category_id = $request->category_id;
        $post->summary = $request->summary;
        $post->content = Purifier::clean($request->content);
        $post->user_id = Auth::user()->id;

        $post->seen =  $request->seen;
        $post->active = $request->active;
        $post->seo_title = $request->seo_title;
        $post->seo_key = $request->seo_key;
        $post->seo_desc = $request->seo_desc;

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The blog post was successfully save!');

        return redirect()->route('articles.show', $post->id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // find the post in the database and save as a var
        $post = Article::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        // return the view and pass in the var we previously created
        return view('articles.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function update(Request $request, $id)
    {
        // Validate the data
        $post = Article::find($id);

        $this->validate($request, array(
                'title' => 'required|max:255',
                // 'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' => 'required|integer',
                'summary'      => 'required',
                'content' => 'required'
            ));

        $post = Article::find($id);;
        $post->title = $request->input('title');

        // $post->slug = str_slug($post->title);
        $post->category_id = $request->input('category_id');
        $post->summary = $request->input('summary');
        $post->content = Purifier::clean($request->input('content'));
        $post->user_id = $this->user->id;

        $post->seen =  $request->input('seen');
        $post->active =  $request->input('active');

        $post->seo_title = $request->input('seo_title');
        $post->seo_key = $request->input('seo_key');
        $post->seo_desc = $request->input('seo_desc');

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        // set flash data with success message
        Session::flash('success', 'This post was successfully saved.');

        // redirect with flash data to posts.show
        return redirect()->route('articles.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $post = Article::find($id);

        return view('articles.show')
                    ->with('post', $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function destroy($id)
    {
        $post = Article::find($id);
        $post->tags()->detach();

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('blog.index');
    }

    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Article::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function favoriteArticle(Article $article)
    {
        Auth::user()->favorites()->attach($article->id);
        return back();
    }

    /**
     * Unfavorite a particular post
     *
     * @param  Article $article
     * @return Response
     */
    public function unFavoriteArticle(Article $article)
    {
        Auth::user()->favorites()->detach($article->id);

        return back();
    }


}
