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

foreach ($articles as $article) {

    $arr = explode(',',  $article->id_rubriks);

    echo $article->id . '; arr: '.  json_encode($arr) .'<br>';
}