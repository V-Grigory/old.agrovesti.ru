<?php

namespace App\Http\Controllers\Wpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Tilda;
use App\Article;

class TildaController extends Controller
{

    function savePageFromTilda($page_id) {

        /* Для каждой страницы получаем информацию для экспорта. */
        $getpagefullexport = file_get_contents('http://api.tildacdn.info/v1/getpageexport/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&pageid='.$page_id);
        $pagefullexport=json_decode($getpagefullexport, true);

        // загрузим картинки со страницы
        foreach ($pagefullexport['result']['images'] as $k=>$v) {
            $get_resource = file_get_contents($v['from']);
            file_put_contents(public_path().'/tilda/images/'.$v['to'], $get_resource);
        }
        // созданим файл страницы
        file_put_contents(public_path().'/tilda/'.$pagefullexport['result']['filename'], $pagefullexport['result']['html']);
        //запишем в БД, если нет
        if(!$article = Article::where('tilda_filename', $pagefullexport['result']['filename'])->first()) {
            $article = new Article();
            $article->name_ru = $pagefullexport['result']['title'];
            $article->name_en = Str::slug(mb_substr($pagefullexport['result']['title'],0,40));
            $article->source = 'tilda';
            $article->article = '';
            $article->tilda_filename = $pagefullexport['result']['filename'];
            $article->save();
            $article->rubriks()->sync(env('ID_RUBRIK_FROM_TILDA',72));
        }
    }

    public function articles(Request $request)
    {
        $msg = '';

        $published_articles = [];
        $cnt_for_update = 0;
        $cnt_for_add = 0;
        $array_articles = [];

        if( isset($_GET["start_sync_by_pageid"]) ) {
            if( $_GET["pageid"] != '' ) {
                self::savePageFromTilda((int)$_GET["pageid"]);
                $msg = 'Синхронизация завершена!';
            } else {
                $msg = 'Не указан идентификатор статьи!';
            }
        }

        if( isset($_GET["start_sync"]) ) {
            if( count($tilda_articles = Tilda::where('status', 'published')->get()) > 0 ) {

                foreach ($tilda_articles as $tilda_article) {
                    self::savePageFromTilda($tilda_article->pageid);
                    $tilda_article->status = 'synchronized';
                    $tilda_article->save();
                }
                $msg = 'Синхронизация завершена!';
            }
        }

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
            'msg' => $msg
        ]);
    }

}
