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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


// カテゴリーコントローラ
Route::group(['middleware' => 'auth'], function() {    
    Route::get('/', 'CategoryController@top');
    Route::post('/', 'CategoryController@create');
    Route::get('/reminder','CategoryController@remind')->name('reminder');
    Route::post('/update', 'CategoryController@update');
    Route::get('/delete', 'CategoryController@delete');
    
    Route::get('/search','CategoryController@search');
    Route::get('/archive','CategoryController@archive');
    
// リマインドコントローラ
    Route::get('reminder/create','RemindController@add');
    Route::post('reminder/create','RemindController@create');
    Route::get('/reminder/edit','RemindController@edit');
    Route::post('/reminder/update','RemindController@update');
    Route::get('/reminder/delete','RemindController@delete');
    Route::get('/reminder/detail','RemindController@detail');

});

// ajax練習
// Route::get('/apiview', 'CategoryController@apiview');
// Route::get('/ajax', 'CategoryController@ajax');