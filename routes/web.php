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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/single/media/{id}',"MovieController@show");


Route::get('/latest/movies',"MovieController@index")->name('movie.list');
Route::get('/upcoming/movies',"MovieController@create")->name('upcoming.list');
Route::get('/latest/tv-show',"TvController@index")->name('tvshow.list');
Route::get('/search/movies/{id}',"SearchController@show");
