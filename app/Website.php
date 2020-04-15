<?php

namespace App;


class Website
{  

public static function curl_get($url,$postfields)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url .'?'. $postfields);
    $data = curl_exec($ch);
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

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

public static function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

public static function getInstagramData(){
    // $accessCode = 'AQBvTHekvYWvMss-IjQ-ghVhV8c8KteIYfVsX6ejuxRifQoMTv-u2M40Nl3JcN_ADySt5BrY8kbNrh2yNraxrZwoEwCD8mRd7sP5CeQD-bsLiqG23ssESb8lKH50HwyTk51km_hznQESPt77AMcMhUaGLtWnNqFrPzorvj5VoEXr3aGKyjkfCx3ea3Ku56suvhoU8vXolN67B7_ZcLyy9ZFwN-qBwK0y57mGovQoE1SghA';
    // $accessURL = 'https://api.instagram.com/oauth/access_token';
    // $accessFields = 'client_id=224059088682130&client_secret=6f87654bf0d25e575deff03791588a04&grant_type=authorization_code&redirect_uri=https://food.owenmerry.com/auth&code='. $accessCode;
    
    // $html = self::curl_post($accessURL,$accessFields);

    $accessToken = 'IGQVJYak81R1dLTHdqcHJRMmRtTGpqczFXcFAyY2VZANlp6VFk0VW1mTWxaYXowbTZAkWDJvaWc1RnFlQV9qczdGQ3hkeUVIT3lzVXVJNjg2a0E1d3FCODRGQVpkbXl6VkoybUhsZAmZAIdzl2NGZAhQW9jbDJUQm9PNlBWR2pF';
    $userURL = 'https://graph.instagram.com/me';
    $userFields = 'fields=id,username&access_token='. $accessToken;

    $html = self::curl_get($userURL,$userFields);

    return $html;
}


public static function getWebsiteData($url){
  
        
$html = self::file_get_contents_curl($url);

    //echo "this". $html;
//parsing begins here:
$doc = new \DOMDocument();
@$doc->loadHTML($html);


//default variables
$title='';
$description='';
$image='';  
$images=''; 
    
//get and display what you need:
//$title = $doc->getElementsByTagName('title')->item(0)->nodeValue;
//$body = $doc->getElementsByTagName('body')->item(0)->nodeValue;

    
// get website 
$website_domain = parse_url($url, PHP_URL_HOST);
preg_replace('/^www./', '', $website_domain);      
    
   
    
    
    
    
// get title 
$nodes = $doc->getElementsByTagName('title');
if ($nodes->length > 0) {
    $title = $nodes->item(0)->textContent;
};
if($title==""){   
$metas = $doc->getElementsByTagName('meta');     
for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    //get og:image
    if($meta->getAttribute('property') == 'og:title')
        $image = $meta->getAttribute('content');
}
}
if($title==""){
  $nodes = $doc->getElementsByTagName('h1');
    if ($nodes->length > 0) {
        $title = $nodes->item(0)->textContent;
    };  
}; 
if($title==""){
  $nodes = $doc->getElementsByTagName('h2');
    if ($nodes->length > 0) {
        $title = $nodes->item(0)->textContent;
    };  
};

  
    
    
    
    
    
// get description & keywords
$metas = $doc->getElementsByTagName('meta');

for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    //get description
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    //get keywords
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
}
    
    
    
    
    
    

// get image
    //check if has og:image
$metas = $doc->getElementsByTagName('meta');    
for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    //get og:image
    if($meta->getAttribute('property') == 'og:image')
        $image = $meta->getAttribute('content');
}
if($image==""){
  $nodes = $doc->getElementsByTagName('img');
    if ($nodes->length > 0) {
        $title = $nodes->item(0)->getAttribute('src');
    };  
};     

    
    
    
    
    
    
//get images
$image_list = $doc->getElementsByTagName('img');
$images = array();

for ($i = 0; $i < $image_list->length; $i++)
    {
        $image_single = $image_list->item($i);
    
        if(!$image_single->getAttribute('src')==''){
            $images[] = $image_single->getAttribute('src');
        }
    }

 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //$image = $doc->getElementsByTagName('img');
    //$image = $doc->getElementsByTagName('img')->item(0)->getAttribute('src');
    //$image = $image_list->length;
 
        $data = [
            'url'=>$url,
            'title'=>$title,
            'description'=>$description,
            'image'=>$image,
            'images'=>$images,
            'domain'=>$website_domain,
                ];
            
    return $data;
    //return $data_image;
        
    }

}


?>