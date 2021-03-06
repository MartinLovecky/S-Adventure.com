<?php

namespace starproject\controllers;

use \starproject\http\Router;
use \starproject\tools\Mailer;
use starproject\database\Datab;
use \starproject\tools\Selector;
use \starproject\tools\Validation;
use \starproject\database\costumers\Member;

class RequestController
{
    private $_validation;
    private $_member;
    private $_db;
    private $_mail;
    private $_selector;

    public function __construct(Validation $validation, Member $member, Mailer $mail, Selector $selector, Datab $con)
    {
        $this->_validation = $validation;
        $this->_member = $member;
        $this->_mail = $mail;
        $this->_selector = $selector;
        $this->_db = $con->con();
    }


    public function submitRegister($request)
    {
        if (isset($request)) {
            $register = $this->_validation->validateRegister($request);
            if (\array_key_exists('message', $register)) {
                @$_SESSION = ['f_username'=>$request['username'],'f_email'=>$request['email']];
                return $this->_selector->message = $register['message'];
            }
            $hashedpassword = password_hash($register['password'], PASSWORD_BCRYPT);
            $activate = md5(uniqid(rand(), true));
            $values = ['username'=>$register['username'],'password'=>$hashedpassword,'email'=>$register['email'],'active'=>$activate,'permission'=>'user','avatar'=>'empty_profile.png','bookmark'=>'0'];
            $stmt = $this->_db->insertInto('members')->values($values)->execute();
            $id = $this->_db->lastInsertId();
            $bodyFile = file_get_contents(DIR.'/views/email/e-register.php');
            $body = str_replace(['YourUsername','MemberID','ActivasionHash'], [$register['username'],$id,$activate], $bodyFile);
            $info = ['subject'=>'Potvrzení registrace','to'=>$register['email']];
            if ($this->_mail->sender($body, $info)) {
                Router::redirect('login?action=joined');
            }
        }
        return null;
    }

