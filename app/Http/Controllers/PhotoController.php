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

    //user
    public function user()
    {
        return json_encode(Instagram::getUser());     
    }

    //me
    public function me()
    {
        return json_encode(Instagram::getMe());     
    }

    //media
    public function media()
    {
        return json_encode(Instagram::getMedia());     
    }

    //image
    public function image(Request $request, $imageid)
    {  
        return json_encode(Instagram::getImage($imageid));     
    }
}
