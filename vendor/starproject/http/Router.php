<?php

namespace starproject\http;

use eftec\bladeone\BladeOne;
use starproject\tools\Selector;

class Router{

public $data = [];
public $request = [];

public function __construct(){
    $this->request = (isset($_POST['submit'])) ?? [];
}

public function _runApp(BladeOne $blade,Selector $selector){
    $view = $selector->viewName();
    //Check allowed viewNames
    if($selector->allowedView()){
        return $blade->run('pages.'.$view,$this->data);
    }
        return $blade->run('pages.404',$this->data);
}

}