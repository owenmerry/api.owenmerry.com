<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shared\Instagram;

class PhotoController extends Controller
{

    //auth
    public function auth()
    {
        return json_encode(Instagram::getAuth(request()['code']));       
    }

    //token
    public function accessToken()
    {
        return json_encode(
            array('token' => Instagram::getAccessToken())
        );       
    }

    public function setAccessToken(Request $request, $token)
    {
        $tokenBefore = Instagram::getAccessToken();
        Instagram::setAccessToken($token);
        return json_encode(
            array(
                'all' => $request->session()->all(),
                'tokenBefore' => $tokenBefore,
                'token' => Instagram::getAccessToken(),
                )
        );       
    }

    //access Token
    public function longLiveToken()
    {
        return json_encode(Instagram::getLongLiveAccessToken(request()['token']));     
    }

    public function refreshLongLiveToken()
    {
        return json_encode(Instagram::getRefreshLongLiveAccessToken(request()['token']));     
    }

    //user
    public function user()
    {
        return json_encode(Instagram::getUser(request()['token']));     
    }

    //me
    public function me()
    {
        return json_encode(Instagram::getMe(request()['token']));     
    }

    //media
    public function media()
    {
        return json_encode(Instagram::getMedia(request()['token']));     
    }

    public function mediaNextPage()
    {
        return json_encode(Instagram::getMediaPage(request()['token'], request()['pageToken'], 'after'));     
    }

    public function mediaPreviousPage()
    {
        return json_encode(Instagram::getMediaPage(request()['token'], request()['pageToken'], 'before'));     
    }

    //image
    public function image(Request $request, $imageid)
    {  
        return json_encode(Instagram::getImage($imageid,request()['token']));     
    }
}
