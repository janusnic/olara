<?php

namespace App\Http\Controllers;

use App\Interfaces\StaticPagesInterface;
use Illuminate\Http\Request;

use App\Page;
use Session;


class FrontPageController extends Controller
{

    public function index($slug)
    {
        $content = Page::findBySlug($slug);

        return view('front.page')->with('content', $content);

    }

}
