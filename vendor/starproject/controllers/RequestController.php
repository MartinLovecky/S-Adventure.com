<?php

namespace starproject\controllers;

use \starproject\tools\Validation;
use \starproject\database\costumers\Member;
use \starproject\database\DB;
use \starproject\tools\Mailer;
use \starproject\http\Router;

class RequestController{

private $_validation,$_member,$_db,$_mail;

public function __construct(Validation $validation,Member $member, DB $db, Mailer $mail){
    $this->_validation = $validation;
    $this->_member = $member;
    $this->_mail = $mail;
    $this->_db = $db->con();
}

public function _register($request){
    // Validate REGISTER REQUEST 
    if(!empty($request) && $request['type'] == 'register'){
    $validation = $this->_validation->validateRegister($request);
    if(isset($validation['message'])){
        return ['message'=>$validation['message'],['old_email'=>$request['email'],'old_username'=>$request['username']]];      
    }
    $hashedpassword = password_hash($validation['password'], PASSWORD_DEFAULT);
    $activation = md5(uniqid(rand(),true));        
        try{
            // Insert valid data to db && return data for submit
            $values = ['username'=>$validation['username'],'password'=>$hashedpassword,'email'=>$validation['email'],'active'=>$activation,'permission'=>'user','avatar'=>'empty_profile.png'];
            $stmt = $this->_db->insertInto('members')->values($values);
            $stmt->execute(); 
            return ['to'=>$validation['email'],'username'=>$validation['username'],'activation'=>$activation];
        }catch(PDOException $e){
            return ['message'=>$e->getMessage().(int)$e->getCode()];
        }
    }
    return null;
}

public function _login($request){
   if(!empty($request) && $request['type'] == 'login'){
        $validation = $this->_validation->validateLogin($request);
   if(isset($validation['message'])){
       return ['message'=>$validation['message'],['old_Username'=>$request['username']]];
   }
       return ['username'=>$validation['username'],'password'=>$validation['password']];
   }
    return null;
}

public function _sendResetEmail($request){
    $validation = $this->_validation->validateResetMail($request);
    if(isset($validation['message'])){
        return ['message'=>$validation['message'],['old_email'=>$request['email']]];
    }
    $stmt = $this->_db->from('members')->where('email',$email);
    $result = $stmt->fetch('password');
    $token = hash_hmac('SHA256', $this->_member->generate_entropy(8), $result['password']);
    $storedToken = hash('SHA256', ($token));
        return ['email'=>$validation['email'],'storedToken'=>$storedToken];

}

public function submitRegister($request){
    $register = $this->_register($request);
    if(\in_array('message',$register)){
        return $register['message'];
    }
    if(!\in_array('message',$register)){
        $subject = "Potvrzení registrace";
        $build = ['body'=>$this->_mail->template('email',['id'=>$register['id'],'activasion'=>$register['activasion'],'username'=>$register['username']]),'subject'=>$subject,'to'=>$register['to']];
        $this->_mail->builder($build);
        if($this->_mail->send()){
            Router::redirect('login?action=joined');
        }
    }
    return null; 
}

public function submitLogin($request){
    $login = $this->_login($request);
    if(\in_array('message',$login)){
        return ['message'=>$validation['message']];
    }
    if(!\in_array('message',$login)){
        $username = $login['username'];
        $password = $login['password'];
        if($this->_member->login($username,$password)){
            Router::redirect('member/'.$username.'?action=logged');
        }
    }
    return null;

}

public function submitsendReset($request){
    $reset = $this->_sendResetEmail($request);
    if(\in_array('message',$reset)){
        return ['message'=>$reset['message']];
    }
    if(!\in_array('message',$reset)){
        $set = ['resetToken'=>$reset['storedToken'],'resetComplete'=>'No'];
        $stmt = $this->_db->update('members',$set,$reset['email']);
        $stmt->execute();
        $subject = "Reset hesla";
        $build = ['body'=>$this->_mail->template('mail_reset',['to'=>$reset['email'],'subject'=>$subject])];
        $this->_mail->builder($build);	
		if ($this->_mail->send()){
            Router::redirect('login?action=reset');
        }
    }
}

public function submitReset($request){
    return null;
}

}