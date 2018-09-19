<?php
//use App\Rubrik;

//$list_articles_cnt = Rubrik::with(['articles'])->where('name_en', 'opyt')->get();
//echo count($list_articles_cnt[0]['articles']);

//echo abs(-4.2); // 4.2 (double/float)
//echo ceil(4,5);
//echo ceil(5 / 6);

//if( $curl = curl_init() ) {
//    curl_setopt($curl, CURLOPT_URL, 'http://api.tildacdn.info/v1/getpageslist/?publickey=vgne4ejqrfpj09moy8wl&secretkey=mw39g6nc6c72sugw90m1&projectid=627900');
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
//    $out = curl_exec($curl);
//
//    echo '<pre>';
//    var_dump(json_decode( $out));
//    echo '</pre>';
//    curl_close($curl);
//}

exit();

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


//
//$cnt = 0;
//if ($handle = opendir('/home/grigory/projects/centr.agrovesti.ru/public/images/')) {
//    while (false !== ($file = readdir($handle))) {
//        if($file != '.' && $file != '..' && $file != 'assets' && $file != 'banners')
//        {
//            $users = DB::table('articles')->where([['article', 'like', "%$file%"], ['id', '>', 325]])->get();
//            if(isset($users[0])) {
//                $cnt++;
//                echo $file . '<br>';
//            }
//        }
//        //if($cnt == 1) break;
//    }
//    closedir($handle);
//}
//echo 'COUNT - ' . $cnt;

