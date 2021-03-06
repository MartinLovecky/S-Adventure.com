<?php

namespace starproject\database;

use \PDO;
use \PDOException;
use \starproject\database\DBcon;
use \Envms\FluentPDO\Query;

class Datab extends DBcon
{
    public $stateMode;
    public $version = 'dev';
    
    public function con()
    {
        // INSERT, UPDATE and DELETE queries will only run after you call ->execute()
        try {
            $dns = 'mysql:host='.$this->config[$this->stateMode]['DB_Host'].';dbname='.$this->config[$this->stateMode]['DB_Name'].';charset='.$this->config['other']['Char_Set'].'';
            $db = new PDO($dns, $this->config[$this->stateMode]['DB_User'], $this->config[$this->stateMode]['DB_Password']);
            // SET ATRR for PDO
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // fluent PDO
            $fpdo = new Query($db);
            return $fpdo;
        } catch (PDOException $Exception) {
            if ($Exception->getCode() == 2002) {
                echo '<b>Please send email to sadventure534@gmail.com with Subject: SA-2002 and Message: <span style="color:red;"> Database conection doesnt exits </span></b>';
                die;
            }
            $err = $Exception->getMessage() . (int)$Exception->getCode();
            throw new PDOException($err);
        }
    }
    
    public function getUserHash($hash)
    {
        $stmt = $this->con()->from('members')->where('remember', $hash);
        $userData = $stmt->fetchAll();
        return $userData;
    }
}
