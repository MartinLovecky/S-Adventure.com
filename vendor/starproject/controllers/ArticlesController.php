<?php

namespace starproject\controllers;

use starproject\tools\Selector;
use starproject\database\Articles;
use starproject\arraybasics\MultiDimensional;

class ArticlesController extends Articles{

    public $all,$img,$descript,$names;
    private $_selector,$_buffer;
    
    public function __construct(Selector $selector){
        $this->all = $this->getArticles();
        $this->names = array_keys($this->getArticles());
        $this->descript = array_column($this->getArticles(),'description');
        $this->img =  array_column($this->getArticles(),'img');
        $this->_selector = $selector;
    }
    /*
    public function _GetKey(String $text){
        if(MultiDimensional::in_array_r($text,$this->getArticles())){
            if($selector->article != 'empty' && $selector->page != 'empty'){
                return array_column($this->all[ucfirst($this->_selector->article)][$this->_selector->page],$text);
            }
                return null;
        }
    }*/
    public function _SetAllowed(){
        if($this->_selector->article != 'empty' && $this->_selector->page != 'empty'){
            // string , array && string, array
            if(MultiDimensional::in_array_r($this->_selector->article,$this->_selector->allowedAricles) && MultiDimensional::in_array_r($this->_selector->page,$this->_selector->allowedPages)){
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

    public function updateArticle($request){
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
    public function create($request){
        // Request -> $request = ['page' => [10 => ['chapter','body'=>'']]];
        // Selector -> $selector = ['article'=>'allwin','page'=>'10'];
        // Articles -> $articles = ['Allwin'=>[1=>['chapter','body'=>'']]];
        // ADD new to existing
        $this->_ArticleArray = $request['page'];

    }
    public function delete(){
        
    }
}