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
});

//Auth::routes();
Route::post('login', 'Auth\LoginController@login');
Route::get('login',  'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dev', 'DevController@dev');

Route::get('/rubrika/articles/{name_en}', 'HomeController@rubrika')->name('rubrika');
Route::get('/rubrika/article/{name_en}', 'HomeController@article')->name('article');

Route::get('/sync-tilda', 'HomeController@syncTilda');

Route::group(['prefix'=>'lk', /*'middleware'=>['auth']*/], function () {
    Route::get('/', 'LkController@profile')->name('profile');
    Route::get('/profile', 'LkController@profile')->name('profile');
    Route::get('/logout', 'LkController@logout')->name('logout');
});

// для авторизации
Route::post('lk', 'LkController@profile')->name('profile');
Route::post('lk/profile', 'LkController@profile')->name('profile');
Route::post('/rubrika/article/{name_en}', 'HomeController@article')->name('article');