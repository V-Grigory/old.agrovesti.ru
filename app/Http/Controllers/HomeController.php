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
        $list_articles = Rubrik::with(
                                ['articles' => function ($query) {
                                    $query->orderBy('updated_at', 'desc');
                                }]
                            )->where('name_en', $name_en)->get();

        if(isset($list_articles[0])) {
            return view('rubrika', [
                'list_articles' => $list_articles[0]['articles'],
                'rubrika_name_ru' => $list_articles[0]['name_ru']
            ]);
        } else {
            return view('404');
        }

    }

    public function article($name_en)
    {
        $article = Article::with('rubriks')->where('name_en', $name_en)->first();
        if($article) {
            return view('article', [
                'article' => $article
            ]);
        } else {
            return view('404');
        }

    }

    public function syncTilda() {
        return view('sync-tilda');
    }

}
