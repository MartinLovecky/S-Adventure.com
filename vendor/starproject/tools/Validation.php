<?php

namespace starproject\tools;

use starproject\tools\Messages;
use \starproject\database\DB;

class Validation {

private $_db,$_message;    
    
public function __construct(DB $db,Messages $message){
    $this->_db = $db->con();
    $this->_message = $message;
}
public function validateRegister($request){
    if($request['type'] == 'register' && $request['persistent_register'] == 'yes'){  
        $username = htmlentities($request['username'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars_decode($request['email'],ENT_QUOTES);
        $password = htmlentities($request['password'], ENT_QUOTES, 'UTF-8');
        $password_again = htmlentities($request['password_again'], ENT_QUOTES, 'UTF-8');
        // chceck db
        $stmt = $this->_db->prepare("SELECT username FROM members WHERE username = :username");
        $stmt->execute([":username"=>$username]);
        $row = $stmt->fetch();
    
        if(!empty($row["username"]))return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno se již používá'])];
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
}