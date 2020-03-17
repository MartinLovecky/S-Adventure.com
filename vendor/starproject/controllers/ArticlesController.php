<?php

namespace starproject\controllers;

use starproject\http\Router;
use starproject\tools\Selector;
use starproject\database\Articles;
use starproject\arraybasics\MultiDimensional;

class ArticlesController extends Articles{

    public $all,$urls,$img;
    private $_selector,$_ArticleArray;
    
    private function _ArrayName(){
        if($selector->article != 'empty' && $selector->page != 'empty'){
            $this->_ArticleArray = $this->all[ucfirst($this->_selector->article)][$this->_selector->page];
            return $this->_ArticleArray;
        }
        return null;
    }

    public function __construct(Selector $selector){
        $this->all = $this->getArticles();
        $this->names = array_keys($this->getArticles());
        $this->_selector = $selector;
        // $this->descript = array_column($this->getArticles(),'description');
        //$this->urls = array_column($this->getArticles(),'url');
        //$this->imgs =  array_column($this->getArticles(),'img');

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
        if($this->_selector->article !== 'empty' && $this->_selector->page !== 'empty'){
            if(in_array($this->_selector->article,$this->_selector->allowed) && in_array($this->_selector->page,$this->_selector->_allowedPage)){
                return true;    
            }
            return false; 
        }
        return false;
    }

    public function _GetArticle(){
        if($this->_SetAllowed()){
            /* ["chapter"],["nadpisH1"],["smallH2"],["body"] */
            return $this->all[ucfirst($this->_selector->article)][$this->_selector->page];
        }
        return null;
    }
    public function updateArticle(Router $router){
        // view secure permitions (inside Costumer) so we need only check request
        if(isset($router->request['submit']) && $router->request['type'] == 'update'){
            # RAW data Posted by trusted member [Admin or Editor];
            $r_chapter = isset($router->request['chapter']) ?? '';
            $r_nadpisH1 = isset($router->request['nadpisH1']) ?? '';
            $r_nadpisH2 = isset($router->request['nadpisH2']) ?? '';
            $r_smallH2 = isset($router->request['smallH2']) ?? '';
            $r_body = isset($router->request['body']) ?? '';
            // UPDATE
            if($this->_ArrayName() !== null){
                $this->_ArticleArray = ['chapter'=>$r_chapter,'nadpisH1'=>$r_nadpisH1,'nadpisH2'=>$r_nadpisH2,'smallH2'=>$r_smallH2,'body'=>$r_body];
                return '<div role="alert" class="alert alert-success text-center text-success"><span>Úspěšne upraveno</span></div>';
            }
                return '<div role="alert" class="alert alert-danger text-center text-danger"><span>Příběh a stránka musí být v URL zadaná</span></div>';
        }
        return null;
    }
    public function create(Router $router){
        // Request -> $request = ['page' => [10 => ['chapter','body'=>'']]];
        // Selector -> $selector = ['article'=>'allwin','page'=>'10'];
        // Articles -> $articles = ['Allwin'=>[1=>['chapter','body'=>'']]];
        // ADD new to existing
        $this->_ArticleArray = $router->request['page'];

    }
}