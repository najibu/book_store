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

//Book
Route::get('/', ['middleware' => 'guest', 'uses' => 'BooksController@getIndex']);

//Cart
Route::get('/cart', array('before' => 'auth.basic', 'as' => 'cart', 'uses' => 'CartsController@getIndex'));
Route::post('/cart/add', array('before' => 'auth.basic', 'uses' => 'CartsController@postAddToCart'));
Route::get('/cart/delete/{id}', array('before' => 'auth.basic', 'as' => 'delete_book_from_cart', 'uses' => 'CartsController@getDelete'));

//Order 
Route::post('/order', array('before' => 'auth.basic', 'uses' => 'OrdersController@postOrder'));
Route::get('/user/orders', array('before' => 'auth.basic', 'uses' => 'OrdersController@getIndex'));

//Auth
Auth::routes();
Route::get('/home', 'HomeController@index');
