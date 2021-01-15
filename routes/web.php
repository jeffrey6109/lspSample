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

Route::get('/', 'PagesController@index');

Route::get('/search','PagesController@search');
Route::get('/searched','PagesController@searched');

Route::get('/records','PagesController@log');

Route::post('/products/{p_id}/added','PagesController@added');

Route::post('/{p_id}/sold','PagesController@minus');

Route::resource('products','ProductsController');

Route::get('/login','AccessController@Login');
Route::get('/logins',['login', 'uses' => 'AccessController@doLogin']);

Route::get('/register','AccessController@register');
Route::post('/registers','AccessController@doRegister');

Route::get('/logout','AccessController@logout');

Route::get('/dashboard', 'DashboardController@index');
