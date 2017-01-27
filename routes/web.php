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

Route::get('/', ['middleware' => 'guest', 'uses' => 'BooksController@getIndex']);
Route::get('auth/register', 'AuthAuthController@getRegister');
Route::post('auth/register', 'AuthAuthController@postRegister');
Route::get('auth/login', 'AuthAuthController@getLogin');
Route::post('auth/login', 'AuthAuthController@postLogin');
Route::get('auth/logout', 'AuthAuthController@getLogout');