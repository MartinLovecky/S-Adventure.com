<?php

namespace starproject\tools;

use starproject\database\costumers\Member;

class Selector{

public $url,$action,$article,$page;    
private $allowed;

public function __construct(){
    $this->url = explode('/',trim(str_replace(['-','_','#','<','(','{','!',','],' ',urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))));
    $this->action = $this->url[1]; // this is set all time
    $this->article = (isset($this->url[2])) ? $this->url[2] : 'empty'; 
    $this->page = (isset($this->url[3])) ? $this->url[3] : 'empty';
    $this->allowed = ['editor','roster','login','logout','register','','reset','resetPassword','activate','member','404','terms','vop','index','test','show','create','update','delete','allwin','samuel','isama','isamanh','isamanw','angel','mry','star','terror','demoni'];
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
    if(in_array($this->action,$this->allowed)){
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
        default:        
        return $this->action;
        break;
        }
    }
    if (\count($this->url) > 3) {
        return '404';
    }
}
public function allowedView(){
    // return true false
    if (in_array($this->action,$this->allowed)) {
        return true; 
    }
        return false; 
}
public function emptyArticle(){
    if($this->article != 'empty' && \is_string($this->article)){
        return true;
    }
        return false;
}
public function emptyPage(){
    if( \is_int($this->page) || \is_string($this->page)){
        return true;
    }
    if($this->page == 'empty'){
        return false;
    }
}
public function query(){
    return (isset($_SERVER["QUERY_STRING"])) ?? null;
}
public function get(String $string,Member $member){
    list($logged,$member,$memberID,$name,$surname,$avatar,$age,$location) = $member->is_logged_in();
    switch ($string) {
        case 'memberID':
            return $memberID;
                break;
        case 'member':
            return $member;
                break;
        case 'logged':
            return $logged;
                break;
        case 'name':
            return $name;
                break;
        case 'surname':
            return $surname;
                break;
        case 'avatar':
            return $avatar;
                break;
        case 'age':
            return $age;
                break;
        case 'location':
            return $location;
                break;                
    }
}
}