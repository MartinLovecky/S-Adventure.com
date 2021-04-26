<?php

namespace starproject\controllers;

use \starproject\http\Router;
use \starproject\tools\Mailer;
use \starproject\database\Datab;
use \starproject\tools\Selector;
use \starproject\tools\Validation;
use \starproject\database\costumers\Member;

class RequestController{

private $_validation,$_member,$_db,$_mail,$_selector;

public function __construct(Validation $validation,Member $member, Datab $db, Mailer $mail,Selector $selector){
    $this->_validation = $validation;
    $this->_member = $member;
    $this->_mail = $mail;
    $this->_selector = $selector;
    $this->_db = $db->con();
}


public function submitRegister($request){
    if(isset($request)){
        $register = $this->_validation->validateRegister($request);
    if(\array_key_exists('message',$register)){
        @$_SESSION = ['f_username'=>$request['username'],'f_email'=>$request['email']];
        return $this->_selector->message = $register['message'];
    }
        $hashedpassword = password_hash($register['password'], PASSWORD_BCRYPT);
        $activate = md5(uniqid(rand(),true));
        // INSERT validtated data to DB
      
        $values = ['username'=>$register['username'],'password'=>$hashedpassword,'email'=>$register['email'],'active'=>$activate,'permission'=>'user','avatar'=>'empty_profile.png','bookmark'=>'0'];
        $stmt = $this->_db->insertInto('members')->values($values)->execute();
        $id = $this->_db->lastInsertId();
        $this->_db->close(); 
        
        // SEND EMAIL 
        $build = ['body'=>$this->_mail->includeWithVariables(DIR.'/views/email/e-register.php',['id'=>$id,'activasion'=>$activate,'username'=>$register['username']]),'subject'=>'Potvrzení registrace','to'=>$register['email']];
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
        @$_SESSION = ['f_username'=>$request['username']];
        return $this->_selector->message = $login['message'];
    }
    if($login){
        Router::redirect('member/'.$request['username'].'?action=logged');
    }/*elseif($login && $request['rember'] == 'yes'){
       
            Create key inser into db and login (cockie requierd ?)
            $key = 
            $values = ['remeber'=>$key];
            stmt = $this->_db->insertInto('members')->values($values)->where('username',$request['username'])->execute();
        
    }*/
    }
    return null;
}

public function submitsendReset($request){
    if(!empty($request)){
    $reset = $this->_validation->validateResetMail($request);
    if(\array_key_exists('message',$reset)){
        return $this->_selector->message = $reset['message'];
    }
    else{
        $result = $this->_member->getMemberID($request);
        $token = hash_hmac('SHA256', $this->_member->generate_entropy(8), $result['password']);
        $storedToken = hash('SHA256', ($token));
        // store token
        $set = ['resetToken'=>$storedToken,'resetComplete'=>'No'];
        $stmt = $this->_db->update('members')->set($set)->where('memberID',$result['memberID'])->execute();
        $this->_db->close();
        // Send email
        $build = ['body'=>$this->_mail->includeWithVariables(DIR.'/views/email/pwd-reset.php',['username'=>$result['username'],'token'=>$token,'id'=>$result['memberID']]),'to'=>$reset['email'],'subject'=>'SA | Reset hesla'];
        $this->_mail->builder($build);	
        if($this->_mail->send()){
            Router::redirect('login?action=reset');
        }
    }
    }
    return null;
}

public function submitReset($request){
    //! Token check will be latter inside _validation
    if(!empty($request)){
        $subReset = $this->_validation->validateReset($request);
    if(\array_key_exists('message',$subReset)){
        return $this->_selector->message = $subReset['message'];
    }
    else{
        $hashedpassword = password_hash($subReset['password'], PASSWORD_DEFAULT);
        $resetDBHash = $this->_member->resetDBHash($request,$hashedpassword);
        if($resetDBHash){
            $set = ['resetToken'=>null,'resetComplete'=>null];
            $stmt = $this->_db->update('members')->set($set)->where('memberID',$request['id'])->execute();
            if($stmt){
                $this->_db->close();
                Router::redirect('login?action=resetAccount');
            }
            return $this->_selector->message = '<div role="alert" class="alert alert-danger text-center text-danger"><span>Reset password failed </span></div>';
            
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
// check hash latter update
public function activate(){
    $checkActivate = null;
    $memberID = $this->_validation->sanitaze_GET('x');
    /*
    if(\array_key_exists('message',$checkActivate)){
        Router::redirect('login?action=failActive');
    }*/
        $set = ['active'=>'YES'];
        $stmt = $this->_db->update('members',$set)->where('memberID',$memberID)->execute();
        $this->_db->close();
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
    $stmt = $this->_db->update('members')->set($set)->where('memberID',$this->_member->memberID)->execute();
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