<?php

namespace starproject\tools;

use \starproject\database\DB;
use starproject\tools\Messages;
use starproject\database\costumers\Password;

class Validation extends Password{

private $_db,$_message;    
    
public function __construct(DB $db,Messages $message){
    $this->_db = $db->con();
    $this->_message = $message;
}

private function _emptyFields(array $Fields){
    foreach($Fields as $Field => $value){
        if(empty($value)){
            return true;
        }
        return false;
    }
}

public function validateRegister($request){
    if($request['persistent_register'] == 'yes'){  
        $username = htmlentities($request['username'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars_decode($request['email'],ENT_QUOTES);
        $password = htmlentities($request['password'], ENT_QUOTES, 'UTF-8');
        $password_again = htmlentities($request['password_again'], ENT_QUOTES, 'UTF-8');
        // check empty filelds
        if($this->_emptyFields([$username,$email,$password,$password_again]))return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
        // chceck db
        $stmt = $this->_db->prepare("SELECT username FROM members WHERE username = :username");
        $stmt->execute([":username"=>$username]);
        $row = $stmt->fetch();
        if(!empty($row['username']))return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno se již používá'])];
        if(empty($username) || empty($email) || empty($password) || empty($password))return ['message'=>$this->_message->error('Všechna pole musí být vyplněna')];
        if (strlen($username) < 4) return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno musí obsahovat minimálně 4 znaky'])];
		if (strlen($username) > 25) return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno může obsahovat maximálně 25 znaků'])];
		if (!ctype_alnum($username))return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno obsahuje neplatné znaky'])];
        if(mb_strlen($password) < 6 || mb_strlen($password_again) < 6) return ['message'=>$this->_message->message(['error'=>'Heslo musí mít nejméně 6 znaků'])];
        if($password != $password_again)return ['message'=>$this->_message->message(['error'=>'Heslo se musí schodovat'])];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))return ['message'=>$this->_message->message(['error'=>'Prosím zadajte platný email'])];
            return  ['username'=>$username,'password'=>$password,'email'=>$email];
    }else{
            return ['message'=>$this->_message->message(['error'=>'Pro úspěšnou registraci musíte souhlasit s VOP a Terms'])];
    }
}

public function setSession($username,$password){
    $stmt = $this->_db->prepare("SELECT `password`, username, memberID,email FROM members WHERE username = :username AND active='Yes'");
	$stmt->execute([':username'=>$username]);
    $row = $stmt->fetch();
    if($this->password_verify($password,$row['password']) == 1){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['memberID'] = $row['memberID'];
        $_SESSION['email'] = $row['email'];
        return true;
    }
}

public function validateLogin($request){
    $username = htmlentities($request['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlentities($request['password'], ENT_QUOTES, 'UTF-8');
    if($this->_emptyFields([$username,$password]))return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if (strlen($username) < 4) return ['message'=>$this->_message->message(['error'=>'Uživatelskí jméno musí obsahovat více jak 4 znaky'])];
	if (strlen($username) > 11) return ['message'=>$this->_message->message(['error'=>'Uživatelskí jméno nesmí obsahovat více jak 11 znaků'])];
    if (!ctype_alnum($username)) return ['message'=>$this->_message->message(['error'=>'Uživatelskí jméno má nesprávný tvar'])];
    if (strlen($password) < 5) return ['message'=>$this->_message->message(['error'=>'Heslo musí být delší jak 5 znaků'])];
    //Check DB
    $stmt = $this->_db->prepare("SELECT username FROM members WHERE username = :username");
    $stmt->execute([":username"=>$username]);
    $row = $stmt->fetch();
    if($row['username'] !== $username)return['message'=>$this->_message->message(['error'=>'Uživatel nexistuje,<a href="">registrovat ?</a>'])];
    if ($this->setSession($username,$password))return ['username'=>$username,'password'=>$password];
}

public function validateResetMail($request){
    $email = htmlspecialchars_decode($request['email'], ENT_QUOTES);
    if($this->_emptyFields([$email]))return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))return['message'=>$this->_message->message(['error'=>'Zadejte prosím platný email'])];
    // Check DB
    $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
    $stmt->execute([':email']);
    $row = $stmt->fetch();
    if($row['email'] != $email)return['message'=>$this->_message->message(['error'=>'K zadému emailu neexistuje žádný účet'])];
    return ['email'=>$email];

}

}