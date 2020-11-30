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

Route::get('/list-peminjaman','ListpinjamController@index')->name('list-peminjaman');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('category/create', 'CategoryController@create')->name('category.create');
Route::post('category/store', 'CategoryController@store')->name('category.store');

Route::group(['prefix' => 'cetak'], function(){

    Route::get('/index','CetakController@index')->name('cetak');

    Route::get('/detail/{role}','CetakController@show')->name('cetak.detail');
    Route::get('/kartu/{role}','CetakController@cetak')->name('cetak.kartu');
});

Route::group(['prefix' => 'rekap-laporan'], function(){
    route::get('/buku', 'Laporan\LaporanbukuController@rekapbuku')->name('rekap-laporan.buku');
    route::get('/periode', 'Laporan\PeminjamanController@periode')->name('rekap-laporan.periode');
    route::get('/peminjaman', 'Laporan\PeminjamanController@peminjaman')->name('rekap-laporan.peminjaman');
});

Route::group(['prefix',  'notifikasi'], function(){
    route::get('informasi/{borrowing}','NotifikasismsController@create')->name('notifikasi.informasi');

    route::post('denda/{borrowing}','NotifikasismsController@denda')->name('notifikasi.denda');
    route::post('rimainder/{borrowing}','NotifikasismsController@rimainder')->name('notifikasi.rimainder');
});