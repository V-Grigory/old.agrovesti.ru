<?php
use App\Article;
//use App\Rubrik;
use Illuminate\Support\Str;

//$getpageslist = file_get_contents('http://api.tildacdn.info/v1/getpageslist/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=627900');
//$pageslist=json_decode($getpageslist, true);
//echo '<pre>';
//var_dump($pageslist);
//echo '</pre>';
//exit();

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


/* WebHook */
/* /sync-tilda?projectid=627900&publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&pageid=2848220 */
if( isset($_GET["projectid"]) && isset($_GET["pageid"]) && isset($_GET["publickey"]) && isset($_GET["secretkey"]) ) {

    if( $_GET["projectid"] == '627900' && $_GET["publickey"] == 'vgne4ejqrfpj09moy8wl' && $_GET["secretkey"] == 'mw39g6nc6c72sugw90m1' ) {
        ob_end_clean();
        header("Connection: close\r\n");  header("Content-Encoding: none\r\n");
        ignore_user_abort(true); // optional
        ob_start();
        echo ('ok');
        $size = ob_get_length();
        header("Content-Length: $size");
        ob_end_flush();
        flush();
        ob_end_clean();

        savePageFromTilda($_GET["pageid"]);
    }

} else {
    /* загрузка ВСЕГО */

    $dirs['images'] = public_path().'/tilda/images';
    $dirs['css'] = public_path().'/tilda/css';
    $dirs['js'] = public_path().'/tilda/js';

    if(!is_dir($dirs['images'])) mkdir($dirs['images']);
    if(!is_dir($dirs['css'])) mkdir($dirs['css']);
    if(!is_dir($dirs['js'])) mkdir($dirs['js']);

    /* Получаем информацию по нужному нам проекту для экспорта */
    $result = file_get_contents('http://api.tildacdn.info/v1/getprojectexport/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=627900');
    $project=json_decode($result, true);

    foreach ($project['result'] as $key=>$value) {
        if($key == 'images' || $key == 'css' || $key == 'js') {
            foreach ($value as $resource) {
                $get_resource = file_get_contents($resource['from']);
                file_put_contents($dirs[$key].'/'.$resource['to'], $get_resource);
            }
        }
        if($key == 'htaccess') {
            file_put_contents(public_path().'/tilda/.htaccess', $value);
        }
    }

    /* Получаем список всех страниц в нашем проекте. Запрос getpageslist */
    $getpageslist = file_get_contents('http://api.tildacdn.info/v1/getpageslist/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=627900');
    $pageslist=json_decode($getpageslist, true);

    foreach ($pageslist['result'] as $key=>$value) {
        savePageFromTilda($value['id']);
    }

}
