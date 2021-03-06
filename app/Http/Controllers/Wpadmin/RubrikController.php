<?php
namespace App\Http\Controllers\Wpadmin;

use App\Article;
use App\Rubrik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RubrikController extends Controller
{
    public function index(Request $request)
    {
        return view('wpadmin.rubriks.index', [
            //'rubriks' => Rubrik::paginate(10)
            'rubrik'    => [],
            'rubriks'   => Rubrik::with('children')->orderBy('order', 'ASC')->get(),
            'delimiter' => '',
            'params' => $request
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Rubrik::create($request->all());

        return redirect()->route('wpadmin.rubrik.index');
    }

    public function show(Rubrik $rubrik)
    {
        $list_articles = Rubrik::with(
            ['articles' => function ($query) {
                $query->orderBy('updated_at', 'desc');
            }]
        )->orderByDesc('id')->where('id', $rubrik->id)->get();

        return view('wpadmin.rubriks.list_articles', [
            'list_articles' => $list_articles[0]['articles'],
        ]);
    }

    public function edit(Rubrik $rubrik)
    {
        return view ('wpadmin.rubriks.index', [
            'rubrik'    => $rubrik,
            'rubriks'   => Rubrik::with('children')->orderBy('order', 'ASC')->get(),
            'delimiter' => ''
        ]);
    }

    public function update(Request $request, Rubrik $rubrik)
    {
        $rubrik->update($request->except('name_en'));

        return redirect()->route('wpadmin.rubrik.index');
    }

    public function destroy(Rubrik $rubrik)
    {
        if($rubrik->name_ru == 'Статьи из TILDA') {
            $ok_delete = '';
            $no_delete = "Эту рубрику лучше не удалять";
        }
        elseif($rubrik->articles()->count() > 0) {
            $ok_delete = '';
            $no_delete = "В данной рубрике есть статьи";
        } else {
            $rubrik->delete();
            $ok_delete = "Рубрика успешно удалена";
            $no_delete = '';
        }
        return redirect()->route('wpadmin.rubrik.index', [
            'no_delete' => $no_delete,
            'ok_delete' => $ok_delete
        ]);
    }

    public function uploadImageTemplate(Request $request){
        if($request['image_template'] != NULL) {
            $name_image = 'preview_template_number_' . $request['template_number'] . '.png';
            if( file_exists(public_path().'/images/assets/'.$name_image) )
                unlink(public_path().'/images/assets/'.$name_image);
            $request->file('image_template')->move(public_path() . '/images/assets/', $name_image);
        }
        return redirect()->route('wpadmin.rubrik.index');
    }
}