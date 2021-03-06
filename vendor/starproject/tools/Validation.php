<?php

namespace starproject\tools;

use \starproject\database\Datab;
use \starproject\tools\Messages;
use \starproject\tools\Sanitazorx;
use \starproject\database\costumers\Member;

class Validation extends Sanitazorx
{
    private $_db;
    private $_message;
    private $_member;
    
    public function __construct(Datab $con, Messages $message, Member $member)
    {
        $this->_db = $con->con();
        $this->_message = $message;
        $this->_member = $member;
    }

    private function _emptyFields(array $Fields)
    {
        foreach ($Fields as $Field => $value) {
            if (empty($value)) {
                return true;
            }
            return false;
        }
    }

    private function _validCSFR($request)
    {
        $decoded = base64_decode($_SESSION['_token']);
        $validS = explode('|', $decoded);
        if (!in_array($_SERVER['SERVER_NAME'], $validS)) {
            return false;
        }
        if (password_verify($_SESSION['_token'], $request['_token'])) {
            return true;
        }
        return false;
    }

    public function validateRegister($request)
    {
        if ($request['persistent_register'] == 'yes') {
            $username = $this->sanitaze($request['username']);
            $email = $this->sanitazeEmail($request['email']);
            $password = $this->sanitaze($request['password']);
            $password_again = $this->sanitaze($request['password_again']);
            // check empty filelds
            if ($this->_emptyFields([$username,$email,$password,$password_again])) {
                return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
            }
            if ($this->_member->userExist($username, $email)) {
                return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno nebo email se již používá'])];
            }
            if (!$this->_member->isValidUsername($username)) {
                return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno musí obsahovat minimálně 4 - 25 znaku'])];
            }
            if (mb_strlen($password) < 6 || mb_strlen($password_again) < 6) {
                return ['message'=>$this->_message->message(['error'=>'Heslo musí mít nejméně 6 znaků'])];
            }
            if ($password != $password_again) {
                return ['message'=>$this->_message->message(['error'=>'Heslo se musí schodovat'])];
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return ['message'=>$this->_message->message(['error'=>'Prosím zadajte platný email'])];
            }
            return ['username'=>$username,'password'=>$password,'email'=>$email];
        } else {
            return ['message'=>$this->_message->message(['error'=>'Pro úspěšnou registraci musíte souhlasit s VOP a Terms'])];
        }
    }

    public function setSession($password, $result)
    {
        //? change it
        if (password_verify($password, $result['password'])) {
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
            $_SESSION['permission'] = $result['permission'];
            // not setup inside db $_SESSION['role'] = $result['role']
            return $_SESSION;
            //return $result;
        }
        return false;
    }

    public function validateLogin($request)
    {
        $username = $this->sanitaze($request['username']);
        $password = $request['password'];
        $stmt = $this->_db->from('members')->where('username', $username);
        $result = $stmt->fetch();
        $active = $result['active'];
        $id = $result['memberID'];
        if (!$this->_validCSFR($request)) {
            return ['message'=>$this->_message->message(['error'=>'Invalid CSRF'])];
        }
        if (!$id) {
            return['message'=>$this->_message->message(['error'=>'Uživatel neexistuje'])];
        }
        if ($active != 'YES') {
            return['message'=>$this->_message->message(['error'=>'Uživatel není aktivní zkotrolujte e-mail'])];
        }
        if ($this->_emptyFields([$username,$password])) {
            return ['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
        }
        if (!$this->_member->isValidUsername($username)) {
            return ['message'=>$this->_message->message(['error'=>'Uživatelské jméno musí obsahovat minimálně 4 - 25 znaku'])];
        }
        if (strlen($password) < 5) {
            return ['message'=>$this->_message->message(['error'=>'Heslo musí být delší jak 5 znaků'])];
        }
        if (!$this->setSession($password, $result)) {
            return ['message'=>$this->_message->message(['error'=>'Nesprávné heslo'])];
        }
        return $this->setSession($password, $result);
    }

    public function validateReset($request)
    {
        //fields , password,passwordConfirm , token
        $resetpwd = $request['password'];
        $resetpwdAgain = $request['passwordConfirm'];
        $token = $this->sanitaze($request['hash']);
        if ($this->_emptyFields([$resetpwd,$resetpwdAgain,$token])) {
            return ['message'=>$this->message->message(['error'=>'Všechna pole musí být vyplněna'])];
        }
        if (mb_strlen($resetpwd) < 6 || mb_strlen($resetpwdAgain) < 6) {
            return ['message'=>$this->_message->message(['error'=>'Heslo musí mít nejméně 6 znaků'])];
        }
        if ($resetpwd != $resetpwdAgain) {
            return ['message'=>$this->_message->message(['error'=>'Heslo se musí schodovat'])];
        }
        return ['password'=>$resetpwd,'token'=>$token];
    }

    public function validateResetMail($request)
    {
        $email = $this->sanitazeEmail($request['email']);
        if ($this->_emptyFields([$email])) {
            return['message'=>$this->_message->message(['error'=>'Všechna pole musí být vyplněna'])];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return['message'=>$this->_message->message(['error'=>'Prosím zadajte platný email'])];
        }
        // Check DB
        $stmt = $this->_db->from('members')->where('email', $email);
        $rowEmail = $stmt->fetch('email');
        if ($rowEmail != $email) {
            return['message'=>$this->_message->message(['error'=>'K zadému emailu neexistuje žádný účet'])];
        }
        return ['email'=>$email];
    }

    public function checkActivation()
    {
        $memberID = $this->sanitaze_GET('x');
        $active = $this->sanitaze_GET('y');
        if (!isset($memberID) && !isset($active)) {
            return['message'=>'What are you trying to do'];
        }
        $stmt = $this->_db->from('members')->select('active')->where('memberID', $memberID);
        $result = $stmt->fetch();
    
        if ($result != $active) {
            return['message'=>'No'];
        }
        return ['memberID'=>$memberID];
    }

    public function validateBookmark()
    {
        return [];
        //TODO: Complete this
        /*
            if(!in_array($article,$selector->allowedAricles)){
            \header('Location: http://sadventure.com/404/')
            }
        */
    }

    public function validateUpdateMember($request)
    {
        //REVIEW: Test code change before public     
        $name =  (trim($request['name']) === '') ? null : $this->sanitaze($request['name']);
        $surname =  (trim($request['surname']) === '') ? null : $this->sanitaze($request['surname']);
        $age = $request['age'] ?? null;
        $location = (trim($request['location']) === '') ? null : $this->sanitaze($request['location']);
        $username = $this->sanitaze($request['username']);
        //"_token" => "$2y$10$4LM57c3SU0fMiwbQ88s15esbJrF6QeNyoBJf0W6S0wncUIaf0V8Fy";
    
        return ['name'=>$name,'surname'=>$suranme,'location'=>$location,'username'=>$username];
    }

    public function validateFile($file)
    {
        $fileName =  $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileExt = explode('.', $fileName);
        $realExt = strtolower(end($fileExt));
        $allowedExt = ['jpg','jpeg','png'];
        # Delete old avatar from folder
        if ($this->_member->avatar !== 'empty_profile.png') {
            \unlink('public/images/avatars/'.$this->_member->avatar);
        }
        # New Avatar
        if (in_array($realExt, $allowedExt)) {
            if ($fileSize < 1000000) {
                $fileNameNew = bin2hex(random_bytes(5)).'.'.$realExt;
                $upload_dir = 'public/images/avatars/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $upload_dir);
                return $fileNameNew;
            }
            return 'fileToBig';
        }
        return 'InvalidExt';
    }
}
