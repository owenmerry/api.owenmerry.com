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
    
    Route::get('/instagram/long-live-token', ['as' => 'api.instagram.longlivetoken', 'uses' => 'PhotoController@longLiveToken']);
    Route::get('/instagram/refresh-long-live-token', ['as' => 'api.instagram.refreshlonglivetoken', 'uses' => 'PhotoController@refreshLongLiveToken']);
    
    Route::get('/instagram/accessToken', ['as' => 'api.instagram.accessToken', 'uses' => 'PhotoController@accessToken']);
    Route::get('/instagram/setAccessToken/{token}', ['as' => 'api.instagram.setAccessToken', 'uses' => 'PhotoController@setAccessToken']);
    
    Route::get('/instagram/user', ['as' => 'api.instagram.user', 'uses' => 'PhotoController@user']);
    Route::get('/instagram/me', ['as' => 'api.instagram.me', 'uses' => 'PhotoController@me']);
    
    Route::get('/instagram/media', ['as' => 'api.instagram.media', 'uses' => 'PhotoController@media']);
    Route::get('/instagram/media/next/{pageToken}', ['as' => 'api.instagram.media.next', 'uses' => 'PhotoController@mediaNextPage']);
    Route::get('/instagram/media/previous/{pageToken}', ['as' => 'api.instagram.media.previous', 'uses' => 'PhotoController@mediaPreviousPage']);
    Route::get('/instagram/image/{imageid}', ['as' => 'api.instagram.image', 'uses' => 'PhotoController@image']);

    Route::get('/fake/instagram/{item}', function () {
        return view('json.media');
    });
    Route::get('/fake/instagram/media/next/{item}', function () {
        return view('json.medianext');
    });
});
