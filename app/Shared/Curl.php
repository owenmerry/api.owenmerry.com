<?php

namespace App\Shared;


class Curl
{  

public static function curl_get($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = json_decode(curl_exec($ch));
    curl_close($ch);

    return $data;
}

public static function curl_post($url,$postfields)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

    $data = json_decode(curl_exec($ch));
    curl_close($ch);

    return $data;
}

public static function curl_contents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = json_decode(curl_exec($ch));
    curl_close($ch);

    return $data;
}



}


?>