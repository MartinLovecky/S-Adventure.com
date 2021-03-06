<?php

namespace starproject\controllers;

use \starproject\http\Router;
use \starproject\tools\Selector;
use \starproject\database\story\Articles; 
use \starproject\database\Datab; 
use \starproject\database\costumers\Member;
use \starproject\tools\Messages;

class ArticlesController extends Articles{

    public $Article;
    private $_selector,$_member,$_message,$_db;
    
    public function __construct(Selector $selector, Member $member, Messages $message, Datab $db){
        $this->_selector = $selector;
        $this->_member = $member;
        $this->_message = $message;
        $this->_db = $db->con();
        // only for /show/article/PAGE
        $this->Article = $this->_GetArticle();
        
        
    } 
    //! fix
    public function _GetArticle(){
        if(in_array($this->_selector?->article,$this->_selector->allowedAricles)){
            $stmt = $this->_db->from($this->_selector->article)->where('page',$this->_selector->page);
            $result = $stmt->fetch();
            // [page=>int,chapter=> null/string,body=>longtext]
            return $result;
        }
        return null; // error
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
