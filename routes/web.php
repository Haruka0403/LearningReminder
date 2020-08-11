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
    Route::get('/reminder','CategoryController@remind');
    
    
    Route::get('/search','CategoryController@search');
    Route::get('/archive','CategoryController@archive');
    


// アーカイブコントローラ
    Route::get('/archive/detail','ArchiveController@detail');
    Route::get('/archive/detail/edit','ArchiveController@edit');
});