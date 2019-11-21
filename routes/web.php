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

Route::get('/', 'WebsiteController@index');
Route::get('/catelogs/{id}', 'AlbumController@index');
Route::post('/mailto', 'ContactusController@contact');
Route::get('/flyer', 'FlyerController@index');
