<?php

namespace App\Shared;

class Helpers
{  


    public static function print_json($object){

        $objectprint = (object) $object;

        return $objectprint;
    }


}


?>