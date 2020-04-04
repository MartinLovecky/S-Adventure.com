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
    if(!empty($request) && $request['type'] == 'register'){
        $validation = $this->_validation->validate($request);
        if(isset($validation['message'])){
            return ['message'=>$validation['message'],['old_email'=>$request['email'],'old_username'=>$request['username']]];      
        }
        $hashedpassword = $this->_member->password_hash($validation['password'], PASSWORD_BCRYPT);
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

public function submit($request){
    if(!empty($request)){
        $register = $this->_register($request);
        if(isset($register)){
            
        }
    }
    return null;
}

    
}