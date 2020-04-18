<?php

namespace starproject\controllers;

use \starproject\tools\Validation;
use \starproject\database\costumers\Member;
use \starproject\database\DB;

class RequestController{

private $_validation,$_member,$_db;

public function __construct(Validation $validation,Member $member, DB $db){
    $this->_validation = $validation;
    $this->_member = $member;
    $this->_db = $db->con();
}

public function _register($request){
    // Validate REGISTER REQUEST 
    if(!empty($request)){
    $validation = $this->_validation->validateRegister($request);
    if(isset($validation['message'])){
        return ['message'=>$validation['message'],['old_email'=>$request['email'],'old_username'=>$request['username']]];      
    }
    $hashedpassword = password_hash($validation['password'], PASSWORD_DEFAULT);
    $activation = md5(uniqid(rand(),true));        
        try{
            // Insert valid data to db && return data for submit
            $stmt = $this->_db->prepare("INSERT INTO members (username,password,email,active,permition,avatar) VALUES (:username, :password, :email, :active, :permition, :avatar)");
            $stmt->execute([":username"=>$validation['username'],":password"=>$hashedpassword,":email"=>$validation['email'],":active"=>$activation,":permition"=>"user",":avatar"=>"empty_profile.png"]); 
            return ['to'=>$validation['email'],'username'=>$validation['username'],'activation'=>$activation];
        }catch(PDOException $e){
            return ['message'=>$e->getMessage().(int)$e->getCode()];
        }
    }
    return null;
}

public function _login($request){
   $validation = $this->_validation->validateLogin($request);
   if(isset($validation['message'])){
       return ['message'=>$validation['message'],['old_Username'=>$request['username']]];
   }
       return ['username'=>$validation['username'],'password'=>$validation['password']];
}

public function _sendResetEmail(){
    $validation = $this->_validation->validateResetMail($request);
}

public function submitRegister($request){

    $register = $this->_register($request);
    if(\in_array('message',$register)){
        return $register['message'];
    }
    if(!\in_array('message',$register)){
            $id = $register['id'];
            $to = $register['to'];
            $subject = "Potvrzení registrace";
            $activasion = $register['activasion'];
            $username = $register['username'];
            require(DIR."/public/templates/email.php"); 
            $this->_mail->Body = $body;
            $this->_mail->Host = "smtp.gmail.com";
            $this->_mail->SMTPDebug = 2;
            $this->_mail->CharSet = "UTF-8";
            $this->_mail->SMTPAuth = true;
            $this->_mail->Username = $this->_mail->_email; // create 'web-email'
            $this->_mail->Password = $this->_mail->_paswword; // maybe wrong pwd
            $this->_mail->SMTPSecure = "tls";
            $this->_mail->Port = 587;
            $this->_mail->subject($subject);
            $this->_mail->isHTML(true);
            $this->_mail->body($body);
            $this->_mail->setFrom("noreply@example.com","example.com");
            $this->_mail->addAddress($to);
            $this->_mail->addAttachment("public/images/attachment/help.png");
            if($this->_mail->send()){
                \header("Location: http://staradventure.xf.cz/login?action=joined"); exit;
            }
    }
    return null; 
}

public function submitLogin($request){
    // Take correct info and login check for login errors
    $login = $this->_login($request);
    if(\in_array('message',$login)){
        return ['message'=>$validation['message']];
    }
    if(!\in_array('message',$login)){
        $username = $login['username'];
        $password = $login['password'];
        if($member->login($username,$password)){
            \header("Location: http://staradventure.xf.cz/member/$username"); exit;
        }
    }
    return null;
    
}

public function submitReset($request){
    return null;
}

}