<?php

namespace starproject\tools;

use \starproject\database\DB;
use \starproject\tools\Messages;
use \starproject\database\costumers\Member;

class Validation{

private $_db,$_message,$_member;    
    
public function __construct(DB $db,Messages $message, Member $member){
    $this->_db = $db->con();
    $this->_message = $message;
    $this->_member = $member;
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
        if(!$this->_member->userExist($username))return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno se již používá'])];
        if(!$this->_member->isValidUsername($username)) return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno musí obsahovat minimálně 4 - 25 znaku'])];
        if(mb_strlen($password) < 6 || mb_strlen($password_again) < 6) return ['message'=>$this->_message->message(['error'=>'Heslo musí mít nejméně 6 znaků'])];
        if($password != $password_again)return ['message'=>$this->_message->message(['error'=>'Heslo se musí schodovat'])];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))return ['message'=>$this->_message->message(['error'=>'Prosím zadajte platný email'])];
            return  ['username'=>$username,'password'=>$password,'email'=>$email];
    }else{
            return ['message'=>$this->_message->message(['error'=>'Pro úspěšnou registraci musíte souhlasit s VOP a Terms'])];
    }
}

public function setSession($username,$password){
    $stmt = $this->_db->from('members')->where('username',$username);
    $row = $stmt->fetch();
    //"SELECT * FROM members WHERE username = :username AND active='Yes'")
    if($this->_member->password_verify($password,$row['password']) == 1){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['memberID'] = $row['memberID'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['active'] = $row['active'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['avatar'] = $row['avatar'];
        $_SESSION['age'] = $row['age'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['resetToken'] = $row['resetToken'];
        $_SESSION['resetComplete'] = $row['resetComplete'];
        $_SESSION['bookmark'] = $row['bookmark'];
        $_SESSION['remeber'] = $row['remeber'];
        // not setup inside db $_SESSION['role'] = $row['role']
        return true;
    }
}

public function validateLogin($request){
    $username = htmlentities($request['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlentities($request['password'], ENT_QUOTES, 'UTF-8');
    if($this->_emptyFields([$username,$password]))return ['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if(!$this->_member->isValidUsername($username)) return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno musí obsahovat minimálně 4 - 25 znaku'])];
    if(strlen($password) < 5) return ['message'=>$this->_message->message(['error'=>'Heslo musí být delší jak 5 znaků'])];
    if(!$this->_member->userExist($username))return['message'=>$this->_message->message(['error'=>'Uživatel nexistuje,<a href="">registrovat ?</a>'])];
    if($this->setSession($username,$password))return ['username'=>$username,'password'=>$password];
}

public function validateReset($request){
    //fields , password,passwordConfirm , token 
    $resetpwd = $request['password'];
    $resetpwdAgain = $request['passwordConfirm'];
    $token = htmlentities($request['hash'],ENT_QUOTES, 'UTF-8');
    if($this->_emptyFields([$resetpwd,$resetpwdAgain,$token]))return ['message'=>$this->message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if(mb_strlen($resetpwd) < 6 || mb_strlen($resetpwdAgain) < 6) return ['message'=>$this->_message->message(['error'=>'Heslo musí mít nejméně 6 znaků'])];
    if($resetpwd != $resetpwdAgain)return ['message'=>$this->_message->message(['error'=>'Heslo se musí schodovat'])];
    return ['password'=>$resetpwd,'token'=>$token];
}

public function validateResetMail($request){
    $email = htmlspecialchars_decode($request['email'], ENT_QUOTES);
    if($this->_emptyFields([$email]))return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))return['message'=>$this->_message->message(['error'=>'Zadejte prosím platný email'])];
    // Check DB
    $stmt = $this->_db->from('members')->where('email',$email);
    $rowEmail = $stmt->fetch('email');
    if($rowEmail != $email)return['message'=>$this->_message->message(['error'=>'K zadému emailu neexistuje žádný účet'])];
    return ['email'=>$email];
}

public function validateBookmark($request){
    /* CHECK LIST 
        - LOGGED , PERMISSION, ARTICLE , PAGE , <- all should be okey
    */
    return ['message'=>$this->_message->message(['succes'=>'Záložka úspěšně uložena'])];
}

}