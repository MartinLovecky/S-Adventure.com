<?php

namespace starproject\tools;

use \starproject\database\Datab;
use \starproject\tools\Messages;
use \starproject\tools\Sanitazorx;
use \starproject\database\costumers\Member;
use \starproject\database\costumers\Password;


class Validation extends Sanitazorx{

  
private $_db,$_message,$_member;    
    
public function __construct(Datab $db,Messages $message, Member $member){
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

private function _validCSFR($request){
    $decoded = base64_decode($_SESSION['_token']);
    $validS = explode('|',$decoded);
    if(!in_array($_SERVER['SERVER_NAME'],$validS)){
       return false;
    }
   if(password_verify($_SESSION['_token'],$request['_token'])){
       return true;
    }
       return false;
 
}

public function validateRegister($request){
    if($request['persistent_register'] == 'yes'){  
        $username = $this->sanitaze($request['username']);
        $email = $this->sanitazeEmail($request['email']);
        $password = $this->sanitaze($request['password']);
        $password_again = $this->sanitaze($request['password_again']);
        // check empty filelds
        if($this->_emptyFields([$username,$email,$password,$password_again]))return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
        if($this->_member->userExist($username,$email))return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno nebo email se již používá'])];
        if(!$this->_member->isValidUsername($username)) return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno musí obsahovat minimálně 4 - 25 znaku'])];
        if(mb_strlen($password) < 6 || mb_strlen($password_again) < 6) return ['message'=>$this->_message->message(['error'=>'Heslo musí mít nejméně 6 znaků'])];
        if($password != $password_again)return ['message'=>$this->_message->message(['error'=>'Heslo se musí schodovat'])];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))return ['message'=>$this->_message->message(['error'=>'Prosím zadajte platný email'])];
            return ['username'=>$username,'password'=>$password,'email'=>$email];
    }else{
            return ['message'=>$this->_message->message(['error'=>'Pro úspěšnou registraci musíte souhlasit s VOP a Terms'])];
    }
}

public function setSession($password,$result){
    if(password_verify($password,$result['password'])){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $result['username'];
        $_SESSION['memberID'] = $result['memberID'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['active'] = $result['active'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['surname'] = $result['surname'];
        $_SESSION['avatar'] = $result['avatar'];
        $_SESSION['age'] = $result['age'];
        $_SESSION['location'] = $result['location'];
        $_SESSION['resetToken'] = $result['resetToken'];
        $_SESSION['resetComplete'] = $result['resetComplete'];
        $_SESSION['remeber'] = $result['remeber'];
        // not setup inside db $_SESSION['role'] = $result['role']
        return $_SESSION;
        //return $result;
    }
    return false;
}

public function validateLogin($request){
    $username = $this->sanitaze($request['username']);
    $password = $this->sanitaze($request['password']);
    $stmt = $this->_db->from('members')->where('username',$username);
    $result = $stmt->fetch();
    $active = $result['active'];
    $id = $result['memberID'];
    $this->_db->close();
    if(!$this->_validCSFR($request))return ['message'=>$this->_message->message(['error'=>'Invalid CSRF'])];
    if($active != 'YES')return['message'=>$this->_message->message(['error'=>'Uživatel není aktivní <a href="/activate?x='.$id.'&y='.$active.'" style="color:#85202a;text-decoration:underline;">Aktivovat zde</a>'])];
    if($this->_emptyFields([$username,$password]))return ['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if(!$this->_member->isValidUsername($username)) return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno musí obsahovat minimálně 4 - 25 znaku'])];
    if(strlen($password) < 5) return ['message'=>$this->_message->message(['error'=>'Heslo musí být delší jak 5 znaků'])];
    if(!$this->setSession($password,$result))return ['message'=>$this->_message->message(['error'=>'Nesprávné heslo'])];
        return $this->setSession($password,$result);
}

public function validateReset($request){
    //fields , password,passwordConfirm , token 
    $resetpwd = $request['password'];
    $resetpwdAgain = $request['passwordConfirm'];
    $token = $this->sanitaze($request['hash']);
    if($this->_emptyFields([$resetpwd,$resetpwdAgain,$token]))return ['message'=>$this->message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if(mb_strlen($resetpwd) < 6 || mb_strlen($resetpwdAgain) < 6) return ['message'=>$this->_message->message(['error'=>'Heslo musí mít nejméně 6 znaků'])];
    if($resetpwd != $resetpwdAgain)return ['message'=>$this->_message->message(['error'=>'Heslo se musí schodovat'])];
    return ['password'=>$resetpwd,'token'=>$token];
}

public function validateResetMail($request){
    $email = $this->sanitazeEmail($request['email']);
    if($this->_emptyFields([$email]))return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))return['message'=>$this->_message->message(['error'=>'Prosím zadajte platný email'])];
    // Check DB
    $stmt = $this->_db->from('members')->where('email',$email);
    $rowEmail = $stmt->fetch('email');
    if($rowEmail != $email)return['message'=>$this->_message->message(['error'=>'K zadému emailu neexistuje žádný účet'])];
    return ['email'=>$email];
}

public function checkActivation(){
    $memberID = $this->sanitaze_GET('x');
    $active = $this->sanitaze_GET('y');
    $ID = int($memberID);
    if(!isset($memberID) && !isset($active))return['message'=>'What are you trying to do'];
    if(!is_numeric($ID))return['message'=>'Invalid ID type'];
    $stmt = $this->_db->from('members')->select('active')->where('memberID',$ID);
    $result = $stmt->fetch();
    $this->_db->close();
    if($result != $active)return['message'=>'No'];
        return ['memberID'=>$ID];
}

public function validateBookmark(){
    return [];
/*
if(!in_array($article,$selector->allowedAricles)){
        \header('Location: http://sadventure.com/404/')
}
*/

}

public function validateUpdateMember($request){
    return null;
}
}