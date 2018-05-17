<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rubrik;
use App\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function rubrika($name_en)
    {
        $list_articles = Rubrik::with('articles')->orderByDesc('id')->where('name_en', $name_en)->get();
        return view('rubrika', [
            'list_articles' => $list_articles[0]['articles'],
            'rubrika_name_ru' => $list_articles[0]['name_ru']
            //'rubrika_id' => $list_articles[0]['id']
        ]);
    }

    public function article($name_en)
    {
        return view('article', [
            'article' => Article::with('rubriks')->where('name_en', $name_en)->first()
        ]);
    }

    public function syncTilda() {
        //return redirect()->action('HomeController@syncTildaWebhook');
        return view('sync-tilda');
    }


    public function page($page)
    {
        return view('page', ['page' => Page::where('name_en', $page)->first()]);
    }

}
