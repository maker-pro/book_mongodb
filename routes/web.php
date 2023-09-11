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

Route::get('/', function () {
    return redirect('/index');
});



Route::get('/index', 'IndexController@index');
Route::get('/search', 'IndexController@search');
Route::get('/book/{id}', 'IndexController@book_detail')->where('id', '[0-9]+');
Route::get('/author/{name}', 'IndexController@author_detail');
Route::get('/press/{name}', 'IndexController@press_detail');
Route::get('/category/list', 'IndexController@category');
Route::get('/category/detail/{id}', 'IndexController@category_detail')->where('id', '[0-9]+');
Route::get('/about', 'IndexController@about');



Route::get('/error', 'ErrorController@index');
