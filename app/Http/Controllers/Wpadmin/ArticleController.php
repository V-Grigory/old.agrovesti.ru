<?php

namespace App\Http\Controllers\Wpadmin;

use App\Article;
use App\Rubrik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        return redirect()->route('wpadmin.article.create');
//        return view('wpadmin.articles.index', [
//            'articles' => Article::orderBy('created_at', 'desc')->paginate(10)
//        ]);
    }

    public function create()
    {
        $error_validate = ''; $article_saved = '';
        return view ('wpadmin.articles.create', [
            'article'    => [],
            'rubriks'   => Rubrik::with('children')->get(),
            'error_validate' => $error_validate,
            'article_saved' => $article_saved
        ]);
    }

    private function changeFeatures($action, $feature, $row) {
        switch ($action) {
            case 'add':
                if($row == NULL) {
                    $row = $feature;
                } elseif(strpos($row, $feature) === false) {
                    $row .= $feature;
                }
                break;
            case 'remove':
                if($row == NULL) {
                    break;
                } else {
                    $row = str_replace($feature, '', $row);
                }
        }
        return $row;
    }

    public function store(Request $request, Article $article)
    {
        //var_dump($request->all()); exit;
        /* === validate === */
        $error_validate = ''; $article_saved = '';
        if ($request->name_ru == '') $error_validate = "Укажите название статьи.  ";
        if (!isset($request->rubrik_id)) $error_validate .= "Укажите хотя бы 1 рубрику.  ";
        if ($request->article == '') $request->article = 'Статья из конструктора сайтов Tilda Publishing'; //$error_validate .= "Отсутствует контент статьи.  ";
        //if (isset($request->on_main) && !isset($request->image)) $error_validate .= "При размещении на главной нужно изображение.  ";

        if ($error_validate == '') {
            if(!$articleBD = Article::find($request->id)) {
                $articleBD = new Article();
                $articleBD->name_en = Str::slug(mb_substr($request->name_ru,0,40)."=".\Carbon\Carbon::now()->format('dmyHi'), '-');
            }
            $articleBD->name_ru = $request->name_ru;
            $articleBD->article = $request->article;
            if(isset($request->image)) {
                $name_image = Str::slug(\Carbon\Carbon::now()->format('dmyHi').'-'.mb_substr($request->file('image')->getClientOriginalName(),0,40));
                $name_image = $name_image .'.'. $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path().'/images/', $name_image);
                $articleBD->image = $name_image;
            }
            $articleBD->on_main = (isset($request->on_main)) ? 1 : 0;
            $articleBD->main_article = (isset($request->main_article)) ? 1 : 0;
            $articleBD->need_pay = (isset($request->need_pay)) ? 1 : 0;
            $articleBD->features = (isset($request->disable_comments))
                ? $this->changeFeatures('add', 'disable_comments', $articleBD->features)
                : $this->changeFeatures('remove', 'disable_comments', $articleBD->features);
            $articleBD->features = (isset($request->in_footer_block_1))
                ? $this->changeFeatures('add', 'in_footer_block_1', $articleBD->features)
                : $this->changeFeatures('remove', 'in_footer_block_1', $articleBD->features);
            $articleBD->features = (isset($request->in_footer_block_2))
                ? $this->changeFeatures('add', 'in_footer_block_2', $articleBD->features)
                : $this->changeFeatures('remove', 'in_footer_block_2', $articleBD->features);
            $articleBD->features = (isset($request->in_footer_block_3))
                ? $this->changeFeatures('add', 'in_footer_block_3', $articleBD->features)
                : $this->changeFeatures('remove', 'in_footer_block_3', $articleBD->features);

            $articleBD->description = $request->description;
            // $articleBD->introduce = json_encode($request->introduce);
						$introduce = [];
						for($i = 0; $i < 10; $i++) {
							if($request->{'introduce_'.$i})
								$introduce[] = $request->{'introduce_'.$i};
						}
            $articleBD->introduce = json_encode($introduce);

            $articleBD->save();
            $articleBD->rubriks()->sync($request->rubrik_id);
            $article_saved = 'Статья успешно сохранена';
        }
        $insertedId = (isset($articleBD)) ? $articleBD->id : $request->id;

        $article->id = $insertedId;
        $article->name_ru = $request->name_ru;
        $article->name_en = $request->name_en;
        $article->rubrik_id = $request->rubrik_id;
        $article->on_main = $request->on_main;
        $article->main_article = $request->main_article;
        $article->need_pay = $request->need_pay;
        $article->article = $request->article;
        $article->features = $request->disable_comments . $request->in_footer_block_1
                             . $request->in_footer_block_2 . $request->in_footer_block_3;
        $article->description = $request->description;
        $article->introduce = $introduce ? json_encode($introduce) : $request->introduce;
        //return redirect()->route('wpadmin.article.create', $error_validate);
        return view ('wpadmin.articles.create', [
            'article'    => $article,
            //'request' => $request,
            'rubriks'   => Rubrik::with('children')->get(),
            'error_validate' => $error_validate,
            'article_saved' => $article_saved
        ]);
    }

    public function show(Article $article)
    {
        //
    }

    public function edit(Article $article)
    {
        //
    }

    public function update(Request $request, Article $article)
    {
        $articleBD = Article::with('rubriks')->find($article->id);
        $rubrik_id = [];
        foreach ($articleBD['rubriks'] as $rubr) {
            $rubrik_id[] = $rubr->id;
        }
        $article->name_ru = $articleBD->name_ru;
        $article->name_en = $articleBD->name_en;
        $article->rubrik_id = $rubrik_id;
        $article->on_main = ($articleBD->on_main == 1) ? 1 : NULL;
        $article->main_article = ($articleBD->main_article == 1) ? 1 : NULL;
        $article->need_pay = ($articleBD->need_pay == 1) ? 1 : NULL;
        $article->article = $articleBD->article;
        $article->features = $articleBD->features;
        $article->description = $articleBD->description;
        $article->introduce = $articleBD->introduce;

        $error_validate = ''; $article_saved = '';
        return view ('wpadmin.articles.create', [
            'article'    => $article,
            'rubriks'   => Rubrik::with('children')->get(),
            'error_validate' => $error_validate,
            'article_saved' => $article_saved
        ]);
    }

    public function destroy(Article $article)
    {
//        print_r('<pre>');
//        print_r($article);
//        print_r('</pre>');
        //exit();
        $article->rubriks()->detach();
        $article->delete();
        if($article->image != NULL) {
            unlink(public_path().'/images/'.$article->image);
        }
        return redirect()->route('wpadmin.rubrik.index');
    }
}
