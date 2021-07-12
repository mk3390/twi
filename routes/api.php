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
Route::group([ 'prefix' => 'auth'], function (){
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signup', 'Api\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::post('getuser', 'Api\AuthController@getUser');
    });
});

Route::post('upload', 'PostConroller@uploadImages');
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('list/{id?}', 'PostController@index');
    Route::get('search/{keyword}', 'AuthController@search');
    Route::post('post', 'PostController@store');
    Route::post('comment', 'CommentController@store');
    Route::post('reaction', 'ReactionController@store');
    Route::post('follow', 'FollowingController@store');
    Route::post('approve', 'FollowingController@approve');
    Route::post('reject', 'FollowingController@reject');
    Route::post('block', 'BlockController@store');
    Route::post('message', 'MessageController@store');
    Route::get('message/{id}', 'MessageController@index');
    Route::get('message/list', 'MessageController@index');
    Route::post('message/group', 'MessageGroupController@store');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
