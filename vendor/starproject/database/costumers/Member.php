<?php

namespace starproject\database\costumers;

use PDOStatement;
use \starproject\http\Router;
use starproject\database\Datab;
use \starproject\database\costumers\Password;

class Member extends Password{

    private $_db;
    public $username,$permission,$email,$memberID,$loggedin,$avatar,$remember,$bookmarks;

public function __construct(Datab $con,$userRemData = null){
    $this->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $userRemData['username'];
    $this->permission = (isset($_SESSION['permission'])) ? $_SESSION['permission'] : 'visit' ;
    $this->memberID = (isset($_SESSION['memberID'])) ? $_SESSION['memberID'] : rand(1,9999) ;
    $this->loggedin = (isset($_SESSION['loggedin'])) ? $_SESSION['loggedin'] : false ;
    $this->avatar = (isset($_SESSION['avatar'])) ? $_SESSION['avatar'] : 'empty_profile.png'; 
    $this->email = (isset($_SESSION['email'])) ? $_SESSION['email']  : null;
    $this->remember = (isset($_COOKIE['user.remember'])) ? true : false;
    $this->_db = $con->con();
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

public function userExist($username,$email){   
    $stmt = $this->_db->from('members');
    $row = $stmt->fetchPairs('username','email');
    if(array_key_exists($username,$row) || in_array($email,$row)){
        return true;
    }
    return false;
}

public function visible(){
    #
}

public function allMembers(){
    $stmt = $this->_db->from('members');
    $all = $stmt->fetchAll('username','name','surname','avatar','age','location','permission','visible');
    return $all;
}

public function getMemberID($request){
     // get old pwd from db create token
     $stmt = $this->_db->from('members')->where('email',$request['email']);
     $result = $stmt->fetchAll();
     if(!$result){
        return null;
     }
     foreach ($result as $key => $value){
        return $value;
     }
}

public function resetDBHash($request,$hash){
    //reset update reset DB
    $set = ['password'=>$hash,'resetComplete'=>'YES'];
    $stmt = $this->_db->update('members')->set($set)->where('memberID',$request['id'])->execute();
       return $stmt;
}

}