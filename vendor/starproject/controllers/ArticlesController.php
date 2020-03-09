<?php

namespace starproject\controllers;

use starproject\database\Articles;
use starproject\arraybasics\MultiDimensional;

class ArticlesController extends Articles{

    public $all,$descript,$urls,$img;
    
    public function __construct(){
        $this->all = $this->getArticles();
        $this->names = array_keys($this->getArticles());
        //Maybe usefull for next steps
        // $this->descript = array_column($this->getArticles(),'description');
        //$this->urls = array_column($this->getArticles(),'url');
        //$this->imgs =  array_column($this->getArticles(),'img');

    }

    /* Maybe usefull for next steps
    public function _GetDescription(){
        if(MultiDimensional::in_array_r('description',$this->getArticles())){
           $this->descript = array_column($this->getArticles(),'description');
        }
    }*/

}