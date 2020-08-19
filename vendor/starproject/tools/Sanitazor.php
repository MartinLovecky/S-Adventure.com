<?php

namespace starproject\tools;

class Sanitazor{

    const FILTER_DEFAULT = 522;
    const FILTER_DEFAULT_FLAGS = 32;

    public function sanitaze_GET($string){
        $trimME = trim($string);
        return \filter_input(INPUT_GET,$trimME,self::FILTER_DEFAULT,self::FILTER_DEFAULT_FLAGS); 
    }
    public function sanitaze($string){
        $trimME = trim($string);
        return \htmlspecialchars($string,ENT_QUOTES,'UTF-8');
    }
    public function sanitazeEmail($string){
        $trimME = trim($string);
        $sanitaze = filter_var($trimME, FILTER_SANITIZE_EMAIL);
            return $sanitaze;
    }
}