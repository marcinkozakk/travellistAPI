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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group( function () {
    Route::get('/users/search', 'UsersController@search');
    Route::resource('users', 'UsersController')
        ->only(['show']);

    Route::get('travels/{type}/{id?}', 'TravelsController@index')
    ->where(['type' => 'home|my|user']);
    Route::resource('travels', 'TravelsController')
        ->only(['store', 'show', 'update', 'destroy']);

    Route::resource('notes', 'NotesController')
        ->only(['update', 'destroy']);
    Route::post('/notes/{travel_id}', 'NotesController@store');

    Route::resource('photos', 'PhotosController')
        ->only(['update', 'destroy']);
    Route::post('/photos/{travel_id}', 'PhotosController@store');

    Route::resource('follows', 'FollowsController')
        ->only(['index', 'show', 'store', 'destroy']);

    Route::resource('likes', 'LikesController')
        ->only(['store', 'destroy']);

});
