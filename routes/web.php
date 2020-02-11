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

Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/items', 'ItemsController@index')->name('items.index');
Route::post('/items', 'ItemsController@store')->name('items.store');
Route::get('/items/create', 'ItemsController@create')->name('items.create');
Route::get('/items/{item}/edit', 'ItemsController@edit')->name('items.edit');
Route::patch('/items/{item}', 'ItemsController@update')->name('items.update');
Route::delete('/items/{item}', 'ItemsController@destroy')->name('items.destroy');

Route::get('/menus', 'MenusController@index')->name('menus.index');
Route::get('/menus/create', 'MenusController@create')->name('menus.create');
Route::get('/menus/{menu}/edit', 'MenusController@edit')->name('menus.edit');
Route::get('/menus/{menu}', 'MenusController@show')->name('menus.show');
Route::post('/menus', 'MenusController@store')->name('menus.store');
Route::patch('/menus/{menu}', 'MenusController@update')->name('menus.update');
Route::delete('/menus/{menu}', 'MenusController@destroy')->name('menus.destroy');

