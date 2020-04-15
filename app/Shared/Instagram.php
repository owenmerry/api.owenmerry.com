<?php

namespace App\Shared;

use App\Shared\Curl;
use Illuminate\Http\Request;

class Instagram
{  


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

    public static function getUser($userid){
        $accessToken = Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/'. $userid .'?fields=id,username&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }

    public static function getMe(){
        $accessToken = Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/me?fields=id,username&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }

    public static function getMedia(){

        $accessToken = Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/me/media?fields=id,media_type,caption&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }

    public static function getImage($imageid){
        $accessToken = Self::getAccessToken();
        $userURL = 'https://graph.instagram.com/'.$imageid.'?fields=id,media_type,media_url,username,timestamp&access_token='. $accessToken;
        $json = Curl::curl_get($userURL);

        return $json;
    }



}


?>