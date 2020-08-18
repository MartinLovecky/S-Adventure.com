<?php

namespace starproject\tools;

class Sanitazor{

    
    const filter_default = FILTER_SANITIZE_FULL_SPECIAL_CHARS;
    const filter_default_flags = 32;

    public function sanitaze_GET($string){
        $trimME = trim($string);
        return \filter_input(INPUT_GET,$trimME,filter_default,filter_default_flags); 
    }

    public function sanitaze($string){
        $trimME = trim($string);
        return \htmlspecialchars($string,ENT_QUOTES,'UTF-8');
    }
}