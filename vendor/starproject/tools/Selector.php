<?php

namespace starproject\tools;

use starproject\tools\Sanitazor;
use starproject\database\costumers\Member;

class Selector {

private $_member,$_sanitazor;
public $message,$OldData;
public $action;
public $article;
public $page = null;
public $url = [];
public $allowedAction = [];
public $allowedPages = [];
public $queryAction;
public $allowedAricles = [];
public $resetPWD = '';  
    
public function __construct(Member $member,Sanitazor $sanitazor){
    $this->_member = $member;
    $this->_sanitazor = $sanitazor;
    $this->url = explode('/',trim(str_replace(['-','_','#','<','(','{','!',','],' ',urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))));
    $this->action = $this->url[1]; // this is set all time
    $this->article = (isset($this->url[2])) ? $this->url[2] : 'empty'; 
    $this->page = (isset($this->url[3])) ? (int)$this->url[3] : 'empty'; //? if set xxx.com/ccc/cccc/{page} allways INT
    $this->allowedAction = ['editor','roster','login','logout','register','','reset','resetPassword','activate','member','404','terms','vop','index','show','create','update','delete','ultimate','kontakt'];
    $this->allowedAricles = ['allwin','samuel','isama','isamanh','isamanw','angel','mry','star','terror','demoni','hyperion'];
    $this->allowedPages = [range(1,300)];
    $this->queryAction = $sanitazor->sanitaze_GET('action') ?? null; 
    $this->resetPWD = $sanitazor->sanitaze_GET('x') ?? null; 
}

public function title(){
    if($this->action === ''){
        return 'Home';
    }elseif($this->action === 'show') {
        return $this->article.'-'.$this->page;
    }
        return $this->action;
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
    if($this->action == 'show' && $this->article != 'empty'){
            return 'article';
        }
    if($this->action == 'show' && $this->article == 'empty'){
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

public function getMessages($message){
    $this->message = $message;
    return $this->message;
}

public function oldData($data){
   $this->OldData = $data;
   return $this->OldData;
}

public function msgTitle(){
    //$selector->action != 'member' || $selector->action != 'show' || $selector->action != 'ultimate'
    if($this->action == 'member' || $this->action == 'show' || $this->action == 'ultimate'){
        return ;
    }
}

}