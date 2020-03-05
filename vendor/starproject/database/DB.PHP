<?php

namespace starproject\database;

use PDO;
use PDOException;
use starproject\database\DBcon;

class DB extends DBcon{

    public function con(){
        try{
            $dns = 'mysql:host='.$this->config[$this->stateMode]['DB_Host'].';dbname='.$this->config[$this->stateMode]['DB_Name'].';charset='.$this->config['other']['Char_Set'].'';
            $db = new PDO($dns,$this->config[$this->stateMode]['DB_User'],$this->config[$this->stateMode]['DB_Password']);
            // SET ATRR for PDO
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
            }catch(PDOException $Exception){
                $err = $Exception->getMessage() . (int)$Exception->getCode();
                return dump($err);
            }
    }
}