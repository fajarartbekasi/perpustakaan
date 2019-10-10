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

Route::resource('books', 'BookController');

// Route::group(['prefix' => 'books'], function(){

// 	route::get('/', 'BookController@index')->name('books');
// 	route::get('/create', 'BookController@create')->name('books.create');
// 	route::post('/store', 'BookController@store')->name('books.store');
// 	route::get('/edit/{book}', 'BookController@edit')->name('books.edit');
// 	route::put('/update/{book}', 'BookController@update')->name('books.update');

// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
