<?php

namespace starproject\http;

use eftec\bladeone\BladeOne;
use starproject\tools\Selector;
use starproject\fundemation\Config;

class Router extends Config{

public $urlName;

public function __construct(){
    $this->request = $_POST ?? null;
    $this->urlName = 'http://sadventure.com/';
}

public function _runApp(BladeOne $blade,Selector $selector){
    //Check allowed viewNames
    if($selector->allowedView()){
        return $blade->run('pages.'.$selector->viewName(),$this->data);
        //return $blade->run('layouts.app',$this->data);
    }
        return $blade->run('pages.404',$this->data);
}

public function url(string $string){
    switch($string){
        case '':
            $this->urlName;
            return $this;
        break;
        case '/':
            $this->urlName.'/index';
            return $this;
        break;    
        case '/show':
            $this->urlName.'/show';
            return $this;
        break;    
        case '/chars':
            $this->urlName.'/chars';
            return $this;      
        break;
        case '/login':
            $this->urlName.'/login';
            return $this;      
        break;
        case '/register':
            $this->urlName.'/register';
            return $this;      
        break;                                    
    }
}
public function mobile(array $options){
   if(empty($options)){
        $this->urlName;
        return $this;
   }
   if(array_key_exists('artName',$options)){
    $this->urlName = '/show/'.$options['artName'].'/1/';
    return $this;
   }
}
public function action(){
    return $this->urlName;
}

}