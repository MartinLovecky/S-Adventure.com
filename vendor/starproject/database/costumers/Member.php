<?php

namespace starproject\database\costumers;

use \starproject\database\DB as Database;
use starproject\database\costumers\Password;

class Member extends Password{

    private $_db,$_query;
    public $username,$role,$permission,$email,$memberID,$logged;
    public $memberName,$surname,$avatar,$age,$location,$resetToken,$resetComplete,$bookmark,$remeber;
    //! never store password or hash
    // TODO: public/private -> button for show/hide user info

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
    /*   Main idea is not write bunch of function for nothing... $_SESSION are set when user is registed otherwise use default value  */    
}
// remeber = $row['rember'] => checkbox to stay logged

public function isValidUsername($username){
    if (strlen($username) < 4) return false;
    if (strlen($username) > 25) return false;
    if (!ctype_alnum($username)) return false;
    return true;
}

public function login($username,$password){
    if (!$this->isValidUsername($username)) return false;
    if (strlen($password) < 5) return false;

    $row = $this->getHash($username);

    if($this->password_verify($password,$row['password']) == 1){
        return true;
    }
}
public function getHash($username){
    try{
        $stmt = $this->_db->prepare("SELECT `password`, username, memberID FROM members WHERE username = :username AND active='Yes'");
        $stmt->execute([':username'=>$username]);
        $hash = $stmt->fetch();
        return $hash['password'];
    }catch(PDOException $e){
        return $e;
    }
}

public function logout(){
    session_destroy();
    return \header('Location: http://sadventure.com/index');
}

public function activate(){
    if(!empty($this->_query) && isset($this->_query['x']) && isset($this->_query['y'])){
        $memberID = $this->_query['x'];
        $active = $this->_query['y'];
        $stmt = $this->_db->prepare("UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active");
        $stmt->execute([':memberID' =>$memberID,':active'=>$active]);
        if($stmt->rowCount() == 1){
            return \header('Location: http://sadventure.com/login?action=active'); 
        }
    }
    //fail ?
    return \header('Location: http://sadventure.com/login?action=failActive'); ;
}

/*
 public function uniqueUser($username){
       this is validation 
       $stmt = $this->_db->prepare("SELECT username FROM members WHERE username = :username");
       $stmt->execute([":username"=>$username]);
       $row = $stmt->fetch();
       return $row;
    }
*/
    
}