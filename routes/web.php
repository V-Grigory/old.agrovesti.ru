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
    // анжелино
    Route::resource('/rubrik', 'RubrikController', ['as'=>'wpadmin']);
    Route::post('/rubrik/uploadImageTemplate', 'RubrikController@uploadImageTemplate')->name('wpadmin.rubrik.uploadImageTemplate');
    Route::resource('/article', 'ArticleController', ['as'=>'wpadmin']);
    Route::resource('/banners', 'BannerController', ['as'=>'wpadmin']);

    Route::get('/tilda', 'TildaController@articles')->name('wpadmin.tilda.articles'); // вместо index
    // ленино
    Route::get('/clients/readers', 'ClientController@readers')->name('wpadmin.clients.readers'); // вместо index
    Route::get('/clients/readersvue', 'ClientController@readersVue')->name('wpadmin.clients.readersvue');
    //Route::post('/clients/search', 'ClientController@search')->name('wpadmin.clients.search'); // не используется (есть в контроллере)
    Route::post('/clients/massActions', 'ClientController@massActions')->name('wpadmin.clients.massActions');
    Route::resource('/clients', 'ClientController', ['as'=>'wpadmin']);
});

//Auth::routes();
Route::post('login', 'Auth\LoginController@login');
Route::get('login',  'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dev', 'DevController@dev');

Route::get('/rubrika/articles/{name_en}', 'HomeController@rubrika')->name('rubrika');
Route::get('/rubrika/article/{name_en}', 'HomeController@article')->name('article');

// служебные
Route::get('/sync-tilda', 'HomeController@syncTilda');
Route::get('/checkClientsRangePay', 'HomeController@checkClientsRangePay');

Route::group(['prefix'=>'lk', /*'middleware'=>['auth']*/], function () {
    Route::get('/', 'LkController@profile')->name('profile');
    Route::get('/profile', 'LkController@profile')->name('profile');
    Route::get('/logout', 'LkController@logout');
});

// для авторизации/само-регистрации клиентов
Route::post('lk', 'LkController@profile')->name('profile');
Route::post('lk/profile', 'LkController@profile')->name('profile');
Route::post('/rubrika/article/{name_en}', 'HomeController@article')->name('article');