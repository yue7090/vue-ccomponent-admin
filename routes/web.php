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
Route::resource('/admin','AdminController');
Route::resource('/component','ComponentController');
Route::get('component/getById/{id}','ComponentController@getById');
// Route::post('/component/getComponentById/{id}','ComponentController@getComponentById');
Route::resource('/page','PageController');
Route::resource('/app','AppController');