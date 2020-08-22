<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('comments','CommentController@List');
Route::get('comments/{id}','CommentController@Find');
Route::post('comments','CommentController@Insert');
Route::post('comments/{id}','CommentController@Update');
Route::delete('comments','CommentController@Delete');

Route::get('users','UserController@List');
Route::get('users/{id}','UserController@Find');
Route::post('users','UserController@Insert');
Route::post('users/{id}','UserController@Update');
Route::delete('users','UserController@Delete');

Route::get('posts','PostController@Consult');
Route::get('posts/{id}','PostController@Find');
Route::post('posts','PostController@Insert');
Route::post('posts/{id}','PostController@Update');
Route::delete('posts','PostController@Delete');
