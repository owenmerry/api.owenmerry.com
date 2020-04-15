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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// photos api
Route::group(['prefix' => 'photos'], function () {
    Route::get('/all', function () {
        return Photo::all();
    });

    //instagram
    Route::get('/instagram/auth', ['as' => 'api.instagram.auth', 'uses' => 'PhotoController@auth']);
    Route::get('/instagram/accessToken', ['as' => 'api.instagram.accessToken', 'uses' => 'PhotoController@accessToken']);
    Route::get('/instagram/setAccessToken/{token}', ['as' => 'api.instagram.setAccessToken', 'uses' => 'PhotoController@setAccessToken']);
    Route::get('/instagram/user', ['as' => 'api.instagram.user', 'uses' => 'PhotoController@user']);
    Route::get('/instagram/me', ['as' => 'api.instagram.me', 'uses' => 'PhotoController@me']);
    Route::get('/instagram/media', ['as' => 'api.instagram.media', 'uses' => 'PhotoController@media']);
    Route::get('/instagram/image/{imageid}', ['as' => 'api.instagram.image', 'uses' => 'PhotoController@image']);
});
