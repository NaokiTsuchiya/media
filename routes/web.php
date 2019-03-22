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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('post', 'PostController@new')->name('post.new');
Route::post('post', 'PostController@create')->name('post.create');
Route::get('/{user}/posts/{post_id}', 'PostController@show');
Route::get('/posts/{post_id}/edit', 'PostController@edit')->name('post.edit');
Route::post('/posts/{post_id}/update', 'PostController@update')->name('post.update');
Route::post('/posts/{post_id}/delete', 'PostController@delete')->name('post.delete');
