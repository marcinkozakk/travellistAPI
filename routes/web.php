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

Route::emailVerification();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/activated', function () {
    return view('activated');
});

Route::get('facebook/redirect', 'FacebookController@redirect');
Route::get('facebook/callback', 'FacebookController@callback');
Route::get('facebook/loginWithToken', 'FacebookController@loginWithToken');
