<?php

namespace starproject\controllers;

use starproject\http\Router;
use starproject\tools\Selector;
use starproject\database\Articles; // <= UPDATE | CREATE | DELETE -> array content
//use \Envms\FluentPDO\Query; *dont use before you read Info.txt
use starproject\database\costumers\Member;
use starproject\arraybasics\MDR;

class ArticlesController extends Articles{

    public $all,$img,$descript,$names;
    private $_selector,$_member;
    
    public function __construct(Selector $selector, Member $member){
        $this->all = $this->getArticles();
        $this->names = array_keys($this->getArticles());
        $this->descript = array_column($this->getArticles(),'description');
        $this->img =  array_column($this->getArticles(),'img');
        $this->_selector = $selector;
        $this->_member = $member;
    }
  
    public function _SetAllowed(){
        if($this->_selector->article != 'empty' && $this->_selector->page != 'empty'){
            // string , array && string, array
            if(MDR::key_exists_r($this->_selector->article,$this->_selector->allowedAricles) && in_array($this->_selector->page,$this->_selector->allowedPages)){
                return true;    
            }
                return false;
        }
        return null;
    }
    public function _GetArticle(){
        if($this->_SetAllowed()){
            /* ["chapter"],["nadpisH1"],["smallH2"],["body"] */
            return $this->all[ucfirst($this->_selector->article)][$this->_selector->page];
        }
        return null;
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
    public function createPage(){
        if(!$this->_SetAllowed()){
            //return 'bb'; error msg you cannot use create function for invalid args exmp /create/ajdfgjahga/dada
        }
        // Cannot insert specific page sadly 
        $insert = ["chapter" => "","nadpisH1" => "","smallH2" => "","body" => ""];
        
        if(array_key_exists($this->_selector->page,$this->all[ucfirst($this->_selector->article)])){
            // return 'bbb';    error msg you cannot create something that exist !    
        }
        // we should somehow show msg Created 
        //? IDEA : return $blade->setView(view)->share(['variable'=>$newarray,'message'=>$msg])->run();
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