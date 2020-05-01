<?php

namespace starproject\http;

use eftec\bladeone\BladeOne;
use starproject\tools\Selector;
use starproject\fundemation\Config;

class Router extends Config{

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
            return $this->url;
        break;
        case '/':
            return $this->url.'index/';
        break;    
        case 'show':
            return $this->url.'show/';
        default:
            return $this;            
    }
}
public function mobile(string $string,Selector $selector){
    if($string === 'memberName'){
        // insiside DB is Visitor his data are used when PPL are not logged_in
        $this->subURL = $this->urlName.'member/'.$selector->get('memberName',$_SESSION['memberName']);
        return $this->subURL;
    }
    if($string === 'viewName'){
        //! Fixme this wont work $selector->article pick currenct /show/{article} we need second att 
        $this->subURL = $this->urlName.'show/'.$selector->article.'/1';
        return $this->subURL;
    }
}

}