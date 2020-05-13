<?php

namespace starproject\controllers;

use \starproject\tools\Validation;
use \starproject\database\costumers\Member;
use \starproject\database\DB;
use \starproject\tools\Mailer;

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
            $this->_mail->Username = $this->_mail->_email; 
            $this->_mail->Password = $this->_mail->_paswword; 
            $this->_mail->SMTPSecure = "tls";
            $this->_mail->Port = 587;
            $this->_mail->subject($subject);
            $this->_mail->isHTML(true);
            $this->_mail->body($body);
            $this->_mail->setFrom("noreply@sadventure.com","sadventure.com");
            $this->_mail->addAddress($to);
            $this->_mail->addAttachment("public/images/attachment/help.png");
            if($this->_mail->send()){
                header("Location: http://sadventure.com/login?action=joined"); 
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
        if($this->_member->login($username,$password)){
            header("Location: http://sadventure.com/member/$username"); exit;
        }
    }
    return null;
    
}

public function submitsendReset($request){
    // This function send reset email to user 
    $reset = $this->_sendResetEmail($request);
    if(\in_array('message',$reset)){
        return ['message'=>$reset['message']];
    }
    if(!\in_array('message',$reset)){
        // update db
        $set = ['resetToken'=>$reset['storedToken'],'resetComplete'=>'No'];
        $stmt = $this->_db->update('members',$set,$reset['email']);
        $stmt->execute();
        $to = $reset['email'];
        $subject = "Reset hesla";
        //require(DIR . '/views/actions/mail_reset.php');
		$this->_mail->Host = 'smtp.gmail.com';
        $this->_mail->Body = $body;
		$this->_mail->SMTPDebug = 2;
		$this->_mail->CharSet = 'UTF-8';
		$this->_mail->SMTPAuth = true;
		$this->_mail->Username = null;
		$this->_mail->Password = null; 
		$this->_mail->SMTPSecure = "ssl";
		$this->_mail->Port = 465;
		$this->_mail->subject($subject);
		$this->_mail->isHTML(true);
		$this->_mail->body($body);
		$this->_mail->setFrom("noreply@sadventure.com","sadventure.com");
		$this->_mail->addAddress($to);
		$this->_mail->addAttachment('public/images/attachment/help.png');
		if ($this->_mail->send()){
            header('Location: http://sadventure.com/login?action=reset');
        }
    }
}

public function submitReset($request){
    return null;
}

}