    public function submitLogin($request)
    {
        if (!empty($request)) {
            $login = $this->_validation->validateLogin($request);
            if (\array_key_exists('message', $login)) {
                @$_SESSION = ['f_username'=>$request['username']];
                return $this->_selector->message = $login['message'];
            }
            if ($login) {
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

    public function submitsendReset($request)
    {
        if (!empty($request)) {
            $reset = $this->_validation->validateResetMail($request);
            if (\array_key_exists('message', $reset)) {
                return $this->_selector->message = $reset['message'];
            } else {
                $result = $this->_member->getMemberID($request); # Array
                $token = hash_hmac('SHA256', $this->_member->generate_entropy(8), $result['password']);
                $storedToken = hash('SHA256', ($token));
                // store token
                $set = ['resetToken'=>$storedToken,'resetComplete'=>'No'];
                $stmt = $this->_db->update('members')->set($set)->where('memberID', $result['memberID'])->execute();
                $this->_db->close();
                // Not best solution but it works
                $bodyFile =  file_get_contents(DIR.'/views/email/pwd-reset.php');
                $body = str_replace(['YourUsername','Suplytoken','MemberID'], [$result['username'],$storedToken,$result['memberID']], $bodyFile);
                $info = ['to'=>$reset['email'],'subject'=>'SA | Reset hesla'];
                if ($this->_mail->sender($body, $info)) {
                    Router::redirect('login?action=reset');
                }
            }
        }
        return null;
    }

    public function submitReset($request)
    {
        if (!empty($request)) {
            $subReset = $this->_validation->validateReset($request);
            if (\array_key_exists('message', $subReset)) {
                return $this->_selector->message = $subReset['message'];
            } else {
                $hashedpassword = password_hash($subReset['password'], PASSWORD_DEFAULT);
                $resetDBHash = $this->_member->resetDBHash($request, $hashedpassword);
                if ($resetDBHash) {
                    $set = ['resetToken'=>null,'resetComplete'=>null];
                    $stmt = $this->_db->update('members')->set($set)->where('memberID', $request['id'])->execute();
                    if ($stmt) {
                        $this->_db->close();
                        Router::redirect('login?action=resetAccount');
                    }
                    return $this->_selector->message = '<div role="alert" class="alert alert-danger text-center text-danger"><span>Reset password failed </span></div>';
                }
            }
        }
        return null;
    }

    public function submitKontakt($request)
    {
        return null;
    }

    public function updateMember($request)
    {
        if (!empty($request)) {
            if (isset($_FILES['avatar'])) {
                $file = $_FILES['avatar'];
                $fileValidation = $this->_validation->validateFile($file);
                switch ($fileValidation) {
                case 'fileToBig':
                    return $this->_selector->message = '<div role="alert" class="alert alert-danger text-center text-danger"><span>Příliž velký obrázek</span></div>';
                    break;
                case 'InvalidExt':
                    return $this->_selector->message = '<div role="alert" class="alert alert-danger text-center text-danger"><span>Soubor musí být pouze obrázek</span></div>';
                    break;
                default:
                $filename = $fileValidation;
            }
            }
            $updateMember = $this->_validation->validateUpdateMember($request);
            if (\array_key_exists('message', $updateMember)) {
                return $this->_selector->message = $updateMember['message'];
            }
            $visible =  (isset($request['visible'])) ? 1 : 0 ;
            $set = ['name'=>$updateMember['name'],'surname'=>$updateMember['surname'],'avatar'=>$filename,'age'=>$updateMember['age'],'location'=>$updateMember['location'],'visible'=>$visible];
            $stmt = $this->_db->update('members')->set($set)->where('username', $updateMember['username'])->execute();
            if ($stmt) {
                @$_SESSION['avatar'] = $filename;
                Router::redirect('member/'.$updateMember['username'].'?action=profilUpdate');
            }
            return dd($updateMember);
        }
        return null;
    }
    // check hash latter update
    public function activate()
    {
        $checkActivate = null;
        $memberID = $this->_validation->sanitaze_GET('x');
        /*
        if(\array_key_exists('message',$checkActivate)){
            Router::redirect('login?action=failActive');
        }*/
        $set = ['active'=>'YES'];
        $stmt = $this->_db->update('members', $set)->where('memberID', $memberID)->execute();
        $this->_db->close();
        Router::redirect('login?action=active');
    }
    //TODO: better message for this function use  selector->message
    public function saveBookmark($article, $page)
    {
        $validateBookmark = $this->_validation->validateBookmark($article, $page);
        if (\array_key_exists('message', $validateBookmark)) {
            Router::redirect('member/'.$this->_member->username.'?action=failActive');
        }
        // 0 is default value from  $member->getUsrBookmark() - DB
        $bookmark = (int)$this->_member->bookmarkCount;
        // frist bookmark
        if($bookmark === 0){
            $bookmark++;
            $bookmarkContent = ['num'.$bookmark =>'show/'.$article.'/'.$page.''];
            $set = ['bookmark'=>$bookmark,'contentBook'=>json_encode($bookmarkContent)];
            $stmt = $this->_db->update('members')->set($set)->where('memberID',$this->_member->memberID)->execute();
            if($stmt){
                return header('Location: http://sadventure.com/member/'.$member->username.'?action=savedBookmark');;
            }
                //return error msg
              
        }// next bookmarks  
        else{
            $bookmark++;
            $next = ['num'.$bookmark =>'show/'.$article.'/'.$page.''];
            $oldbookmarknum = $bookmark - 1;
            $old = ['num'.$oldbookmarknum => 'show/'.$article.'/'.$page.''];
            $savedBookmark = array_merge($old,$next);
            $set = ['bookmark'=>$bookmark,'contentBook'=>json_encode($savedBookmark)];
            $stmt = $this->_db->update('members')->set($set)->where('memberID', $this->_member->memberID)->execute();
            if($stmt){
                return  header('Location: http://sadventure.com/member/'.$member->username.'?action=savedBookmark');;
            }
                //return error msg
        }
        // return error message
    }
}
