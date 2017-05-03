<?php

namespace App\Http\Controllers;

use App\Interfaces\StaticPagesInterface;

use Illuminate\Http\Request;


class AdminPageController extends Controller
{

    public function index(StaticPagesInterface $page)
    {
        $pages = $page::orderBy('id', 'desc')->paginate(10);

        return view('laravel-static-pages::index', compact('pages'));
    }


    public function create(StaticPagesInterface $page)
    {
        return view('laravel-static-pages::create',
            ['action' => 'create', 'page' => $page]);
    }

    public function store(StaticPagesInterface $page, Request $request)
    {
        $input = $request->all();
        $page->fill($input);
        $page->save();

        return redirect()->route('page.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(StaticPagesInterface $page)
    {
        return view('laravel-static-pages::edit', ['action' => 'edit', 'page' => $page]);
    }

    public function update(StaticPagesInterface $page, Request $request)
    {
        $input = $request->all();
        $page->fill($input);
        $page->save();

        return redirect()->route('page.index');
    }

    public function destroy(StaticPagesInterface $page)
    {
        $page->delete();

        return redirect()->route('page.index');
    }

}
