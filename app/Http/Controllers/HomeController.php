<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function rubrika($name_en)
    {
        return view('rubrika', ['rubrika' => Article::with('rubriks')->where('name_en', $name_en)->first()]);
    }

    public function article($name_en)
    {
        return view('article', ['article' => Article::with('rubriks')->where('name_en', $name_en)->first()]);
    }

}
