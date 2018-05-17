<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Article;
use App\Rubrik;

class DevController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dev(Request $request)
    {
//        $articles = Article::all();
//
//        foreach ($articles as $article) {
//            $arr = explode(',',  $article->id_rubriks);
//            $article->rubriks()->attach($arr);
//        }
        return view('dev', [
//            'articles' => $articles
        ]);
    }

}
