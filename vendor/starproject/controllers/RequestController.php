<?php

namespace starproject\controllers;

use \starproject\http\Router;
use \starproject\tools\Mailer;
use \starproject\database\Datab;
use \starproject\tools\Selector;
use \starproject\tools\Validation;
use \starproject\database\costumers\Member;

class RequestController{

private $_validation,$_member,$_db,$_mail,$_selector,$_blade;

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
        return $this->_selector->message = $register['message'];
    }
        $hashedpassword = password_hash($register['password'], PASSWORD_BCRYPT);
        $activate = md5(uniqid(rand(),true));
        // INSERT TO DB
        $values = ['username'=>$register['username'],'password'=>$hashedpassword,'email'=>$register['email'],'active'=>$activate,'permission'=>'user','avatar'=>'empty_profile.png','bookmark'=>'0'];
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
        return $this->_selector->message = $login['message'];
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
            return;
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
        return $this->_selector->message = $subReset['message'];
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

public function submitKontakt($request){
    return null;
}

public function updateMember($request){
    if(!empty($request)){
        $updateMember = $this->_validation->validateUpdateMember($request);
    if(\array_key_exists('message',$updateMember)){
        return $this->_selector->message = $updateMember['message'];   
        /*
        $avatarx = (isset($_FILES['avatar']['name'])) ? $_FILES['avatar']['name'] : 'empty';
        $temp = (isset($_FILES['avatar']['tmp_name'])) ? $_FILES['avatar']['tmp_name'] : 'empty';
        */
        //$set = null;
        //return null;
    }
}
    return null;
}

public function activate(){
    $checkActivate = $this->_validation->checkActivation();
    if(\array_key_exists('message',$checkActivate)){
        Router::redirect('login?action=failActive');
    }
        $set = ['active'=>'YES'];
        $stmt = $this->_db->update('members',$set)->where('memberID',$checkActivate['memberID']);
        $stmt->execute();
    Router::redirect('login?action=active');
 
}

public function saveBookmark($article,$page){
    $validateBookmark = $this->_validation->validateBookmark($article,$page);
    if(\array_key_exists('message',$validateBookmark)){
        Router::redirect('member/'.$this->_member->username.'?action=failActive');
    }
    // get number of bookmarks max 12
    $stmt = $this->_db->from('members')->select('bookmark')->where('memberID',$this->_member->memberID);
    // 1 2 3 4 5 6 7  8 9 10 11 12
    $bookmark = (int)$stmt->fetch('bookmark');
    // IF bookmark is 12 and user try add new Redirect and die script !immportant 
    $bookmark++; 
    if($bookmark >= 12){
        Router::redirect('member/'.$this->_member->username.'?action=maxBookmarks');
    }
    // update number of bookmarks
    $set = ['bookmark'=>$bookmark];
    $stmt = $this->_db->update('members')->set($set)->where('memberID',$this->_member->memberID);
    $stmt->execute();
    $this->_db->close();
    // bookmark is number bettwen 1 - 12 also $this->_member->bookmarks is array
    if(isset($_SESSION['bookmark'])){
        $next = ['bookmark'.$bookmark.''=> 'show/'.$article.'/'.$page.''];
        $savedBookmark = array_merge($_SESSION['bookmark'],$next);
            return $savedBookmark;
            
    }
    $savedBookmark = ['bookmark'.$bookmark.''=> 'show/'.$article.'/'.$page.''];
    return $savedBookmark;
    
}

}