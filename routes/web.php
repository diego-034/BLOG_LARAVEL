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

Auth::routes();

Route::get('/home', 'PostController@List')->name('home');
Route::get('/profile/{id}', 'UserController@Find')->name('profile');

Route::get('/post/{id}', 'PostController@Find')->name('post');
Route::post('/post/update/{id}', 'PostController@Update');
Route::delete('/post', 'PostController@Delete')->name('post');
Route::get('/posts/{id}', 'PostController@Consult')->name('posts');
Route::post('/publish', 'PostController@Insert');

Route::post('/comment', 'CommentController@Insert');
Route::post('/comment/update/{id}', 'CommentController@Update');
Route::delete('/comment', 'CommentController@Delete');
Route::get('/comment', 'CommentController@List');





