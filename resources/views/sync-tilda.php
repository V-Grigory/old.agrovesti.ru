<?php
use App\Tilda;


/* WebHook */
/* /sync-tilda?projectid=627900&publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&pageid=2848220 */

if( isset($_GET["projectid"]) && isset($_GET["pageid"]) && isset($_GET["publickey"]) && isset($_GET["secretkey"]) ) {

    if( $_GET["projectid"] == '627900' && $_GET["publickey"] == 'vgne4ejqrfpj09moy8wl' && $_GET["secretkey"] == 'mw39g6nc6c72sugw90m1' ) {

        if(!$tilda = Tilda::where('pageid', $_GET["pageid"])->first()) {
            $tilda = new Tilda();
            $tilda->pageid = $_GET["pageid"];
        }
        $tilda->status = 'published';
        $tilda->save();
    }
}
echo 'ok';

    //exit();
    /* загрузка ВСЕГО */

//    $dirs['images'] = public_path().'/tilda/images';
//    $dirs['css'] = public_path().'/tilda/css';
//    $dirs['js'] = public_path().'/tilda/js';
//
//    if(!is_dir($dirs['images'])) mkdir($dirs['images']);
//    if(!is_dir($dirs['css'])) mkdir($dirs['css']);
//    if(!is_dir($dirs['js'])) mkdir($dirs['js']);
//
//    /* Получаем информацию по нужному нам проекту для экспорта */
//    $result = file_get_contents('http://api.tildacdn.info/v1/getprojectexport/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=627900');
//    $project=json_decode($result, true);
//
//    foreach ($project['result'] as $key=>$value) {
//        if($key == 'images' || $key == 'css' || $key == 'js') {
//            foreach ($value as $resource) {
//                $get_resource = file_get_contents($resource['from']);
//                file_put_contents($dirs[$key].'/'.$resource['to'], $get_resource);
//            }
//        }
//        if($key == 'htaccess') {
//            file_put_contents(public_path().'/tilda/.htaccess', $value);
//        }
//    }
//
//    /* Получаем список всех страниц в нашем проекте. Запрос getpageslist */
//    $getpageslist = file_get_contents('http://api.tildacdn.info/v1/getpageslist/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=627900');
//    $pageslist=json_decode($getpageslist, true);
//
//    foreach ($pageslist['result'] as $key=>$value) {
//        savePageFromTilda($value['id']);
//    }