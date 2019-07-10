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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/create', 'NewsController@create')->name('news.create');
Route::post('/news/store', 'NewsController@store')->name('news.store');
Route::get('/news/{news}/edit', 'NewsController@edit')->name('news.edit');
Route::patch('/news/{news}', 'NewsController@update')->name('news.update');
Route::delete('/news/{news}', 'NewsController@destroy')->name('news.destroy');
