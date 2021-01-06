<?php

namespace starproject\database\costumers;

use PDOStatement;
use \starproject\http\Router;
use \starproject\database\Datab;
use \starproject\database\costumers\Password;

class Member extends Password{

    private $_db;
    public $username,$permission,$email,$memberID,$logged;
   

public function __construct(Datab $db){
    // Data dont need be sanitazed they are from Register
    $this->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : 'visitor' ;
    $this->permission = (isset($_SESSION['permission'])) ? $_SESSION['permission'] : 'visit' ;
    $this->memberID = (isset($_SESSION['memberID'])) ? $_SESSION['memberID'] : rand(1,9999) ;
    $this->logged = (isset($_SESSION['loggedin'])) ? $_SESSION['loggedin'] : false ;
    $this->_db = $db->con();
 
}

public function isValidUsername($username){
    if (strlen($username) < 4) return false;
    if (strlen($username) > 25) return false;
    if (!ctype_alnum($username)) return false;

    return true;
}

public function login($username,$password){
    if (!$this->isValidUsername($username)) return false;
    if (strlen($password) < 5) return false;
    
    $stmt = $this->_db->from('members')->where('username',$username);
    $hash = $stmt->fetch('password');

    if($this->password_verify($password,$hash) == 1){
        return true;
    }
}

public function logout(){
    session_destroy();
    Router::redirect('index');
}

public function activate($REQUEST){
      //! unsecure only for testing
        $memberID = $REQUEST['x'];
        $active = $REQUEST['y'];
        $set = ['active'=>'YES'];
        $stmt = $this->_db->update('members',$set)->where('memberID',$memberID);
        $stmt->execute();
    Router::redirect('login?action=active');
 
}

public function userExist($username,$email){   
    $stmt = $this->_db->from('members');
    $row = $stmt->fetchPairs('username','email');
    if(array_key_exists($username,$row) || in_array($email,$row)){
        return true;
    }
    return false;
}

public function bookmark(){
    if(empty($this->bookmark)){
        $this->bookmark = 'member/'.$this->username.'?action=emptyBookmark';
            return $this->bookmark;
    }
        return $this->bookmark;

}

public function visible(){
    #
}

public function allMembers(){
    $stmt = $this->_db->from('members');
    $all = $stmt->fetchAll('username','name','surname','avatar','age','location','permission','visible');
    return $all;
}

}