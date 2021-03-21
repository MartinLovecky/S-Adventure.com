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
        $this->Article = $this->_GetArticle();
    } 
    
    public function _GetArticle(){
        if(in_array($this->_selector?->article,$this->_selector->allowedAricles)){
            $stmt = $this->_db->from($this->_selector->article)->where('page',$this->_selector->page);
            $result = $stmt->fetch();
            // [page=>int,chapter=> null/string,body=>longtext]
            return $result;
        }
        return null; // error
    }

    //! Insecure update/create/delete avaible only for admin !!!!!!
    public function update($request){
        // Each story is own table
        $set = ['chapter'=>$request['chapter'],'body'=>str_replace('&nbsp;','',$request['content'])];
        $stmt = $this->_db->update($request['article'])->set($set)->where('page', $request['page']);
        $stmt->execute();
            return header('Location: /update/'.$request['article'].'/'.$request['page']);
    }
    public function create($request){

    }
    public function delete($request){

    }
}
