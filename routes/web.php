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


Route::get('/','WelcomeController@index')->name('welcome');
Route::get('/about', 'AboutController@index')->name('about');

Route::resource('books', 'BookController');

Route::resource('users', 'UserController');

Route::resource('borrowings', 'PeminjamanController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('category/create', 'CategoryController@create')->name('category.create');
Route::post('category/store', 'CategoryController@store')->name('category.store');

Route::group(['prefix' => 'cetak'], function(){

    Route::get('/index','CetakController@index')->name('cetak');

    Route::get('/detail/{role}','CetakController@show')->name('cetak.detail');
    Route::get('/kartu/{role}','CetakController@cetak')->name('cetak.kartu');
});