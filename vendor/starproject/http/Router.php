<?php

namespace starproject\http;

use eftec\bladeone\BladeOne;

class Router {

public $request;
public $data;

public function __construct(){
    $this->request = (isset($_POST['submit'])) ? $_POST : null ;
}

public function runApp(BladeOne $blade){
    //Check allowed viewNames
    $selector = $this->data['selector'];
    if($selector->allowedView()){
        return $blade->run('pages.'.$selector->viewName(),$this->data);
        //return $blade->run('layouts.app',$this->data);
    }
        return $blade->run('pages.404',$this->data);
}

public static function redirect($location = null){
    if($location){
        if(is_numeric($location)){
            switch($location){
                case 404:
                    header('HTTP/1.0 404 Not Found');
                    include(DIR.'/views/pages/404.balde.php');
                    exit();
                break;
            }
        }
        header('Location: http://sadventure.com/'.$location.'');
    }
}

}