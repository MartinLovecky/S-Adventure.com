<?php

namespace starproject\controllers;

use \starproject\http\Router;
use \starproject\tools\Selector;
use \starproject\database\story\Articles; 
use \starproject\database\DB; 
use \Envms\FluentPDO\Query; 
use \starproject\database\costumers\Member;
use \starproject\arraybasics\MDR;
use \starproject\tools\Messages;

class ArticlesController extends Articles{

    public $Article;
    private $_selector,$_member,$_message,$_db;
    
    public function __construct(Selector $selector, Member $member, Messages $message, DB $db){
        $this->_selector = $selector;
        $this->_member = $member;
        $this->_message = $message;
        $this->_db = $db->con();
        $this->Article = $this->_GetArticle();
    } 
    public function _SetAllowed(){
        if($this->_selector->article != 'empty' && $this->_selector->page != 'empty'){
            // string , array && string, array
            if(MDR::key_exists_r($this->_selector->article,$this->_selector->allowedAricles) && MDR::in_array_r($this->_selector->page,$this->_selector->allowedPages)){
                return true;    
            }
                return false;
        }
        return null;
    }
    public function _GetArticle(){
        if($this->_SetAllowed()){
            $stmt = $this->_db->from($this->_selector->article)->where('page',$this->_selector->page);
            $result = $stmt->fetch();
            // [page=>int,chapter=> null/string,body=>longtext]
            return $result;
        }
        return null; // 
    }
    public function updatePage($request){
        // view secure permitions (inside Costumer) so we need only check request
        if(isset($request['submit']) && $request['type'] == 'update'){
            # RAW data Posted by trusted member [Admin or Editor];
            $r_chapter = isset($request['chapter']) ?? '';
            $r_nadpisH1 = isset($request['nadpisH1']) ?? '';
            $r_nadpisH2 = isset($request['nadpisH2']) ?? '';
            $r_smallH2 = isset($request['smallH2']) ?? '';
            $r_body = isset($request['body']) ?? '';
            // UPDATE
            if($this->_SetAllowed()){
                $this->_buffer = ['chapter'=>$r_chapter,'nadpisH1'=>$r_nadpisH1,'nadpisH2'=>$r_nadpisH2,'smallH2'=>$r_smallH2,'body'=>$r_body];
                $this->all[ucfirst($this->_selector->article)][$this->_selector->page] = $this->_buffer;
                    return $this;
                if(strlen($this->all[ucfirst($this->_selector->article)][$this->_selector->page]['body']) > 0){
                    return '<div role="alert" class="alert alert-success text-center text-success"><span>Úspěšne upraveno</span></div>';
                }
            }
                return '<div role="alert" class="alert alert-danger text-center text-danger"><span>Příběh a stránka musí být v URL zadaná</span></div>';
        }
        return null;
    }
    public function createPage($blade){
        if(!$this->_SetAllowed()){
            // error msg you cannot use create function for invalid args exmp /create/ajdfgjahga/dada
            return ['message'=>$this->_message->message(['error'=>'Nelze vytvořit stránku pro '.$this->_selector->article])];
        }
        // Cannot insert specific 'page'(key -> numeric ) sadly bcs that is not how array works
        // There is maybe 'Solution' lets say we want create page 120 but last page in Articles is 20, we could 'fill' 21-119 doable but propably not necesary IDK
        // expm. last in 'Allwin'[20][$insert] if we try /create/allwin/50 it will add to Allwin[21]

        $insert = ["chapter" => "","nadpisH1" => "","smallH2" => "","body" => ""];
        
        if(array_key_exists($this->_selector->page,$this->all[ucfirst($this->_selector->article)])){
            //you cannot create something that exist !   
            return ['message'=>$this->_message->message(['error'=>'Nelze vytvořit stránku číslo '.$this->_selector->page.' protože již existuje v příběhu '.$this->_selector->article])]; 
        }
        //return $blade->setView('view')->share(['variable'=>$newarray,'message'=>$this->_message->message(['success'=>''])->run();
        // return newarray = array_push($this->all[ucfirst($this->_selector->article),$insert]); 
    }
    public function deletePage(){
        #code
    }
    public function canReadPage(){
        if ($this->_selector->action == 'show' && $member->permission != 'visit'){
            return true;
        }
    }
    public function canUpdatePage(){
        if($this->_selector->action == 'update'){
        if($this->member->permission == 'edit' || $this->member->permission == 'all'){
            return true;
        }
            return Router::redirect('show/allwin/1?action=permission');
        }
    }
    public function canCreatePage(){
        if($this->_selector->action == 'create'){
            if($this->member->permission == 'all'){
                return true;
            }
            return Router::redirect('show/allwin/1?action=permission');
        }

    }
    public function canDeletePage(){
        if($this->_selector->action == 'delete'){
            if($this->member->permission == 'all'){
                return true;
            }
            return Router::redirect('show/allwin/1?action=permission');
        }
    }
}