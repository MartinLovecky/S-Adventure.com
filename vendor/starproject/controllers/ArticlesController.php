<?php

namespace starproject\controllers;

use starproject\database\Articles;


class ArticlesController extends Articles{
    
    public function _showArticles(){
        $Articles = $this->getArticles();
        foreach($Articles as $Article => $value){
            return $Article;
        }
    }
}