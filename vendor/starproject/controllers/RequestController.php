<?php

namespace starproject\controllers;

use \starproject\tools\Validation;
use \starproject\database\costumers\Member;
use \starproject\database\Datab;
use \starproject\tools\Mailer;
use \starproject\http\Router;
use \starproject\tools\Selector;

class RequestController{

private $_validation,$_member,$_db,$_mail,$_selector;

public function __construct(Validation $validation,Member $member, Datab $db, Mailer $mail,Selector $selector){
    $this->_validation = $validation;
    $this->_member = $member;
    $this->_mail = $mail;
    $this->_selector = $selector;
    $this->_db = $db->con();
}

private function _resetUpdate($result){
     //reset update reset DB
     $set = ['password'=>$result['hashedpassword'],'resetComplete'=>$result['resetComplete']];
     $stmt = $this->_db->update('members')->set($set)->where('memberID',$result['id']);
     $stmt->execute();
     $result = $stmt->fetch();
        return $result;
}

public function submitRegister($request){
    if(isset($request)){
        $register = $this->_validation->validateRegister($request);
    if(\array_key_exists('message',$register)){
        $this->_selector->message = $register['message'];
        $this->_selector->oldData = $request;
           return $this;
    }
        $hashedpassword = password_hash($register['password'], PASSWORD_DEFAULT);
        $activate = md5(uniqid(rand(),true));
        // INSERT TO DB
        $values = ['username'=>$register['username'],'password'=>$hashedpassword,'email'=>$register['email'],'active'=>$activate,'permission'=>'user','avatar'=>'empty_profile.png'];
        $stmt = $this->_db->insertInto('members')->values($values);
        $stmt->execute();
        $id = $this->_db->lastInsertId();
        $this->_db->close(); 
        // SEND EMAIL need user ID 
        //! FIX Body
        $build = ['body'=>$this->_mail->template('register-email',['id'=>$id,'activasion'=>$activate,'username'=>$register['username']]),'subject'=>'Potvrzení registrace','to'=>$register['email']];
        $this->_mail->builder($build);
        if($this->_mail->send()){
            Router::redirect('login?action=joined');
        }
    }
    return null; 
}

public function submitLogin($request){
    if(!empty($request)){
        $login = $this->_validation->validateLogin($request);
    if(\array_key_exists('message',$login)){
        $this->_selector->message = $login['message'];
        $this->_selector->oldData = $request;
            return $this;
    }
    if($login){
        $username = $_SESSION['username'];
        Router::redirect('member/'.$username.'?action=logged');
    }
    }
    return null;
}

public function submitsendReset($request){
    if(!empty($request)){
    $reset = $this->_validation->validateResetMail($request);
    if(\array_key_exists('message',$reset)){
        $this->_selector->message = $reset['message'];
        $this->_selector->oldData = $request;
            return $this;
    }
    else{
        // OK
        $stmt = $this->_db->from('members')->where('email',$request['email']);
        $result = $stmt->fetchAll('memberID','password');
        $this->_db->close();
        $token = hash_hmac('SHA256', $this->_member->generate_entropy(8), $result[2]['password']);
        $storedToken = hash('SHA256', ($token));
        // NOT OK
        $set = ['resetToken'=>$storedToken,'resetComplete'=>'No'];
        $stmt = $this->_db->update('members')->set($set)->where('memberID',$reset['id']);
        $stmt->execute();
        $this->_db->close();
        // Send email
        $build = ['body'=>$this->_mail->template('pwd-reset-email',['token'=>$reset['token'],'id'=>$reset['id']]),'to'=>$reset['email'],'subject'=>'SA | Reset hesla'];
        $this->_mail->builder($build);	
        if($this->_mail->send()){
            Router::redirect('login?action=reset');
        }
    }
    }
    return null;
}

public function submitReset($request){
    if(!empty($request)){
    $subReset = $this->_validation->validateReset($request);
    if(\array_key_exists('message',$subReset)){
        return $this->_selector->message =$subReset['message'];
    }
    else{
        // Token for DB
        $hashedpassword = password_hash($subReset['password'], PASSWORD_DEFAULT);
        $stmt = $this->_db->from('members')->select(['resetToken','resetComplete'])->where('resetToken',$subReset['token']);
        $result = $stmt->fetch();
        $this->_db->close();
        //['resetToken'=>$result['resetToken'],'resetComplete'=>$result['resetComplete'],'hashedpassword'=>$hashedpassword];
        $resetUpdate = $this->_resetUpdate($result);
        // reset null for next reset
        if($resetUpdate['resetComplete'] === 'YES'){
            $set = ['resetToken'=>null,'resetComplete'=>null];
            $stmt = $this->_db->update('members')->set($set)->where('memberID',$subReset['id']);
            $stmt->execute();
            $this->_db->close();
                Router::redirect('login?action=resetAccount');
        }
    }
    }
    return null;
}

public function submitBookmark($request){
    if(!empty($request)){
        $bookmark = $this->_validation->validtateBookmark($request);
    if(\array_key_exists('message',$bookmark)){
        $this->_selector->message = $bookmark['message'];
            return $this->_selector->message;
    }    
        $set = ['bookmark'=>'show/'.$this->article.'/'.$this->page];
        $stmt = $this->_db->update('members')->set($set)->where('memberID',$this->_member->memberID);
        $stmt->execute();
        $this->_db->close();
            Router::redirect('member/'.$this->_member->username.'?action=savedBookmark');
    }
}

public function submitKontakt($request){
    return null;
}

public function updateMember($request){
    if(!empty($request)){
        $updateMember = $this->_validation->validateUpdateMember($request);
    if(\array_key_exists('message',$updateMember)){
            $this->_selector->message = $updateMember['message'];
            $this->_selector->oldData = $request;
               return $this;
    }
        $set = null;//code
        return null;
    }
    return null;
}

}