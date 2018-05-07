<?php
/**
 * Created by PhpStorm.
 * User: grigory
 * Date: 17.02.18
 * Time: 22:32
 */

//print_r('<pre>');
//var_dump($articles);
//print_r('</pre>');

//foreach ($articles as $article) {
//    $arr = explode(',',  $article->id_rubriks);
//    echo $article->id . '; arr: '.  json_encode($arr) .'<br>';
//}

//echo 'ss';
// Public key: vgne4ejqrfpj09moy8wl
// Secret key: mw39g6nc6c72sugw90m1

//Получить список проектов
// http://api.tildacdn.info/v1/getprojectslist/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1

// 0
// id	"5710"
// title	"День поля"
// descr	"Агропромышленная выставка"
// 1
// id	"627900"
// title	"Агровести"
// descr

//Получить информацию о проекте // projectid=5710
// http://api.tildacdn.info/v1/getproject/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=5710

// Получить информацию о проекте для экспорта
// http://api.tildacdn.info/v1/getprojectexport/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=5710

// http://api.tildacdn.info/v1/getpageexport/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&pageid=22542

//$result = file_get_contents('http://api.tildacdn.info/v1/getprojectexport/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=5710');
//$project=json_decode($result, true);
//echo '<pre>';
//print_r($project);
//echo '</pre>';

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

