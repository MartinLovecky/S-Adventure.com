<?php

namespace starproject\http;

use eftec\bladeone\BladeOne;
use starproject\tools\Selector;
use starproject\fundemation\Config;

class Router extends Config{

public function __construct(){
    $this->request = $_POST ?? null;
}

public function _runApp(BladeOne $blade,Selector $selector){
    //Check allowed viewNames
    if($selector->allowedView()){
        return $blade->run('pages.'.$selector->viewName(),$this->data);
        //return $blade->run('layouts.app',$this->data);
    }
        return $blade->run('pages.404',$this->data);
}

}