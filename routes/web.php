<?php

use Illuminate\Support\Facades\Route;

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


//文章
Route::prefix('/write')->group(function(){
	Route::get('/','Admin\WriteController@index');
	Route::get('create','Admin\WriteController@create');
	Route::post('store','Admin\WriteController@store');
	Route::get('destroy/{id}','Admin\WriteController@destroy');
	Route::get('edit/{id}','Admin\WriteController@edit');
	Route::post('update/{id}','Admin\WriteController@update');
});
