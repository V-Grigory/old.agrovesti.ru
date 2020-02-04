<?php

namespace App\Http\Controllers\ApiV1;

use App\Rubrik;
use App\Article;
use App\Client;
// use App\Http\Resources\RubrikResource;
use App\Http\Resources\RubriksResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Mail\MyMailer;
use Illuminate\Support\Facades\Mail;

class RubrikController extends Controller
{

    public function menu() {
        header('Access-Control-Allow-Origin: *');

        $rubriks = Rubrik::select('name_ru','name_en','params')->get();
        $m1 = []; $m2 = [];

        foreach ($rubriks as $rubrik) {
        	if(isset($rubrik->params['show_in_main_menu'])
						&& $rubrik->params['show_in_main_menu'] == '1')
        	{
						$m1[] = $rubrik;
					}
					if(isset($rubrik->params['show_in_footer_menu'])
						&& $rubrik->params['show_in_footer_menu'] == '1')
					{
						$m2[] = $rubrik;
					}
				}
        $rubriks_m = ['main_menu' => $m1, 'footer_menu' => $m2];

				$articles = Article::select('name_ru','name_en','params')->get();
				$m1 = []; $m2 = [];

				foreach ($articles as $article) {
					if(isset($article->params['show_in_footer_menu_1'])
						&& $article->params['show_in_footer_menu_1'] == '1')
					{
						$m1[] = $article;
					}
					if(isset($article->params['show_in_footer_menu_2'])
						&& $article->params['show_in_footer_menu_2'] == '1')
					{
						$m2[] = $article;
					}
				}
				$articles_m = [
					'footer_menu' => ['menu_1' => $m1, 'menu_2' => $m2]
				];

				// рубрики для страниц Рубрика и Статья
				$rubricator = Rubrik::select('id', 'name_ru', 'name_en')
					->with([
						'children' => function ($query) {
							$query->select('id', 'parent_id', 'name_ru', 'name_en')
								->orderBy('order', 'asc');
						}
					])
					//->where('id', 89)
					->where('on_main', 1)
					->where('target', 'new_site')
					->orderBy('position_number', 'asc')
					->get();

				return [
        	'rubriks' => $rubriks_m,
					'articles' => $articles_m,
					'rubricator' => $rubricator
				];
    }

    public function index() {
        header('Access-Control-Allow-Origin: *');

        $rubriks = Rubrik::with(
            [
                'children' => function ($query) {
                    $query->orderBy('order', 'asc');
                },
                'articles' => function ($query) {
                    $query->select(
                        'tag', 'name_ru', 'name_en', 'image', 'description',
												'subtitle', 'title_introduce', 'introduce',
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

    public function showRubrik($id, Request $request)
    {
        header('Access-Control-Allow-Origin: *');

				$page = $request->input('p') ? $request->input('p') : 1;
				$limit = 7;
				// file_put_contents('/home/grigory/projects/debug_api.txt', $page . "\n\n", FILE_APPEND);

        $rubrik = Rubrik::with([
            'articles' => function ($query) use ($page, $limit) {
                $query->select(
									'articles.id', 'tag', 'name_ru', 'name_en', 'image',
									'description', 'subtitle', 'title_introduce', 'introduce'
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

		public function getAuthToken(Request $request) {
			header('Access-Control-Allow-Origin: *');

    	$client = Client::where('phone', $request->accessCode)->firstOrFail();
    	if($client && (
					$client->status_activity == 'Активен'
					|| $client->status_activity == 'Пробный период'
					|| $client->status_activity == 'Новый клиент'
				)
			) {
				return Str::random(32);
			}
		}

		public function clientRegistration(Request $request) {
			header('Access-Control-Allow-Origin: *');

			if($client = Client::where('email', $request->email)->first()) {
				return 'already_registered';
			}

			$allowCode = false;
			while(!$allowCode) {
				$code = rand(999, 9999);
				if(!$client = Client::where('phone', $code)->first()) {
					$allowCode = true;
				}
			}

			$client = new Client();
			$client->phone = $code;
			$client->email = $request->email;
			$client->save();

			$mailData = new \stdClass();
			$mailData->kod = $code;

			Mail::to($request->email)->send(new MyMailer($mailData));
			return 'success_registered';
		}

		public function search(Request $request) {
			header('Access-Control-Allow-Origin: *');

			$articles = Article::select('name_ru','name_en')
				->where('name_ru', 'like', "%{$request->text}%")
				->Orwhere('description', 'like', "%{$request->text}%")
				->Orwhere('introduce', 'like', "%{$request->text}%")
				->get();

			//file_put_contents('/home/grigory/projects/debug_api.txt', json_encode($articles) . "\n\n", FILE_APPEND);
			//file_put_contents('/home/grigory/projects/debug_api.txt', $articles->toSql() . "\n\n", FILE_APPEND);
			return $articles;
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
