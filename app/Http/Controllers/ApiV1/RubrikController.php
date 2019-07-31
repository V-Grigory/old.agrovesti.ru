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

    public function menu() {
        header('Access-Control-Allow-Origin: *');

        $rubriks = Rubrik::get();
        $rubriks_main_menu = [];
        $rubriks_footer_menu = [];

        foreach ($rubriks as $rubrik) {
        	if(isset($rubrik->params['show_in_main_menu'])
						&& $rubrik->params['show_in_main_menu'] == '1')
        	{
						$rubriks_main_menu[] = $rubrik;
					}
					if(isset($rubrik->params['show_in_footer_menu'])
						&& $rubrik->params['show_in_footer_menu'] == '1')
					{
						$rubriks_footer_menu[] = $rubrik;
					}
				}

				$articles = Article::get();
				$articles_main_menu = [];
				$articles_footer_menu = [];

				foreach ($articles as $article) {
					if(isset($article->params['show_in_main_menu'])
						&& $article->params['show_in_main_menu'] == '1')
					{
						$articles_main_menu[] = $article;
					}
					if(isset($article->params['show_in_footer_menu'])
						&& $article->params['show_in_footer_menu'] == '1')
					{
						$articles_footer_menu[] = $article;
					}
				}

				return [
        	'rubriks' => [
						'main_menu' => $rubriks_main_menu,
						'footer_menu' => $rubriks_footer_menu
					],
					'articles' => [
						'main_menu' => $articles_main_menu,
						'footer_menu' => $articles_footer_menu
					]
				];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        header('Access-Control-Allow-Origin: *');

        $rubriks = Rubrik::with(
            [
                'children' => function ($query) {
                    $query->orderBy('order', 'asc');
                },
                'articles' => function ($query) {
                    $query->select(
                        'name_ru', 'name_en', 'image', 'description', 'introduce',
                        'main_article', 'updated_at'
                    )->where('features', 'like', '%on_main_in_new_site%')
                        ->orderBy('main_article', 'desc');
                }
            ]
        )
					->where('on_main', 1)
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

    public function showRubrik($id, Request $request)
    {
        header('Access-Control-Allow-Origin: *');

				$page = $request->input('p') ? $request->input('p') : 1;
				$limit = 7;
				// file_put_contents('/home/grigory/projects/debug_api.txt', $page . "\n\n", FILE_APPEND);

        $rubrik = Rubrik::with([
            'articles' => function ($query) use ($page, $limit) {
                $query->select(
									'articles.id', 'name_ru', 'name_en', 'image', 'description', 'introduce'
                )
                  ->orderBy('articles.id', 'desc')
									->skip($page * $limit - $limit)->take($limit);
            },
            'parent'
        ])
						->withCount('articles')
            ->where('name_en', $id)->firstOrFail();

        return $rubrik;
    }

    public function showArticle($id)
    {
      header('Access-Control-Allow-Origin: *');

      $article = Article::with(
          ['rubriks' => function($query) { $query->with('parent'); }]
      )
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
