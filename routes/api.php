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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// api練習
//URLが/apiから始まる
//csrf保護無効=外部からアクセスできる
Route::group(['middleware' => ['api']], function(){
  Route::get('category', 'Api\CategoryController@index');
  Route::any('create', 'Api\CategoryController@create');
  Route::any('category_edit', 'Api\CategoryController@edit');
});