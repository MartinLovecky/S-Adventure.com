<?php

namespace starproject\database\costumers;

use \starproject\database\DB as Database;
use \starproject\database\costumers\Password;
use \starproject\http\Router;

class Member extends Password{

    private $_db,$_query;
    public $username,$role,$permission,$email,$memberID,$logged;
    public $memberName,$surname,$avatar,$age,$location,$resetToken,$resetComplete,$bookmark,$remeber;

public function __construct(Database $db){
    // Data dont need be sanitazed they are from Register
    $this->username = $_SESSION['username'] ?? 'visitor';
    $this->role =  $_SESSION['role'] ??  null;
    $this->permission = $_SESSION['permission'] ?? 'visit';
    $this->email = $_SESSION['email'] ?? null;
    $this->memberID = $_SESSION['memberID'] ??  rand(1,9999);
    $this->_query = $_GET['action'] ?? null;
    $this->logged = $_SESSION['loggedin'] ?? false;
    // member INFO
    $this->memberName = $_SESSION['name'] ?? null;
    $this->surname = $_SESSION['surname'] ?? null;
    $this->avatar = $_SESSION['avatar'] ?? null;
    $this->age = $_SESSION['age'] ?? null;
    $this->location = $_SESSION['location'] ?? null;
    $this->resetToken = $_SESSION['resetToken'] ?? null;
    $this->resetComplete = $_SESSION['resetComplete'] ?? null;
    $this->bookmark = $_SESSION['bookmark'] ?? null;
    $this->_db = $db->con();
    // remeber = $row['rember'] => checkbox to stay logged  
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
    // only for existing user -> inside requestcontroller->validation->userExist
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

public function activate(){
    if(!empty($this->_query) && isset($this->_query['x']) && isset($this->_query['y'])){
        $memberID = $this->_query['x'];
        $active = $this->_query['y'];
        $set = ['active'=>'YES'];
        $stmt = $this->_db->update('members',$set,$memberID);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            Router::redirect('login?action=active');
        }
    }
    //fail 
    Router::redirect('login?action=failActive');
}

public function userExist($username){   
    $stmt = $this->_db->from('members')->where('username',$username);
    $row = $stmt->fetch();
    if($row['username'] !== $username){
         return false;
    }
    return true;
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