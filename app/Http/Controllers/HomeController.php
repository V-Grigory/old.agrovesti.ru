<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rubrik;
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
        ]);
        //return view('rubrika', ['rubrika' => Rubrik::with('articles')->orderByDesc('id')->where('name_en', $name_en)->get()]);
    }

    public function article($name_en)
    {
        return view('article', ['article' => Article::with('rubriks')->where('name_en', $name_en)->first()]);
    }

}
