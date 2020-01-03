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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signUp', 'UserController@signUp');
Route::post('login', 'UserController@login');
Route::post('createProfile', 'UserController@createProfile');
Route::post('changePassword', 'UserController@changePassword');
Route::get('getJobs/{type}/{page}', 'UserController@getJobs');
Route::get('getJobDetail/{id}', 'UserController@getJobDetail');
Route::post('acceptRejectJobs', 'UserController@acceptRejectJobs');
Route::get('getNotifications/{page}', 'UserController@getNotifications');

Route::post('changeNotification', 'UserController@changeNotification');
Route::post('forgotpassword', 'UserController@forgotpassword');
Route::get('viewProfile', 'UserController@viewProfile');
Route::post('logout', 'UserController@logout');
Route::post('contactInfo', 'UserController@contactInfo');
Route::post('changeLocation', 'UserController@changeLocation');
