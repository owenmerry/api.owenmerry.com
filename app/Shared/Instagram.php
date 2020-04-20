<?php

namespace App\Shared;

use App\Shared\Curl;
use App\Shared\Helpers;
use Illuminate\Http\Request;

class Instagram
{  


    //access
    public static function getAuth($code){

        $authCode = $code;
        $authURL = 'https://api.instagram.com/oauth/access_token';
        $authFields = 'client_id='. env('INSTAGRAM_APP_ID') .'&client_secret='. env('INSTAGRAM_SECRET') .'&grant_type=authorization_code&redirect_uri=https://food.owenmerry.com/auth&code='. $authCode;
        
        $json = Curl::curl_post($authURL,$authFields);
        if(isset($json->{'access_token'})){
            Self::setAccessToken($json->{'access_token'});
        }

        return $json;
    }

    public static function setAccessToken($code){ 
        request()->session()->put('instagram-accesstoken', $code);

        return true;
    }

    public static function getAccessToken(){
        return request()->session()->get('instagram-accesstoken');
    }

    //long live tokens
    public static function getLongLiveAccessToken($token){

        $accessToken = $token ?? Self::getAccessToken();
        $accessURL = 'https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret='. env('INSTAGRAM_SECRET') .'&access_token='. $accessToken;
        $json = Curl::curl_get($accessURL);

        return $json;
    }

    public static function getRefreshLongLiveAccessToken($token){

        $accessToken = $token ?? Self::getAccessToken();
        $accessURL = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token='. $accessToken;
        $json = Curl::curl_get($accessURL);

        return $json;
    }


    // user data
    public static function getUser($userid, $token){
        $accessToken = $token ?? Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/'. $userid .'?fields=id,username&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }

    public static function getMe($token){
        $accessToken = $token ?? Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/me?fields=id,username&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }


    // media data
    public static function getMedia($token){

        $accessToken = $token ?? Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/me/media?fields=id,media_type,media_url,caption&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }

    public static function getMediaPage($token, $pageToken, $direction = 'after'){
        $accessToken = $token ?? Self::getAccessToken();
        $mediaURL = 'https://graph.instagram.com/me/media?fields=id,media_type,media_url,caption&limit=25&'. $direction .'='. $pageToken .'&access_token='. $accessToken;
        $json = Curl::curl_get($mediaURL);

        return $json;
    }

    // image data
    public static function getImage($imageid,$token){
        $accessToken = $token ?? Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/'.$imageid.'?fields=id,media_type,media_url,username,timestamp&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }



}


?>