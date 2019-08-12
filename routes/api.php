<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/', 'ApiV1\RubrikController@index');
Route::get('/menu', 'ApiV1\RubrikController@menu');
Route::get('/rubrics/{id}', 'ApiV1\RubrikController@showRubrik');
Route::get('/articles/{id}', 'ApiV1\RubrikController@showArticle');
Route::get('/getAuthToken', 'ApiV1\RubrikController@getAuthToken');
