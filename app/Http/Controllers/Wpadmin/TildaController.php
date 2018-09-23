<?php

namespace App\Http\Controllers\Wpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tilda;
use App\Article;

class TildaController extends Controller
{

    public function articles(Request $request)
    {
        $published_articles = [];
        $cnt_for_update = 0;
        $cnt_for_add = 0;
        $array_articles = [];

        if( count($tilda_articles = Tilda::where('status', 'published')->get()) > 0 ) {

            $articles = Article::where('source', 'tilda')->get();
            foreach ($articles as $article) {
                $array_articles[ substr($article->tilda_filename, 4, -5) ] = $article->name_ru;
            }

            // в табл tilda записи с статусом:
            // published - это опубликованные в тильде и НЕ синхронизированные тут
            // synchronized - это опубликованные в тильде и синхронизированные тут

            foreach ($tilda_articles as $tilda_article) {

                if( array_key_exists($tilda_article->pageid, $array_articles) ) {
                    $published_articles[] = $array_articles[$tilda_article->pageid];
                    $cnt_for_update++;
                } else {
                    $cnt_for_add++;
                }
            }
        }

        return view('wpadmin.tilda.articles', [
            'published_articles' => $published_articles,
            'cnt_for_update' => $cnt_for_update,
            'cnt_for_add' => $cnt_for_add,
        ]);
    }

}
