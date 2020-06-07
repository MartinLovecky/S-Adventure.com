<?php

namespace starproject\tools;

use starproject\database\costumers\Member;

class Selector {

private $_member;
public $message,$OldData;
public $action = '';
public $article = '';
public $page = null;
public $url = [];
public $allowedAction = [];
public $allowedPages = [];
public $queryAction = '';
public $allowedAricles = [];
public $resetPWD = '';  
    
public function __construct(Member $member){
    $this->_member = $member;
    $this->url = explode('/',trim(str_replace(['-','_','#','<','(','{','!',','],' ',urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))));
    $this->action = $this->url[1]; // this is set all time
    $this->article = (isset($this->url[2])) ? $this->url[2] : 'empty'; 
    $this->page = (isset($this->url[3])) ? (int)$this->url[3] : 'empty'; //? if set xxx.com/ccc/cccc/{page} allways INT
    $this->allowedAction = ['editor','roster','login','logout','register','','reset','resetPassword','activate','member','404','terms','vop','index','test','show','create','update','delete'];
    $this->allowedAricles = ['allwin','samuel','isama','isamanh','isamanw','angel','mry','star','terror','demoni','hyperion'];
    $this->allowedPages = [range(1,300)];
    $this->queryAction = $_GET['action'] ?? null; //! SANITAZE via blade {{$selector->queryAction}}
    $this->resetPWD = $_GET['x'] ?? null;
}

public function title(){
    if($this->action === ''){
        return 'Home';
    }elseif($this->action === 'show') {
        return $this->article.'-'.$this->page;
    }
        return $this->action;
}

public function viewName(){
    if($this->allowedView() && $this->article == 'empty'){
        switch($this->action){
        case '':
            return 'index'; 
        break;
        case 'show':
            return 'roster'; 
        break;
        case 'create':
            return 'editor'; 
        break;
        case 'delete':
            return 'editor'; 
        break;
        case 'update':
            return 'editor'; 
        break;
        case 'member':
            return 'members';                        
        default:        
            return $this->action;
        }
    }
    if(isset($this->article) && in_array($this->article,$this->allowedAricles)){
        return 'article';
    }
    if($this->action == 'member' && isset($this->article)){
        return 'profile';
    }

    if (\count($this->url) >= 4) {
        return '404';
    }
    return '404';
}

public function allowedView(){
    // return true false
    if (in_array($this->action,$this->allowedAction)) {
        return true; 
    }
        return false; 
}

public function getMessages($message){
    $this->message = $message;
    return $this->message;
}

public function oldData($data){
   $this->OldData = $data;
   return $this->OldData;
}


}