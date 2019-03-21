<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'UserController@me');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::resource('/users', 'UserController');
    Route::resource('/articles', 'ArticleController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/comments', 'CommentController');
    Route::get('/articles/comments/{id}', 'ArticleController@comments');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
});
