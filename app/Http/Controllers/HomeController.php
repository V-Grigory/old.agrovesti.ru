<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rubrik;
use App\Page;
use App\Comments;
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

    public function article($name_en, Request $request)
    {
        // если пришел коммент, сохраним его
        if($request->comment != NULL) {
            $comment = new Comments();
            $comment->article_id = $request->comment_article_id;
            $comment->client_id = $request->comment_client_id;
            $comment->comment = $request->comment;
            $comment->save();
        }

        // найдем запрошенную статью
        $article = Article::with('rubriks')->where('name_en', $name_en)->first();

        if($article) {
            // возьмем комменты с авторами
            $comments = Comments::with('client')->where('article_id', $article->id)->get();

            return view('article', [
                'article' => $article,
                'comments' => $comments,
                'is_login' => $this->is_login($request)
            ]);
        } else {
            return view('404');
        }

    }

    public function syncTilda() {
        return view('sync-tilda');
    }

}
