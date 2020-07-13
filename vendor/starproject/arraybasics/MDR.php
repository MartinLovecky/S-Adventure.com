<?php

namespace starproject\arraybasics;

class MDR{

public static function in_array_r($needle, $haystack) {
    // check if $value is iside array
    foreach ($haystack as $key => $value) {
        if ( $value == $needle || in_array($needle,$value)) {
            return true;
        }
    }
    return false;
}

public static function key_exists_r($needle,$haystack){
    foreach($haystack as $key => $value){
        if($key == $needle || array_key_exists($needle,$key)){
            return true;
        }
    }
    return false;
}


} 