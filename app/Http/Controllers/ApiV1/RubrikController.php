<?php

namespace App\Http\Controllers\ApiV1;

use App\Rubrik;
use App\Article;
// use App\Http\Resources\RubrikResource;
use App\Http\Resources\RubriksResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RubrikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        header('Access-Control-Allow-Origin: *');

//        $rubriks = Rubrik::with('children')->with(
//            ['articles' => function ($query) {
//                $query->select(
//                    'name_ru', 'name_en', 'image', 'description', 'introduce',
//                    'on_main', 'main_article', 'updated_at'
//                )->where('on_main', '=', 1)
//                    ->orderBy('main_article', 'desc');
//            }]
//        )->where('on_main', 1)
//            ->where('target', 'new_site')
//            ->orderBy('position_number', 'asc')
//            ->limit(10)
//            ->get();

        $rubriks = Rubrik::with(
            [
                'children' => function ($query) {
                    $query->orderBy('order', 'asc');
                },
                'articles' => function ($query) {
                    $query->select(
                        'name_ru', 'name_en', 'image', 'description', 'introduce',
                        'on_main', 'main_article', 'updated_at'
                    )->where('on_main', '=', 1)
                        ->orderBy('main_article', 'desc');
                }
            ]
        )->where('on_main', 1)
            ->where('target', 'new_site')
            ->orderBy('position_number', 'asc')
            //->limit(10)
            ->get();

        return new RubriksResource($rubriks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function showRubrik($id)
    {
        header('Access-Control-Allow-Origin: *');

        $rubrik = Rubrik::with([
            'articles' => function ($query) {
                $query->select(
                    'name_ru', 'name_en', 'image', 'description', 'introduce',
                    'on_main', 'main_article', 'updated_at'
                )->where('on_main', '=', 1)
                    ->orderBy('main_article', 'desc');
            }
        ])
            ->where('name_en', $id)->firstOrFail();

        return $rubrik;
    }

    public function showArticle($id)
    {
      header('Access-Control-Allow-Origin: *');

      $article = Article::with('rubriks')
          ->where('name_en', $id)->firstOrFail();

      if($article->tilda_filename) {
          //$article->tilda = include(public_path().'/tilda/'.$article->tilda_filename);
          $article->tilda_content = file_get_contents(
              public_path().'/tilda/'.$article->tilda_filename
          );
      }

      return $article;
      // return json_encode($article);
      // return new RubrikResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
