<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TrendingGifsController@index')->name('trending.index');
Route::get('/search', 'SearchGifsController@index')->name('search.index');
Route::get('/random', 'RandomGifsController@index')->name('random.index');
Route::get('/modified', 'ModifiedGifsController@index')->name('modified.index');
Route::get('/modified/search', 'ModifiedGifsController@search')->name('modified.search');
