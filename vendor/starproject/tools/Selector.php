<?php

namespace starproject\tools;

use starproject\http\Router;
use starproject\tools\Sanitazor;
use starproject\database\costumers\Member;

class Selector {

private $_member,$_sanitazor;
public $message,
    $oldData, 
    $action,
    $article,
    $page = null,
    $url = [],
    $allowedAction = [],
    $allowedPages = [],
    $queryAction,
    $allowedAricles = [],
    $resetPWD;  
    
public function __construct(Member $member,Sanitazor $sanitazor){
    $this->_member = $member;
    $this->_sanitazor = $sanitazor;
    $this->url = explode('/',trim(str_replace(['-','_','#','<','(','{','!',','],' ',urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))));
    // this is set all time
    $this->action = lcfirst($sanitazor->sanitaze($this->url[1])); 
    $this->article = (isset($this->url[2])) ? lcfirst($sanitazor->sanitaze($this->url[2])) : null;
    //! should be allways INT for articles 
    $this->page = (isset($this->url[3])) ? $this->url[3]: null;
    $this->allowedAction = include(DIR . '/core/app/allowedAction.php');
    $this->allowedAricles = ['allwin','samuel','isama','isamanh','isamanw','angel','mry','star','terror','demoni','hyperion'];
    $this->allowedPages = [range(1,300)];
    $this->queryAction = $sanitazor->sanitaze_GET('action');
    $this->resetPWD = $sanitazor->sanitaze_GET('x');
}

public function title(){
    if($this->action === '' || $this->action === 'index'){
        return 'SA | Home';
    }elseif($this->action === 'show') {
        return $this->article.'-'.$this->page;
    }
        return 'SA | '.ucfirst($this->action);
}

public function allowedView(){
    // return true false
    if (in_array($this->action,$this->allowedAction)) {
        return true; 
    }
        return false; 
}

public function viewName(){
    
    if($this->allowedView()){
    if($this->action == ''){
        return 'index';
    }
    if($this->action == 'show' && isset($this->article)){
            return 'article';
        }
    if($this->action == 'show' && !isset($this->article)){
        return 'roster';
    }
    if($this->action == 'create' || $this->action == 'update' || $this->action == 'delete'){
        if(isset($this->article) && in_array($this->article,$this->allowedAricles)){
            return 'editor';
        }
    }
    if($this->action == 'member'){
        return 'members';
    }
    if($this->action == 'member' && isset($this->article)){
        return 'profile';
    }
        return $this->action;
    }
    return '404';
}

}