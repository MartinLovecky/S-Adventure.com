<?php

namespace starproject\controllers;

use \starproject\tools\Validation;
use \starproject\database\costumers\Member;
use \starproject\database\DB;
use \starproject\tools\Mailer;
use \starproject\http\Router;
use \starproject\tools\Selector;

class RequestController{

private $_validation,$_member,$_db,$_mail,$_selector;

public function __construct(Validation $validation,Member $member, DB $db, Mailer $mail,Selector $selector){
    $this->_validation = $validation;
    $this->_member = $member;
    $this->_mail = $mail;
    $this->_selector = $selector;
    $this->_db = $db->con();
}

private function _register($request){
    $validation = $this->_validation->validateRegister($request);
    if(isset($validation['message'])){
        return ['message'=>$validation['message'],['email'=>$request['email'],'username'=>$request['username']]];      
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

private function _login($request){
   $validation = $this->_validation->validateLogin($request);
   if(isset($validation['message'])){
       return ['message'=>$validation['message'],['username'=>$request['username']]];
    }
       return ['username'=>$validation['username'],'password'=>$validation['password']];
}

private function _sendResetEmail($request){
    $validation = $this->_validation->validateResetMail($request);
    if(isset($validation['message'])){
        return ['message'=>$validation['message'],['email'=>$request['email']]];
    }
    $stmt = $this->_db->from('members')->where('email',$email);
    $result = $stmt->fetch('password');
    $token = hash_hmac('SHA256', $this->_member->generate_entropy(8), $result['password']);
    $storedToken = hash('SHA256', ($token));
        return ['email'=>$validation['email'],'storedToken'=>$storedToken,'token'=>$token];
}

private function _reset($request){
    $validation = $this->_validation->validateReset($request);
    if(isset($validation['message'])){
        return ['message'=>$validation['message']];
    }
    $hashedpassword = password_hash($validation['password'], PASSWORD_DEFAULT);
    $stmt = $this->_db->from('members')->select(['resetToken','resetComplete'])->where('resetToken',$this->_selector->queryAction);
    $result = $stmt->fetch();
        return ['resetToken'=>$result['resetToken'],'resetComplete'=>$result['resetComplete'],'hashedpassword'=>$hashedpassword];
}

public function submitRegister($request){
    $register = $this->_register($request);
    if(\in_array('message',$register)){
        $this->_selector->getMessages($register['message']);
        $this->_selector->oldData($register[0]);
            return $this;
    }
    if(!\in_array('message',$register)){
        $subject = "Potvrzení registrace";
        $build = ['body'=>$this->_mail->template('register-email',['id'=>$register['id'],'activasion'=>$register['activasion'],'username'=>$register['username']]),'subject'=>$subject,'to'=>$register['to']];
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
        $this->_selector->getMessages($login['message']);
        $this->_selector->oldData($login[0]);
            return $this;
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
        $this->_selector->getMessages($reset['message']);
        $this->_selector->oldData($reset[0]);
            return $this;
    }
    if(!\in_array('message',$reset)){
        $set = ['resetToken'=>$reset['storedToken'],'resetComplete'=>'No'];
        $stmt = $this->_db->update('members',$set,$reset['email']);
        $stmt->execute();
        $subject = "Reset hesla";
        $build = ['body'=>$this->_mail->template('pwd-reset-email',['token'=>$reset['token']]),'to'=>$reset['email'],'subject'=>$subject];
        $this->_mail->builder($build);	
		if ($this->_mail->send()){
            Router::redirect('login?action=reset');
        }
    }
}

public function submitReset($request){
    
}

}