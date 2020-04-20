<?php

use Illuminate\Support\Facades\Route;
use App\Photo;
use App\Shared\Instagram;
use Illuminate\Http\Request;

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
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});



// group API
Route::group(['prefix' => 'api2'], function () {


    // photos API
    //------------------------------------------------
    Route::group(['prefix' => 'photos'], function () {
        Route::get('/all', function () {
            return Photo::all();
        });

        //instagram
        Route::get('/instagram/auth/old', function () {
            return json_encode(Instagram::getAuth($_GET['code']));
        });
        Route::get('/instagram/user/old', function (Request $request) {
            //$request->session()->put('insta','here is the data');
            Instagram::setSessionData();
            return $request->session()->get('insta');
            return json_encode(Instagram::getUser());
        });

        Route::get('/instagram/accessToken', ['as' => 'api.instagram.accessToken', 'uses' => 'PhotoController@accessToken']);
        Route::get('/instagram/setAccessToken/{token}', ['as' => 'api.instagram.setAccessToken', 'uses' => 'PhotoController@setAccessToken']);

        Route::get('/instagram/auth', ['as' => 'api.instagram.auth', 'uses' => 'PhotoController@auth']);
        
    
        Route::get('/instagram/user', ['as' => 'api.instagram.user', 'uses' => 'PhotoController@user']);
        Route::get('/instagram/me', ['as' => 'api.instagram.me', 'uses' => 'PhotoController@me']);
        Route::get('/instagram/media', ['as' => 'api.instagram.media', 'uses' => 'PhotoController@media']);
        Route::get('/instagram/image/{imageid}', ['as' => 'api.instagram.image', 'uses' => 'PhotoController@image']);
    });



});
