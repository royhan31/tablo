<?php

use Illuminate\Http\Request;

Route::post('/user/register','API\AuthUserController@register');
Route::post('/user/login','API\AuthUserController@login');
Route::get('/user/complaint','API\ComplaintController@index');
Route::post('/user/complaint','API\ComplaintController@store');
Route::get('/user/complaint/{id}','API\ComplaintController@show');
Route::put('/user/complaint/{id}','API\ComplaintController@update');
Route::delete('/user/complaint/{id}','API\ComplaintController@destroy');


Route::get('news', 'API\NewsController@index');
Route::get('news/{news}', 'API\NewsController@show');
