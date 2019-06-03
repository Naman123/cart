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
Route::get('/',['uses'=>'CartController@cartLanding']);
#Route::get('/cart',['uses'=>'CartController@cartLanding']);
Route::get('/list',['uses'=>'CartController@cartItemtList']);
Route::post('item/search',['uses'=>'CartController@searchItem']);
Route::post('item/save',['uses'=>'CartController@saveItem']);


