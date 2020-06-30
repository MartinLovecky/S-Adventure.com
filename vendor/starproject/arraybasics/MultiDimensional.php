<?php

namespace starproject\arraybasics;

class MultiDimensional{

public static function in_array_r($needle, $haystack) {
    foreach ($haystack as $item) {
        if (($item == $needle) || array_key_exists($needle,$item)) {
            return true;
        }
    }
    return false;
}

} 