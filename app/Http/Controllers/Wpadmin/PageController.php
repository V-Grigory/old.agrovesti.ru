<?php

namespace App\Http\Controllers\Wpadmin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(Request $request)
    {
        return view('wpadmin.pages.index', [
            'page'   => Page::where('name_en', $request->page)->first(),
            'params' => $request
        ]);
    }

    public function store(Request $request, Page $page)
    {
        var_dump('dd');
        exit();
//        $list_articles = Rubrik::with('articles')->orderByDesc('id')->where('id', $rubrik->id)->get();
//
//        return view('wpadmin.rubriks.list_articles', [
//            'list_articles' => $list_articles[0]['articles'],
//        ]);
    }

}