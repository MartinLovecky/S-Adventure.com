<?php

namespace starproject\database\story;

use \starproject\database\DB;
use \starproject\database\story\Articles;
use \Envms\FluentPDO\Query;

class ArticlesDB extends Articles{

private $_db;

public function __construct(DB $db){
    $this->_db = $db->con();
}

public function getArticle($story,$page){

    $stmt = $this->_db->from($story)->where('page',$page);
    $result = $stmt->fetch();
        return $result;

}
    
}