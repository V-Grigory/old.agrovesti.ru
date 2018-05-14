<?php

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
    /* Для каждой страницы получаем информацию для экспорта. */
    $getpagefullexport = file_get_contents('http://api.tildacdn.info/v1/getpageexport/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&pageid='.$value['id']);
    $pagefullexport=json_decode($getpagefullexport, true);

    // загрузим картинки со страницы
    foreach ($pagefullexport['result']['images'] as $k=>$v) {
        $get_resource = file_get_contents($v['from']);
        file_put_contents($dirs['images'].'/'.$v['to'], $get_resource);
    }
    // созданим файл страницы
    file_put_contents(public_path().'/tilda/'.$pagefullexport['result']['filename'], $pagefullexport['result']['html']);
}



//file_put_contents("/home/grigory/projects/centr.agrovesti.ru/files.txt", "ssss1");
//$cnt = 0;
//if ($handle = opendir('/home/grigory/projects/centr.agrovesti.ru/public/images/')) {
//    while (false !== ($file = readdir($handle))) {
//        if($file != '.' && $file != '..' && $file != 'assets' && $file != 'banners')
//        {
//            $users = DB::table('articles')->where('article', 'like', "%$file%")->get();
//            if(!isset($users[0])) {
//                $cnt++;
//                echo $file . '<br>';
//                unlink('/home/grigory/projects/centr.agrovesti.ru/public/images/'.$file);
//            }
//        }
//        if($cnt == 1) break;
//    }
//    closedir($handle);
//}
//echo 'COUNT - ' . $cnt;

