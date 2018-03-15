<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'wpadmin', 'namespace'=>'Wpadmin', 'middleware'=>['auth']], function (){
    Route::get('/', 'DashboardController@dashboard')->name('wpadmin.index');
    Route::resource('/rubrik', 'RubrikController', ['as'=>'wpadmin']);
    Route::resource('/article', 'ArticleController', ['as'=>'wpadmin']);
    Route::resource('/banners', 'BannerController', ['as'=>'wpadmin']);
    Route::resource('/{page}', 'PageController', ['as'=>'wpadmin']);
});

//Route::get('/', function () {
//    return view('page.welcome');
//    //return view('main');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/dev', 'DevController@dev');

Route::get('/rubrika/articles/{name_en}', 'HomeController@rubrika')->name('rubrika');
Route::get('/rubrika/article/{name_en}', 'HomeController@article')->name('article');

Route::get('/{page}', 'HomeController@page')->name('page');
